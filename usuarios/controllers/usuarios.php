<?php
class Usuario extends Front_Controller
{

    public function __construct()
    {
        parent::__construct();

        //$this->load->model('post_model');

    }

    //--------------------------------------------------------------------

    public function index()
    {

        $this->load->helper('form');
        Template::render();

    }

}
?>