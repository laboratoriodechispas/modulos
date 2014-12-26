<?php
class Content extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('eventos_model');
        $this->load->model('tipo_evento_model');
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

        Template::render();
    }

    //--------------------------------------------------------------------
    public function agregar()
    {
        $user         = $this->current_user->id;
        $tipos_evento = $this->get_tipo_evento();
        if ($this->input->post('submit')) {

            $data = array(
                'nombre_evento'  => $this->input->post("nombre_evento"),
                'descripcion'    => $this->input->post("descripcion"),
                'fecha'          => $this->input->post("fecha"),
                'ruta'           => $this->input->post("ruta"),
                'img_destacada'  => $this->input->post("img_destacada"),
                'img_thumb'      => $this->input->post("img_thumb"),
                'convocatoria'   => $this->input->post("convocatoria"),
                'tipo_evento'    => $this->input->post("tipo_evento"),
                'id_organizador' => $user,
                'slug'           => url_title($this->input->post("nombre_evento"),'dash',true),
                'status'         => 1
            );

            if ($this->eventos_model->insert($data)) {
                Template::set_message('You post was successfully saved.', 'success');
                redirect(SITE_AREA . '/content/eventos');
            }
        }

        Template::set('toolbar_title', 'Crear nuevo evento');
        Template::set('tipo_evento',$tipos_evento);
        Template::set_view('content/agregar_evento');
        Template::render();
    }


    public function editar_evento($id = null)
    {
        $user         = $this->current_user->id;
        $tipos_evento = $this->get_tipo_evento();

        if ($this->input->post('submit')) {
            $data = array(
                'nombre_evento'  => $this->input->post("nombre_evento"),
                'descripcion'    => $this->input->post("descripcion"),
                'fecha'          => $this->input->post("fecha"),
                'ruta'           => $this->input->post("ruta"),
                'img_destacada'  => $this->input->post("img_destacada"),
                'img_thumb'      => $this->input->post("img_thumb"),
                'convocatoria'   => $this->input->post("convocatoria"),
                'tipo_evento'    => $this->input->post("tipo_evento"),
                'id_organizador' => $user,
                'slug'           => url_title($this->input->post("nombre_evento"),'dash',true),
                'status'         => 1
            );

            if ($this->eventos_model->update($id, $data)) {
                Template::set_message('El evento se guardo correctamente.', 'success');
                redirect(SITE_AREA . '/content/eventos');
            }
        }

        Template::set('post', $this->eventos_model->find($id));

        Template::set('toolbar_title', 'Editar evento');
        Template::set('tipo_evento',$tipos_evento);
        Template::set_view('content/agregar_evento');
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
}
?>