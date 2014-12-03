<?php
/**
 * Created by PhpStorm.
 * User: Spark
 * Date: 02/12/2014
 * Time: 02:04 PM
 */
require(APPPATH.'libraries/REST_Controller.php');

class webservice extends REST_Controller{

    public function __construct(){
       parent::__construct();
        $this->load->library('users/auth');

    }

    /*
     * Funcion buscar usuario
     *
     * funcion encargada de buscar un usuario por su id via get
     */
    function buscarUser_get()
    {

        $user = $this->user_model->find($this->get('id'));
        if($user){
            $data = $user;
            $this->response($data);
        }else{
            $data = array('response'=>'error');
            $this->response($data);
        }

    }
    /*
         * Funcion buscar usuario
         *
         * funcion encargada de buscar un usuario por su id via post
         */
    function buscarUser_post()
    {
        $user = $this->user_model->find($this->post('id'));
        if($user){
            $data = $user;
            $this->response($data);
        }else{
            $data = array('response'=>'error');
            $this->response($data);
        }

    }

    /*
     * metodos put y delete si llegan a ser usados
     function webservice_put()
    {
        $data = array('returned: '. $this->put('id'));
        $this->response($data);
    }

    function webservice_delete()
    {
        $data = array('returned: '. $this->delete('id'));
        $this->response($data);
    }
*/


} 