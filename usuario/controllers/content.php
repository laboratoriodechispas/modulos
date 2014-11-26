<?php
class Content extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('post_model');

        Template::set('toolbar_title', 'Administrar Usuario');
        Template::set_block('sub_nav', 'sub_nav');
    }

}
?>