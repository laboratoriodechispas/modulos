<?php
class Blog extends Front_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('post_model');
        $this->load->library("Nusoap_library");
    }

    //--------------------------------------------------------------------

    public function index()
    {



    }
}

?>