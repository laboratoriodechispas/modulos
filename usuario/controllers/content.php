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

    //--------------------------------------------------------------------

    public function index()
    {
        $posts = $this->post_model->where('deleted', 0)->find_all();

        Template::set('posts', $posts);

        Template::render();
    }

    //--------------------------------------------------------------------
    public function create()
    {
        if ($this->input->post('submit')) {
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

            if ($this->db->insert('usuarios',$data)) {
                Template::set_message('Tu blog fue subido correctamente.', 'success');
                redirect(SITE_AREA . 'usuario');
            }
        }

        Template::set('toolbar_title', 'crear nuevo usuario');
        Template::set_view('index');
        Template::render();
    }


    public function edit_post($id = null)
    {
        if ($this->input->post('submit')) {
            $data = array(
                'title' => $this->input->post('title'),
                'slug' => $this->input->post('slug'),
                'body' => $this->input->post('body')
            );

            if ($this->post_model->update($id, $data)) {
                Template::set_message('Usuario modificado con exito.', 'success');
                redirect(SITE_AREA . 'usuarios');
            }
        }

        Template::set('post', $this->post_model->find($id));

        Template::set('toolbar_title', 'Edit Post');
        Template::set_view('user_form');
        Template::render();
    }
}
?>