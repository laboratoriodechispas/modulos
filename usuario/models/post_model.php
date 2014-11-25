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
            'field' => 'nombre',
            'label' => 'nombre',
            'rules' => 'trim|strip_tags|xss_clean'
        ),
        array(
            'field' => 'apellido_paterno',
            'label' => 'Apellido Paterno',
            'rules' => 'trim|strip_tags|xss_clean'
        ),
        array(
            'field' => 'apellido_materno',
            'label' => 'Apellido Materno',
            'rules' => 'trim|strip_tags|xss_clean'
        ),
        array(
            'field' => 'fecha_nacimiento',
            'label' => 'Fecha Nacimiento',
            'rules' => 'trim|strip_tags|xss_clean'
        ),
        array(
            'field' => 'pais_nacimiento',
            'label' => 'Pais Nacimiento',
            'rules' => 'trim|strip_tags|xss_clean'
        ),
        array(
            'field' => 'residencia',
            'label' => 'Residencia',
            'rules' => 'trim|strip_tags|xss_clean'
        ),
        array(
            'field' => 'direccion',
            'label' => 'Direccion',
            'rules' => 'trim|strip_tags|xss_clean'
        ),
        array(
            'field' => 'colonia',
            'label' => 'Colonia',
            'rules' => 'trim|strip_tags|xss_clean'
        ),
        array(
            'field' => 'delegacion_municipio',
            'label' => 'delegacion_municipio',
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
            'field' => 'email',
            'label' => 'email',
            'rules' => 'trim|strip_tags|xss_clean'
        ),
        array(
            'field' => 'telefono_contacto',
            'label' => 'telefono_contacto',
            'rules' => 'trim|strip_tags|xss_clean'
        ),
        array(
            'field' => 'pass',
            'label' => 'Contraseña',
            'rules' => 'trim|strip_tags|xss_clean'
        ),
        array(
            'field' => 'slug',
            'label' => 'Slug',
            'rules' => 'trim|strip_tags|xss_clean'
        ),

    );

    protected $insert_validation_rules = array(

'nombre'=>'required',
'apellido_paterno'=>'required',
'apellido_materno'=>'required',
'fecha_nacimiento'=>'required',
'pais_nacimiento'=>'required',
'id_estado_residencia'=>'required',
'residencia'=>'required',
'direccion'=>'required',
'id_estado'=>'required',
'colonia'=>'required',
'delegacion_municipio'=>'required',
'cp'=>'required',
'edad'=>'required',
'sexo'=>'required',
'email'=>'required',
'telefono_contacto'=>'required',
'codigo'=>'required',
'slug'=>'required',
'pass'  => 'required'
    );
}
?>