<?php
/**
 * Created by PhpStorm.
 * User: Spark
 * Date: 02/12/2014
 * Time: 02:04 PM
 */

require(APPPATH.'libraries/REST_Controller.php');

class webservice extends \REST_Controller{

    public function __construct()
    {
       parent::__construct();
        $this->load->library('users/auth');
        $this->load->model('webservice_model');
    }

public function usuarios(){
    new users();
}


}

/**********************
 * metodos adicionales
 **********************/


/*
 * metodos put, get y delete si llegan a ser usados
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
 function webservice_get()
{
    $data = array('returned: '. $this->get('id'));
    $this->response($data);
}
*/
