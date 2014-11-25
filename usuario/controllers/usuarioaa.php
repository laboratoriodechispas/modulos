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

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $validation_rules = array(
        array(
            'field' => 'nombre',
            'label' => 'nombre'
        ),
        array(
            'field' => 'apellido_paterno',
            'label' => 'Apellido Paterno'
        ),
        array(
            'field' => 'apellido_materno',
            'label' => 'Apellido Materno'
        ),
        array(
            'field' => 'fecha_nacimiento',
            'label' => 'Fecha Nacimiento'
        ),
        array(
            'field' => 'pais_nacimiento',
            'label' => 'Pais Nacimiento'
        ),
        array(
            'field' => 'residencia',
            'label' => 'Residencia'
        ),
        array(
            'field' => 'direccion',
            'label' => 'Direccion'
        ),
        array(
            'field' => 'colonia',
            'label' => 'Colonia'
        ),
        array(
            'field' => 'delegacion_municipio',
            'label' => 'delegacion_municipio'
        ),
        array(
            'field' => 'cp',
            'label' => 'cp'
        ),
        array(
            'field' => 'edad',
            'label' => 'edad'
        ),
        array(
            'field' => 'sexo',
            'label' => 'sexo'
        ),
        array(
            'field' => 'email',
            'label' => 'email'
        ),
        array(
            'field' => 'telefono_contacto',
            'label' => 'telefono_contacto'
        ),
        array(
            'field' => 'pass',
            'label' => 'Contraseña'
        ),
        array(
            'field' => 'slug',
            'label' => 'Slug'
        )

    );

        //validación de formulario
        $this->form_validation->set_rules($validation_rules, 'required');

        if ($this->form_validation->run() == FALSE)
        {
            echo ":D";
            $this->load->view('index');
        }
        else
        {
            //insertar en la base de datos

        }
    }

    //--------------------------------------------------------------------

}
?>