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
     * Agregar respuesta
     *
     * Funcion encargada de insertar una respuesta en tbl_respuestas
     *
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

            }//end  if ($this->respuestas_model->insert($data))
            else
            {
                $data = array('response' => 'error','message'=>'La insercion no se pudo realizar');

            }//end else
        }//end if($post_add) {
        else
        {
            $data = array('response' => 'error','message'=>'Sin datos');

        }//end else

        $this->response($data);
    }//end function add_respuesta_post()


    /*
     * editar respuesta
     *
     * funcion encargada de hacer un update de
     * la respuesta en la tabla tbl_respuestas
     */
    public function update_respuesta_post()
    {

        $post_add = $this->post();
        if($post_add)
        {
            $data = array(
                'id_pregunta' => $this->post("id_pregunta"),
                'id_evento'   => $this->post("id_evento"),
                'id_usuario'  => $this->post("id_usuario"),
                'respuesta'   => $this->post("respuesta")
            );
            /*
             * compruebo la actualizacion en la tabla respuestas
             */

            if ($this->respuestas_model->update($this->post('id_respuesta'), $data))
            {

                $data = array('response' => 'ok');


            } //end if ($this->respuestas_model->update($this->post('id_respuesta'), $data))
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
    }//end function update_respuesta_post()


    /*
     * eliminar respuesta
     *
     * funcion encargada de eliminar una respuesta
     * es necesario el id para que esto suceda
     */
    public function delete_respuesta_post()
    {
        $post_add = $this->post();
        if($post_add)
        {

            $id_respuesta  = $this->post("id_respuesta");


            $respuesta = $this->respuestas_model->delete($id_respuesta);
            if($respuesta)
            {
                $data = array('response' => 'ok');
            }//end if($respuesta)
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
    }//end function delete_respuesta_post()


    /*
     * obtener info
     *
     * funcion encargada de realizar una busqueda de un id
     * usando el texto el id de la respuesta para
     * encotrarla, tambien puede servir para evitar duplicados
     * uso este metodo pues las respuestas pueden repetirse mas el
     * id_evento deberia servir como un control adicional
     */
    public function get_info_respuesta_post()
    {
        $post_add = $this->post();
        if($post_add)
        {

            $id_pregunta  = $this->post("id_pregunta");


            $respuesta = $this->respuestas_model->where(array('deleted'=>0,'id_pregunta'=>$id_pregunta))->find_all();
            if($respuesta)
            {
                $data = array('response' => 'ok','data'=>$respuesta);
            }//end if($respuesta)
            else
            {
                $data = array('response' => 'error','message'=>'No se encuentra la respuesta, verifica los campos');

            }//end else
        }//end if($post_add)
        else
        {
            $data = array('response' => 'error','message'=>'Sin datos');

        }//end else
        $this->response($data);
    }//function get_info_respuesta_post()


    /*
     * obtener respuesta
     *
     * Funcion en cargada de retornar las respuestas
     * acorde al id de un usuario
     */
    public function get_respuesta_post()
    {
        $post_add = $this->post();
        if($post_add)
        {

            $id_user  = $this->post("id_user");

                $respuesta = $this->respuestas_model->where(array('deleted'=>0,'id_usuario'=>$id_user))->find_all();

            if($respuesta)
            {
                $data = array('response' => 'ok','data'=>$respuesta);
            }//end if($respuesta)
            else
            {
                $data = array('response' => 'error','message'=>'No se encuentra la respuesta, verifica los campos');

            }//end else
        }//end if($post_add)
        else
        {
            $data = array('response' => 'error','message'=>'Sin datos');

        }//end else
        $this->response($data);
    }//end function get_respuesta_post()

    /*
     * obtener el id de una respuesta
     *
     * Funcion encargada de retornar solo el id de una respuesta
     * requiere el id de la pregunta
     */
    public function get_id_respuesta_post()
    {
        $post_add = $this->post();
        if($post_add)
        {

            $id_pregunta  = $this->post("id_pregunta");


            $respuesta = $this->respuestas_model->select('id')->where(array('deleted'=>0,'id_pregunta'=>$id_pregunta))->find_all();
            if($respuesta)
            {
                $data = array('response' => 'ok','data'=>$respuesta);
            }//end if($respuesta)
            else
            {
                $data = array('response' => 'error','message'=>'No se encuentra la respuesta, verifica los campos');

            }//end else
        }//end if($post_add)
        else
        {
            $data = array('response' => 'error','message'=>'Sin datos');

        }//end else
        $this->response($data);
    }//end get_id_respuesta_post()

}