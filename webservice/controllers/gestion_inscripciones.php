<?php
/**
 * Created by PhpStorm.
 * User: Spark
 * Date: 15/12/2014
 * Time: 12:52 PM
 */

class gestion_inscripciones extends \REST_Controller
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
        $this->load->model('inscripciones_model');
        $this->load->model('tipo_pago_model');
        $this->load->model('pago_eventos_model');

    }//end function __construct(){

    /**
     * agregar inscripcion
     *
     * Funcion encargada de añadir una inscripcion
     * en la tabla tbl_inscripciones retorna ok si se realiza correctamente
     * o error + el mensaje de error correspondiente
     */
    public function add_inscripcion_post()
    {

        $post_add = $this->post();
        /*verifico que haya datos post*/
        if($post_add)
        {
            $data = array(
                'id_usuario'          => $this->post("id_usuario"),
                'id_evento'           => $this->post("id_evento"),
                'fecha_inscripcion'   => $this->post("fecha_inscripcion"),
                'fuente_subscripcion' => $this->post("fuente_subscripcion"),
                'tipo_pago'           => $this->post("tipo_pago")
            );

            /*verifico la insercion*/
            if ($this->inscripciones_model->insert($data))
            {
                $data = array('response' => 'ok');

            }//if ($this->inscripciones_model->insert($data))
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
    }// end function add_inscripcion_post()

    /*
     * obtiene inscripciones
     *
     * Funcion encargada de traer inscripciones acordes a un evento
     * es necesario el id, devuelve un ok si tiene exito o un error
     * mas el mensaje de error
     */
    public function get_inscripcion_post()
    {

        $post_add = $this->post();
        if($post_add)
        {
            $id_evento = $this->post("id_evento");
            $inscripciones = $this->inscripciones_model->where(array('deleted'=>0,'id_evento'=>$id_evento))->find_all();
            if($inscripciones)
            {

                unset($inscripciones[0]->id);

                $data = array('response' => 'ok','data'=>$inscripciones);
            } //end if($inscripciones)
            else
            {
                $data = array('response' => 'error','message'=>'No se encuentran inscripciones');

            }//end else
        }//end if($post_add)
        else
        {
            $data = array('response' => 'error','message'=>'Sin datos');

        }//end else
        $this->response($data);
    }//end function get_inscripcion_post()

    /*************************pagos********************/

    /**
     * insertar tipo de pago
     *
     * Funcion encargada de insertar un tipo de pago
     *
     */
    public function insert_tipo_pago_post()
    {
        $post_add = $this->post();
        /*verifico que haya datos post*/
        if($post_add)
        {
            $data = array(
                'tipo_pago'      => $this->post("tipo_pago")
            );

            /*verifico la insercion*/
            if ($this->tipo_pago_model->insert($data))
            {
                $data = array('response' => 'ok');

            }//end  if ($this->tipo_pago_model->insert($data))
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
    }//end function insert_tipo_pago_post()

    /**
     * Elimina un tipo de pago
     *
     * Funcion encargada de eliminar un tipo de pago
     * el id del mismo es requerido, solo cambia el estatus
     * delete a 1
     */
    public function delete_tipo_pago_post()
    {
        $post_add = $this->post();
        /*verifico que haya datos post*/
        if($post_add)
        {
            /*verifico la insercion*/
            if ($this->tipo_pago_model->delete($this->post("id_tipo_pago")))
            {
                $data = array('response' => 'ok');

            }//end if ($this->tipo_pago_model->delete($this->post("id_tipo_pago")))
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
    }//end function delete_tipo_pago_post()

    /**
     * obtiene todos los metodos de pago
     *
     * Funcion encargada de obtener todos los metodos de pago
     * existentes dentro de la tabla tipo pago
     */
    public function get_all_tipo_pago_post(){
        $post_add = $this->post();
        if($post_add)
        {

            $inscripciones = $this->tipo_pago_model->where(array('deleted'=>0))->find_all();

            if($inscripciones)
            {

                $data = array('response' => 'ok','data'=>$inscripciones);
            } // end if($inscripciones)
            else
            {
                $data = array('response' => 'error','message'=>'No se encuentran inscripciones');

            }//end else
        }//end if($post_add)
        else
        {
            $data = array('response' => 'error','message'=>'Sin datos');

        }//end else
        $this->response($data);
    }

    /******************************SUBDIVISION ASOCIACION DE PAGOS CON EVENTOS*****************************/

    /**
     * asocia un tipo de pago a un evento
     *
     * Funcion encargada de asociar un tipo de evento a
     * un tipo de pago(oxxo tarjeta, bla bla) es necesario el
     * id del evento y del tipo de pago
     */
    public function asociar_tipo_pago_post()
    {
        $post_add = $this->post();
        /*verifico que haya datos post*/
        if($post_add)
        {
            $data = array(
                'id_evento'      => $this->post("id_evento"),
                'id_tipo_pago'   => $this->post("id_tipo_pago")
            );

            /*verifico la insercion*/
            if ($this->pago_eventos_model->insert($data))
            {
                $data = array('response' => 'ok');

            }// end  if ($this->pago_eventos_model->insert($data))
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
    }//end function asociar_tipo_pago_post()


    /**
     * obtener el tipo de pago
     *
     * Funcion encargada de obtener un tipo de pago acorde al evento
     * (si el evento tiene varios tipos de pago los trae)
     * es necesario el id del evento, la respuesta devuelta es un ok o un
     * error con el mensaje del mismo
     */
    public function get_asociacion_pago_post()
    {
        $post_add = $this->post();
        if($post_add)
        {
            $id_evento = $this->post("id_evento");

            $inscripciones = $this->pago_eventos_model->where(array('bf_tbl_pago_eventos.deleted'=>0,'id_evento'=>$id_evento))->
            join('bf_tbl_tipo_pago','bf_tbl_tipo_pago.id = id_tipo_pago')->find_all();

            if($inscripciones)
            {


                $data = array('response' => 'ok','data'=>$inscripciones);
            } // end if($inscripciones)
            else
            {
                $data = array('response' => 'error','message'=>'No se encuentran tipos de pago');

            }//end else
        }//end if($post_add)
        else
        {
            $data = array('response' => 'error','message'=>'Sin datos');

        }//end else
        $this->response($data);
    }//end function get_tipo_pago_post()


/**
 * quitar asociaciacion
 *
 * Funcion encargada de quitar una asociacion de pago/evento
 * no elimina el campo solo cambia el status delete a 1
 */

    public function delete_asociacion_post(){
        $post_add = $this->post();
        /*verifico que haya datos post*/
        if($post_add)
        {


            /*verifico la insercion*/
            if ($this->pago_eventos_model->delete($this->post("id_asociacion")))
            {
                $data = array('response' => 'ok');

            }//end if ($this->pago_eventos_model->delete($this->post("id_asociacion")))
            else
            {
                $data = array('response' => 'error','message'=>'No se pudo eliminar');

            }//end else
        }//end if($post_add) {
        else
        {
            $data = array('response' => 'error','message'=>'Sin datos');

        }//end else
        // Create post object
        $this->response($data);
    }
} 