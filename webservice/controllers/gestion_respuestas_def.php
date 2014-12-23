<?php
/**
 * Created by PhpStorm.
 * User: Spark
 * Date: 10/12/2014
 * Time: 01:09 PM
 */

require(APPPATH.'libraries/REST_Controller.php');

class Gestion_respuestas_def extends \REST_Controller
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
        $this->load->model('respuestas_def_model');

    }//end function __construct(){

    /*
     * Agregar respuesta definida
     *
     * Funcion encargada de insertar una respuesta definda en tbl_respuestas_def
     *
     */
    public function add_respuesta_def_post()
    {

        $post_add = $this->post();
        /*verifico que haya datos post*/
        if($post_add)
        {
            $data = array(
                'id_pregunta' => $this->post("id_pregunta"),
                'id_evento'   => $this->post("id_evento"),
                'respuesta'   => $this->post("respuesta")
            );

            /*verifico la insercion*/
            if ($this->respuestas_def_model->insert($data))
            {
                $data = array('response' => 'ok');

            }//end if ($this->respuestas_def_model->insert($data))
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
    }//end function add_respuesta_def_post()


    /*
     * editar respuesta definida
     *
     * funcion encargada de hacer un update de
     * la respuesta definida en la tabla tbl_respuestas_def
     */
    public function update_respuesta_def_post()
    {

        $post_add = $this->post();
        if($post_add)
        {
            $data = array(
                'id_pregunta' => $this->post("id_pregunta"),
                'id_evento'   => $this->post("id_evento"),
                'respuesta'   => $this->post("respuesta")
            );
            /*
             * compruebo la actualizacion en la tabla respuestas
             */

            if ($this->respuestas_def_model->update($this->post('id_respuesta'), $data))
            {

                $data = array('response' => 'ok');


            } //end if ($this->respuestas_def_model->update($this->post('id_respuesta'), $data))
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
    }//end function update_respuesta_def_post()


    /*
     * eliminar respuesta definida
     *
     * funcion encargada de eliminar una respuesta definida
     * es necesario el id para que esto suceda
     */
    public function delete_respuesta_def_post()
    {
        $post_add = $this->post();
        if($post_add)
        {

            $id_respuesta  = $this->post("id_respuesta");


            $respuesta = $this->respuestas_def_model->delete($id_respuesta);
            if($respuesta)
            {
                $data = array('response' => 'ok');
            } //end if($respuesta)
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
    }//end function delete_respuesta_def_post()


    /*
     * obtener info
     *
     * funcion encargada de realizar una busqueda de un id
     * usando el texto el id de la respuesta definida para
     * encotrarla, tambien puede servir para evitar duplicados
     * uso este metodo pues las respuestas definidas pueden repetirse mas el
     * id_evento deberia servir como un control adicional
     */
    public function get_info_respuesta_def_post()
    {
        $post_add = $this->post();
        if($post_add)
        {

            $id_pregunta  = $this->post("id_pregunta");


            $respuesta = $this->respuestas_def_model->where(array('deleted'=>0,'id_pregunta'=>$id_pregunta))->find_all();
            if($respuesta)
            {
                $data = array('response' => 'ok','data'=>$respuesta);
            } //end if($respuesta)
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
    }//function get_info_respuesta_def_post()


    /*
     * obtener respuesta definida
     *
     * Funcion en cargada de retornar las respuestas definidas
     * acorde al id de un evento
     */
    public function get_respuesta_def_post()
    {
        $post_add = $this->post();
        if($post_add)
        {

            $id_evento  = $this->post("id_evento");

                $respuesta = $this->respuestas_def_model->where(array('deleted'=>0,'id_evento'=>$id_evento))->find_all();

            if($respuesta)
            {
                $data = array('response' => 'ok','data'=>$respuesta);
            } //end if($respuesta)
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
    }//end function get_respuesta_def_post()

    /*
     * obtener el id de una respuesta
     *
     * Funcion encargada de retornar solo el id de una respuesta
     * requiere el id de la pregunta
     */
    public function get_id_respuesta_def_post()
    {
        $post_add = $this->post();
        if($post_add)
        {

            $id_pregunta  = $this->post("id_pregunta");


            $respuesta = $this->respuestas_def_model->select('id')->where(array('deleted'=>0,'id_pregunta'=>$id_pregunta))->find_all();
            if($respuesta)
            {
                $data = array('response' => 'ok','data'=>$respuesta);
            } //end if($respuesta)
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
    }//end get_id_respuesta_def_post()

}