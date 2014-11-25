<?php
class Registro extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function ingresar()
    {
        //ingreso de datos.
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

        $this->db->insert('usuarios', $data);
        return  $this->db->insert_id();

    }

}
?>