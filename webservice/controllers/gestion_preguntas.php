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
        $this->load->model('preguntas_model');

    }//end function __construct(){

    /*
     * Agregar pregunta
     *
     * Funcion encargada de insertar una pregunta en tbl_preguntas
     * necesita del id del evento
     */
    public function add_pregunta_post()
    {

        $post_add = $this->post();
        /*verifico que haya datos post*/
        if($post_add)
        {
            $data = array(

                'pregunta'  => $this->post("pregunta"),
                'id_evento' => $this->post("id_evento")
            );
            /*verifico la insercion*/
            if ($this->preguntas_model->insert($data))
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
                'pregunta'    => $this->post("pregunta")


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
        $this->response($data);
    }

    /*
     * obtener info
     *
     * funcion encargada de realizar una busqueda de un id
     * usando el texto de la pregunta y el id del evento para
     * encotrarla, tambien puede servir para evitar duplicados
     * uso este metodo pues las preguntas pueden repetirse mas el
     * id_evento deberia servir como un control adicional
     */

    public function get_info_pregunta_post(){
        $post_add = $this->post();
        if($post_add)
        {
            $data = array(
                'id_evento' => $this->post("id_evento"),
                'pregunta'    => $this->post("pregunta"),


            );
            /*
             * compruebo la actualizacion en la tabla eventos
             */

            if ($this->preguntas_model->where($this->post('id_evento'), $data))
            {

                $data = array('response' => 'ok');


            } // if ($this->eventos_model->update($this->post('id'), $data)) {
            else
            {
                $data = array('response' => 'error','message'=>'error en update verifica los campos');

            }//end else
        }//end if($post_add)
        $this->response($data);
    }
}