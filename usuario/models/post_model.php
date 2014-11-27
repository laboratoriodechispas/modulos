<?php
class Post_model extends MY_Model
{

    protected $table_name   = 'usuarios';
    protected $key          = 'id_usuario';
    protected $set_created  = true;
    protected $set_modified = true;
    protected $soft_deletes = true;
    protected $date_format  = 'datetime';


    //---------------------------------------------------------------
    protected $validation_rules = array(
        array(
            'field' => 'email',
            'label' => 'email',
            'rules' => 'trim|strip_tags|xss_clean'
            ),

        array(
            'field' => 'username',
            'label' => 'username',
            'rules' => 'trim|strip_tags|xss_clean'
            ),

        array(
            'field' => 'password',
            'label' => 'password',
            'rules' => 'trim|strip_tags|xss_clean|matches[pass_confirm]'
            ),

        array(
            'field' => 'pass_confirm',
            'label' => 'confirm',
            'rules' => 'trim|strip_tags|xss_clean'
            ),

        array(
            'field' => 'nombre',
            'label' => 'nombre',
            'rules' => 'trim|strip_tags|xss_clean'
            ),

        array(
            'field' => 'apellido_paterno',
            'label' => 'apellido paterno',
            'rules' => 'trim|strip_tags|xss_clean'
            ),

        array(
            'field' => 'apellido_materno',
            'label' => 'apellido materno',
            'rules' => 'trim|strip_tags|xss_clean'
            ),

        array(
            'field' => 'fecha_nacimiento',
            'label' => 'fecha nacimiento',
            'rules' => 'trim|strip_tags|xss_clean'
            ),

        array(
            'field' => 'pais_nacimiento',
            'label' => 'pais nacimiento',
            'rules' => 'trim|strip_tags|xss_clean'
            ),

        array(
            'field' => 'residencia',
            'label' => 'residencia',
            'rules' => 'trim|strip_tags|xss_clean'
            ),

        array(
            'field' => 'direccion',
            'label' => 'direccion',
            'rules' => 'trim|strip_tags|xss_clean'
            ),

        array(
            'field' => 'colonia',
            'label' => 'colonia',
            'rules' => 'trim|strip_tags|xss_clean'
            ),

        array(
            'field' => 'delegacion_municipio',
            'label' => 'delegacion municipio',
            'rules' => 'trim|strip_tags|xss_clean'
            ),

        array(
            'field' => 'cp',
            'label' => 'cp',
            'rules' => 'trim|strip_tags|xss_clean'
            ),

        array(
            'field' => 'edad',
            'label' => 'edad',
            'rules' => 'trim|strip_tags|xss_clean'
            ),

        array(
            'field' => 'sexo',
            'label' => 'sexo',
            'rules' => 'trim|strip_tags|xss_clean'
            ),

        array(
            'field' => 'telefono_contacto',
            'label' => 'telefono contacto',
            'rules' => 'trim|strip_tags|xss_clean'
            )

    );

    protected $insert_validation_rules = array(
        'email'                 => 'required',
        'username'              => 'required',
        'password'              => 'required',
        'pass_confirm'          => 'required',
        'nombre'                => 'required',
        'apellido_paterno'      => 'required',
        'apellido_materno'      => 'required',
        'fecha_nacimiento'      => 'required',
        'pais_nacimiento'       => 'required',
        'residencia'            => 'required',
        'direccion'             => 'required',
        'colonia'               => 'required',
        'delegacion_municipio'  => 'required',
        'cp'                    => 'required',
        'edad'                  => 'required',
        'sexo'                  => 'required',
        'telefono_contacto'     => 'required'

    );
}
?>