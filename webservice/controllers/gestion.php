<?php
/**
 * Created by PhpStorm.
 * User: Spark
 * Date: 05/12/2014
 * Time: 10:45 AM
 */

require(APPPATH.'libraries/REST_Controller.php');

class gestion extends \REST_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('users/auth');
        $this->load->model('webservice_model');
    }

} 