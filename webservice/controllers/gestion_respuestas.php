<?php
/**
 * Created by PhpStorm.
 * User: Spark
 * Date: 10/12/2014
 * Time: 01:09 PM
 */

require(APPPATH.'libraries/REST_Controller.php');

class Gestion_respuestas extends \REST_Controller
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
        $this->load->model('respuestas_model');

    }//end function __construct(){

    /*
     * Agregar pregunta
     *
     * Funcion encargada de insertar una pregunta en tbl_preguntas
     * necesita del id del evento
     */
    public function add_respuesta_post()
    {

        $post_add = $this->post();
        /*verifico que haya datos post*/
        if($post_add)
        {
            $data = array(
                'id_pregunta' => $this->post("id_pregunta"),
                'id_evento'   => $this->post("id_evento"),
                'id_usuario'  => $this->post("id_usuario"),
                'respuesta'   => $this->post("respuesta")
            );

            /*verifico la insercion*/
            if ($this->respuestas_model->insert($data))
            {
                $data = array('response' => 'ok');

            }
            else
            {//end if ($this->eventos_model->insert($data)) {
                $data = array('response' => 'error','message'=>'La insercion no se pudo realizar');

            }//end else
        }//end if($post_add) {
        else
        {
            $data = array('response' => 'error','message'=>'Sin datos');

        }//end else
        // Create post object
        $this->response($data);
    }//end function add_pregunta_post()


    /*
     * editar pregunta
     *
     * funcion encargada de hacer un update de
     * la pregunta en la tabla tbl_preguntas
     */
    public function update_pregunta_post()
    {

        $post_add = $this->post();
        if($post_add)
        {
            $data = array(
                'pregunta'    => $this->post("pregunta"),
                'id_evento'   => $this->post("id_evento")

            );
            /*
             * compruebo la actualizacion en la tabla eventos
             */

            if ($this->preguntas_model->update($this->post('id_pregunta'), $data))
            {

                $data = array('response' => 'ok');


            } // if ($this->eventos_model->update($this->post('id'), $data)) {
            else
            {
                $data = array('response' => 'error','message'=>'error en update verifica los campos');

            }//end else
        }//end if($post_add)
        else
        {
            $data = array('response' => 'error','message'=>'Sin datos');

        }//end else
        $this->response($data);
    }


    /*
     * eliminar pregunta
     *
     * funcion encargada de eliminar una pregunta
     * es necesario el id para que esto suceda
     */
    public function delete_pregunta_post()
    {
        $post_add = $this->post();
        if($post_add)
        {

            $id_pregunta  = $this->post("id_pregunta");


            $pregunta = $this->preguntas_model->delete($id_pregunta);
            if($pregunta)
            {
                $data = array('response' => 'ok');
            } // if($pregunta)
            else
            {
                $data = array('response' => 'error','message'=>'No se puede eliminar o no existe ese id');

            }//end else
        }//end if($post_add)
        else
        {
            $data = array('response' => 'error','message'=>'Sin datos');

        }//end else
        $this->response($data);
    }//end function delete_pregunta_post(){


    /*
     * obtener info
     *
     * funcion encargada de realizar una busqueda de un id
     * usando el texto de la pregunta y el id del evento para
     * encotrarla, tambien puede servir para evitar duplicados
     * uso este metodo pues las preguntas pueden repetirse mas el
     * id_evento deberia servir como un control adicional
     */
    public function get_info_pregunta_post()
    {
        $post_add = $this->post();
        if($post_add)
        {

            $id_evento  = $this->post("id_evento");
            $pregunta   = $this->post("pregunta");

            $pregunta = $this->preguntas_model->where(array('deleted'=>0,'id_evento'=>$id_evento))->like('pregunta',$pregunta)->find_all();
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
    }//function get_info_pregunta_post(){


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
                $pregunta = $this->preguntas_model->where(array('deleted'=>0))->find_all();
            }else{
                $pregunta = $this->preguntas_model->where(array('deleted'=>0,'id_evento'=>$id_evento))->find_all();
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

    /*
     * obtener el id de una pregunta
     *
     * Funcion encargada de retornar solo el id de una pregunta
     * requiere 2 campos:
     * 1. la pregunta
     * 2. el id del evento
     */
    public function get_id_pregunta_post()
    {
        $post_add = $this->post();
        if($post_add)
        {

            $id_evento  = $this->post("id_evento");
            $pregunta   = $this->post("pregunta");

            $pregunta = $this->preguntas_model->select('id')->where(array('deleted'=>0,'id_evento'=>$id_evento))->like('pregunta',$pregunta)->find_all();
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
    }//end get_id_pregunta_post()
}