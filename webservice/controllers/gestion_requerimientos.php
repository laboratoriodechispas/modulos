<?php
/**
 * Created by PhpStorm.
 * User: Spark
 * Date: 05/12/2014
 * Time: 10:45 AM
 */

require(APPPATH.'libraries/REST_Controller.php');

class Gestion_requerimientos extends \REST_Controller{
    /*
     * constructor
     *
     * funcion encargada de cargar los modelos que seran utilizados en
     * el proceso
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('requerimientos_model');
        $this->load->model('eventos_model');

    }//end function __construct(){


    /*
     * traer todos los eventos
     *
     * Funcion encargada de traer todos los eventos
     * (todos) que no tengan estatus delete
     */
    public function get_requerimientos_post()
    {

        $requerimientos = $this->requerimientos_model->where(array('deleted'=> 0,'id_evento'=>(int)$this->post('id_evento')))->find_all();


        $data = array('response' => 'ok','data'=>$requerimientos);
        $this->response($data);
    }// end get_all_evento_post()



}