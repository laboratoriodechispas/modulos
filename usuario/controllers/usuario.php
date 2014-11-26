<?php
class Usuario extends Front_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('post_model');

    }

    //--------------------------------------------------------------------

    public function index()
    {
        $this->load->helper('typography');
        $this->load->helper('form');
        $this->output->set_status_header('404');
        $this->load->view('404');


    }
    /*
     * funcion encargada de agregar usuarios
     *
     * Esta es la funcion que se encarga de la insersion a la base de datos
     * de los datos adicionales del usuario
     *
     */
    public function add()
    {

        $this->load->helper('typography');
        $this->load->helper('form');
        $this->load->model('post_model');
        $this->load->library('users/auth');

        $post_add = $this->input->post();

        if (!empty($post_add)) {

            $data = array(
                'nombre'               => $this->input->post('nombre'),
                'apellido_paterno'     => $this->input->post('apellido_paterno'),
                'apellido_materno'     => $this->input->post('apellido_materno'),
                'fecha_nacimiento'     => $this->input->post('fecha_nacimiento'),
                'pais_nacimiento'      => $this->input->post('pais_nacimiento'),
                'residencia'           => $this->input->post('residencia'),
                'direccion'            => $this->input->post('direccion'),
                'colonia'              => $this->input->post('colonia'),
                'delegacion_municipio' => $this->input->post('delegacion_municipio'),
                'cp'                   => $this->input->post('cp'),
                'edad'                 => $this->input->post('edad'),
                'sexo'                 => $this->input->post('sexo'),
                'email'                => $this->input->post('email'),
                'telefono_contacto'    => $this->input->post('telefono_contacto'),
                'id_estado_residencia' => 10,
                'id_estado'            => 10,
                'codigo'               => 10,
                'status'               => 10,
                'idUser'               => 10,
                'slug'                 => 'abel'
            );
            $usuario = array(
                'email'     =>  $this->input->post('email'),
                'username'  =>  $this->input->post('username'),
                'password'  =>  $this->input->post('password')
            );
            if ($this->db->insert('usuarios',$data) && $this->user_model->insert($usuario)) {
                Template::set_message('Dado de alta correctamente.', 'success');
                redirect('usuario/login');
            }

        }

        Template::set('toolbar_title', 'crear nuevo usuario');
        Template::set_view('add');
        Template::render();
    }
    //--------------------------------------------------------------------
    /*
     * funcion encargada de mostrar el login
     *
     * Esta es la funcion encargada del login al sistema
     *
     */
    public function login()
    {
        $this->load->library('users/auth');
        $this->load->helper('form');
        Template::set_view('entrar');
        Template::render();

    }
}
?>