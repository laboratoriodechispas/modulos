<?php
class Eventos extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('eventos_model');
        $this->load->model('tipo_evento_model');
        $this->load->model('convocatorias_model');
        $this->load->model('tit_convocatoria_model');
        $this->load->model('preguntas_def_model');
        $this->load->model('respuestas_def_model');
        $this->load->model('relacion_preg_resp_model');
        $this->load->library('users/auth');
        Template::set('toolbar_title', 'Administrar eventos');
        Template::set_block('sub_nav', 'content/sub_nav');
    }

    //--------------------------------------------------------------------

    public function index()
    {
        if ($this->input->post('submit')) {
            $array = $this->input->post('checked');
            $data  = "";

            for($i = 0;$i<=count($array)-1;$i++){
                if($i!=count($array)-1){
                    $data .= $array[$i].",";
                }else{
                    $data .= $array[$i];
                }

            }

            $delete = $this->eventos_model->delete($data);
            if($delete){
                Template::set_message('You post was successfully saved.', 'success');
            }
        }
        $eventos = $this->eventos_model->where('deleted', 0)->find_all();

        Template::set('toolbar_title', 'Gestion de eventos');
        Template::set('eventos', $eventos);
        Template::set_view('content/index');
        Template::render();
    }

    //--------------------------------------------------------------------

    /**
     * Agrega un evento
     *
     * Funcion encargada de agregar un evento
     */
    public function agregar()
    {
        $keys_bases = ['evento','categorias','inscripcion','paquetes','cronometraje','fotos','ruta','premiacion','generales','otros'];
        $user             = $this->current_user->id;
        $tipos_evento     = $this->get_tipo_evento();
        $convocatorias = $this->get_tit_convocatoria();

        if ($this->input->post()) {

            $data = array(
                'nombre_evento'  => $this->input->post("nombre_evento"),
                'descripcion'    => $this->input->post("descripcion"),
                'fecha'          => $this->input->post("fecha"),
                'img_destacada'  => $this->input->post("img_destacada"),
                'img_thumb'      => $this->input->post("img_thumb"),
                'tipo_evento'    => $this->input->post("tipo_evento"),
                'id_organizador' => $user,
                'slug'           => url_title($this->input->post("nombre_evento"),'dash',true),
                'status'         => 1
            );

            $id = $this->eventos_model->insert($data);
            if ($id>0) {

                for($i = 0; $i<=count($keys_bases)-1;$i++)
                {
                    $content = $keys_bases[$i];
                    $input = array(
                        'contenido' => $this->input->post($content),
                        'id_tit_convocatoria' => $this->input->post('id-'.$content)
                    );

                    array_push($data_convocatoria,$input);
                }

                $preguntas  = $this->input->post('pregunta');
                $tipo       = $this->input->post('tipo');


                $question = array();
                $answer   = array();
                $radio    = 1;
                $select   = 1;
                $check    = 1;
                for($i = 0;$i<= count($preguntas)-1;$i++ )
                {
                    $resp = '';
                    if($tipo[$i]=='open')
                    {
                        $resp = 'open';
                        $loop = '';
                    }
                    elseif($tipo[$i]=='radio')
                    {
                        $loop = $this->input->post("respuesta-radio-$radio");
                        $radio++;

                    }
                    elseif($tipo[$i]=='select')
                    {
                        $loop = $this->input->post("respuesta-select-$select");
                        $select++;
                    }
                    elseif($tipo[$i]=='check')
                    {
                        $loop = $this->input->post("respuesta-check-$check");
                        $check++;
                    }

                    if($loop!='')
                    {
                        for ($j = 0; $j <= count($loop) - 1; $j++)
                        {
                            if ($j != count($loop)-1)
                            {
                                $resp .= $loop[$j] . '|';
                            }
                            else
                            {
                                $resp .= $loop[$j];
                            }
                        }
                    }

                    array_push($question,array('pregunta' =>$preguntas[$i],'tipo'=>$tipo[$i],'id_evento' => $id));
                    array_push($answer,array('respuesta'=>$resp,'id_evento'=>$id));


                }


                $this->preguntas_def_model->insert_batch($question);
                $this->respuestas_def_model->insert_batch($answer);

                $id_preguntas  = $this->preguntas_def_model->select('id')->where('id_evento', $id)->find_all();
                $id_respuestas = $this->respuestas_def_model->select('id')->where('id_evento', $id)->find_all();

                $relacion = array();
                if(count($id_preguntas)&&count($id_respuestas))
                {



                    foreach($id_preguntas as $index => $ida)
                    {

                        array_push($relacion,array('id_pregunta'=>$ida->id,'id_respuesta'=>$id_respuestas[$index]->id,'id_evento'=>$id->id));

                    }

                    if($this->relacion_preg_resp_model->insert_batch($relacion)&&$this->convocatorias_model->insert_batch($data_convocatoria))
                        Template::set_message('Tu evento ha sido cargado con exito.', 'success');
                    redirect('/eventos');
                }


            }
        }

        Template::set('toolbar_title', 'Crear nuevo evento');
        Template::set('tipo_evento',$tipos_evento);
        Template::set('convocatorias',$convocatorias);
        Template::set_view('content/agregar_evento');

        Template::render();

    }

    /**
     * @param null $id
     *
     * Hace un update en algun evento
     *
     * Funcion encargada de hacer un evento
     */
    public function editar_evento($id = null)
    {
        $keys_bases = ['evento','categorias','inscripcion','paquetes','cronometraje','fotos','ruta','premiacion','generales','otros'];
        $user             = $this->current_user->id;
        $tipos_evento     = $this->get_tipo_evento();
        $convocatorias    = $this->get_convocatorias($id);
        $answers          = $this->get_answers($id);
        if ($this->input->post()) {
            $data = array(
                'nombre_evento'  => $this->input->post("nombre_evento"),
                'descripcion'    => $this->input->post("descripcion"),
                'fecha'          => $this->input->post("fecha"),
                'img_destacada'  => $this->input->post("img_destacada"),
                'img_thumb'      => $this->input->post("img_thumb"),
                'tipo_evento'    => $this->input->post("tipo_evento"),
                'id_organizador' => $user,
                'slug'           => url_title($this->input->post("nombre_evento"),'dash',true),
                'status'         => 1
            );


            $insert = $this->eventos_model->update($id, $data);
            if ($this->eventos_model->update($id, $data)) {
                $data_convocatoria = array();

            for($i = 0; $i<=count($keys_bases)-1;$i++)
            {
                $content = $keys_bases[$i];
                $input = array(
                    'contenido' => $this->input->post($content),
                    'id_tit_convocatoria' => $this->input->post('id-'.$content)
                );

                array_push($data_convocatoria,$input);
            }



                if($this->convocatorias_model->where('id_evento',$id)->update_batch($data_convocatoria,'id_tit_convocatoria')) {

                    $preguntas      = $this->input->post('update-pregunta');
                    $ids_preguntas  = $this->input->post('id_preguntas');
                    $ids_respuestas = $this->input->post('id_respuestas');
                    $count  = 1;

                    $resp   = array();
                    $preg   = array();

                    for($i=0;$i<=count($preguntas)-1; $i++)
                    {
                        $respuesta = $this->input->post('update-respuesta-'.$count);

                        $result = '';
                        for ($j = 0; $j <= count($respuesta) - 1; $j++)
                        {
                            if ($j != count($respuesta)-1)
                            {
                                $result .= $respuesta[$j] . '|';
                            }
                            else
                            {
                                $result .= $respuesta[$j];
                            }
                        }
                        array_push($resp,array('id'=>$ids_respuestas[$i],'respuesta'=>$result,'modified_on'=>(string)date('Y-m-d H:i:s')));
                        array_push($preg,array('id'=>$ids_preguntas[$i],'pregunta'=>$preguntas[$i],'modified_on'=>(string)date('Y-m-d H:i:s')));
                        $count++;
                    }

                    $preg_bool  = $this->preguntas_def_model->update_batch($preg,'id');
                    $resp_bool  = $this->respuestas_def_model->update_batch($resp,'id');
                    if($resp_bool&&$preg_bool){


                        if($this->input->post('pregunta')) {
                            $preguntas = $this->input->post('pregunta');
                            $tipo = $this->input->post('tipo');


                            $question = array();
                            $answer   = array();
                            $radio    = 1;
                            $select   = 1;
                            $check    = 1;

                            for ($i = 0; $i <= count($preguntas) - 1; $i++) {
                                $resp = '';
                                if ($tipo[$i] == 'open') {
                                    $resp = 'open';
                                    $loop = '';
                                } elseif ($tipo[$i] == 'radio') {
                                    $loop = $this->input->post("respuesta-radio-$radio");
                                    $radio++;

                                } elseif ($tipo[$i] == 'select') {
                                    $loop = $this->input->post("respuesta-select-$select");
                                    $select++;
                                } elseif ($tipo[$i] == 'check') {
                                    $loop = $this->input->post("respuesta-check-$check");
                                    $check++;
                                }

                                if ($loop != '') {
                                    for ($j = 0; $j <= count($loop) - 1; $j++) {
                                        if ($j != count($loop) - 1) {
                                            $resp .= $loop[$j] . '|';
                                        } else {
                                            $resp .= $loop[$j];
                                        }
                                    }
                                }

                                array_push($question, array('pregunta' => $preguntas[$i], 'tipo' => $tipo[$i], 'id_evento' => $id));
                                array_push($answer, array('respuesta' => $resp, 'id_evento' => $id));


                            }


                            $this->preguntas_def_model->insert_batch($question);
                            $this->respuestas_def_model->insert_batch($answer);

                            $id_preguntas  = $this->preguntas_def_model->select('id')->where('id_evento', $id)->limit(count($preguntas))->order_by('id','desc')->find_all();
                            $id_respuestas = $this->respuestas_def_model->select('id')->where('id_evento', $id)->limit(count($preguntas))->order_by('id','desc')->find_all();

                            $relacion = array();
                            if(count($id_preguntas)&&count($id_respuestas))
                            {



                                foreach($id_preguntas as $index => $ida)
                                {

                                    array_push($relacion,array('id_pregunta'=>$ida->id,'id_respuesta'=>$id_respuestas[$index]->id,'id_evento'=>$id));

                                }

                                if($this->relacion_preg_resp_model->insert_batch($relacion)) {
                                    Template::set_message('las respuestas se insertaron correctamente.', 'success');

                                }
                            }
                        }
                        else
                        {
                            Template::set_message('El evento se guardo correctamente.', 'success');
                            redirect('/eventos');
                        }

                    }

                }
            }
        }

        Template::set('post', $this->eventos_model->find($id));

        Template::set('toolbar_title', 'Editar evento');
        Template::set('tipo_evento',$tipos_evento);
        Template::set('convocatorias',$convocatorias);
        Template::set('answers',$answers);
        Template::set_view('content/editar_evento');
        Template::render();
    }

    private function get_tipo_evento()
    {

        $tipo_evento = $this->tipo_evento_model->where('deleted', 0)->find_all();

        if($tipo_evento)
        {
            $data = array('response' => 'ok','data'=>$tipo_evento);

        }// end if($tipo_evento)
        else
        {
            $data = array('response' => 'error','message'=>'Error en servidor/de conexion o no hay datos que mostrar');

        }//end else

        return $data;
    }//end function get_tipo_evento_post()

    private function get_tit_convocatoria(){
        $titulo = $this->tit_convocatoria_model->where('deleted', 0)->find_all();

        if($titulo)
        {
            $data = array('response' => 'ok','data'=>$titulo);

        }// end if($tipo_evento)
        else
        {
            $data = array('response' => 'error','message'=>'Error en servidor/de conexion o no hay datos que mostrar');

        }//end else

        return $data;
    }


    /**
     * @param $id
     * @return array
     *
     * Retorna eventos
     *
     * Funcion encargada de retornar una lista de las convocatorias
     * acorde al id de un evento
     */
    private function get_convocatorias($id){

        $convocatorias = $this->convocatorias_model->where(array('bf_tbl_convocatorias.deleted'=>0,'id_evento'=>$id,'bf_tbl_tit_convocatoria.deleted'=>0))->
        join('bf_tbl_tit_convocatoria','bf_tbl_tit_convocatoria.id = bf_tbl_convocatorias.id_tit_convocatoria')->find_all();

        if($convocatorias )
        {

            $data = array('response' => 'ok','data'=>$convocatorias);
        }// end if($tipo_evento)
        else
        {
            $data = array('response' => 'error','message'=>'Error en servidor/de conexion o no hay datos que mostrar');

        }//end else

        return $data;
    }

    private function get_answers($id_Evento)
    {
        $id_evento  = ($id_Evento)?$id_Evento:0;

        if($id_evento==0){
            $pregunta = false;
        }else{
            $pregunta = $this->relacion_preg_resp_model->select('tbl_relacion_preg_resp.id as id_relacion,id_pregunta,pregunta,respuesta,tipo,id_respuesta')->
            where(array('tbl_relacion_preg_resp.deleted'=>0,'tbl_preguntas_def.deleted'=>0,'tbl_respuestas_def.deleted'=>0,'tbl_preguntas_def.id_evento'=>$id_evento,'tbl_respuestas_def.id_evento'=>$id_evento,'tbl_relacion_preg_resp.id_evento'=>$id_evento))
                ->join('tbl_preguntas_def','tbl_preguntas_def.id=tbl_relacion_preg_resp.id_pregunta')->join('tbl_respuestas_def','tbl_respuestas_def.id=tbl_relacion_preg_resp.id_respuesta')->find_all();
        }

        if($pregunta)
        {
            $data = array('response' => 'ok','data'=>$pregunta);
        } // if($pregunta)
        else
        {
            $data = array('response' => 'error','message'=>'No se encuentra la pregunta, verifica los campos');

        }//end else
        return $data;
    }
  
}

?>