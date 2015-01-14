<?php
/**
 * Created by PhpStorm.
 * User: Spark
 * Date: 10/12/2014
 * Time: 01:09 PM
 */

require(APPPATH.'libraries/REST_Controller.php');

class Gestion_preguntas extends \REST_Controller
{
    /*
     * constructor
     *
     * funcion encargada de cargar los modelos que seran utilizados en
     * el proceso
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library('users/auth');
        $this->load->model('relacion_preg_resp_model');

    }//end function __construct(){

    /*
     * obtener preguntas
     *
     * Funcion en cargada de retornar las preguntas
     * acorde al id de un evento si no se determina retornara todas las preguntas
     */
    public function get_pregunta_post()
    {
        $post_add = $this->post();
        if($post_add)
        {

            $id_evento  = ($this->post("id_evento"))?$this->post("id_evento"):0;

            if($id_evento==0){
                $data     = array('response' => 'error','message'=>'Falta el id del evento');
                $pregunta = false;
            }else{
                $pregunta = $this->relacion_preg_resp_model->select('tbl_relacion_preg_resp.id as id_relacion,id_pregunta,pregunta,respuesta,tipo')->
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
        }//end if($post_add)
        else
        {
            $data = array('response' => 'error','message'=>'Sin datos');

        }//end else
        $this->response($data);
    }//end function get_preguntas_post(){

    public function insert_preguntas_post()
    {
        $post_add = $this->post();
        if($post_add)
        {



            $id_evento   = ($this->post("id_evento"))?$this->post("id_evento"):0;
            $id_relacion = ($this->post("id_relacion")?$this->post("id_relacion"):'');
            $id_usuario  = ($this->post("id_usuario")?$this->post("id_usuario"):0);
            $vars        = ($this->post("vars")?$this->post("vars"):'');

        if($id_evento==0 || !is_array($id_relacion) || $id_usuario == 0 || !is_array($vars)){

            $pregunta = false;
        }else{

            $array  = array_keys($vars);

            $result = array();

            for($i=0;$i<=count($array)-1;$i++)
            {
                $value = $vars[$array[$i]];
                array_push($result,array('created_on'=>date('Y-m-d H:i:s'),'id_pregunta'=>$array[$i],'id_relacion'=>(int)$id_relacion[$i],'id_evento'=>$id_evento,'id_usuario'=>$id_usuario,'respuesta'=>is_array($value)?implode("|", $vars[$array[$i]]):$value));

            }

            $pregunta = $this->db->insert_batch('tbl_respuestas_usuarios',$result);
        }

        if($pregunta)
        {
            $data = array('response' => 'ok');
        } // if($pregunta)
        else
        {
            $data = array('response' => 'error','message'=>$result);

        }//end else
    }//end if($post_add)
else
{
$data = array('response' => 'error','message'=>'Sin datos');

}//end else
$this->response($data);
    }


    private function get_type($string,$id_pregunta,$type)
{

    $data = '';
    if ($string != '') {

        switch ($type) {
            case 'radio':

                $answers = explode('|', $string);

                for($i = 0;$i<=count($answers)-1;$i++) {

                    $data .= '<br>'.$answers[$i].'<input type="radio" name="'.$id_pregunta.'" value="'.$answers[$i].'">';

                }

                break;
            case 'select':

                $answers = explode('|', $string);
                $data = '<select name="'.$id_pregunta.'">';
                for($i = 0;$i<=count($answers)-1;$i++) {
                    $data .= '<br>'.$answers[$i].'<option value="'.$answers[$i].'">'.$answers[$i].'</option>';
                }

                break;
            case 'check':

                $answers = explode('|', $string);

                for($i = 0;$i<=count($answers)-1;$i++) {
                    $data .= '<br>'.$answers[$i].'<input type="checkbox" name="'.$id_pregunta.'[]" value="'.$answers[$i].'">';
                }

                break;
        }
    }else{
        $data = '<input type="text" name="'.$id_pregunta.'">';

    }

    return $data;
}

}