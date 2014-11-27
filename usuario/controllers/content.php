<?php
class Content extends Admin_Controller
{
    /*
     * funcion constructor
     *
     *
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->model('post_model');

        Template::set('toolbar_title', 'Manage Your Blog');
        Template::set_block('sub_nav', 'content/sub_nav');
    }

}
?>