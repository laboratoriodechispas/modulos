<?php
class Eventos_model extends MY_Model
{
    /*
    * variables y arrays de validacion a la hora de insertar
    *
    * estas variables se utilizan el controlador
    * para hacer las diferentes validaciones
    */
    protected $table_name   = 'tbl_eventos';
    protected $key          = 'id';
    protected $set_created  = true;
    protected $set_modified = true;
    protected $soft_deletes = true;
    protected $date_format  = 'datetime';


//---------------------------------------------------------------

    protected $validation_rules = array(
        array(
            'field' => 'nombre_evento',
            'label' => 'Nombre',
            'rules' => 'trim|strip_tags|xss_clean|is_unique[tbl_eventos.nombre_evento]'
        ),

        array(
            'field' => 'fecha',
            'label' => 'Fecha',
            'rules' => 'trim|strip_tags|xss_clean'
        ),

        array(
            'field' => 'ruta',
            'label' => 'Ruta',
            'rules' => 'trim|strip_tags|xss_clean'
        ),

        array(
            'field' => 'img_thumb',
            'label' => 'Imagen miniatura',
            'rules' => 'trim|strip_tags|xss_clean'
        ),

        array(
            'field' => 'img_destacada',
            'label' => 'Imagen destacada',
            'rules' => 'trim|strip_tags|xss_clean'
        ),

        array(
            'field' => 'convocatoria',
            'label' => 'Convocatoria',
            'rules' => 'trim|strip_tags|xss_clean'
        ),

        array(
            'field' => 'tipo_evento',
            'label' => 'Tipo de evento',
            'rules' => 'trim|strip_tags|xss_clean|numeric'
        ),

        array(
            'field' => 'descripcion',
            'label' => 'Descripcion',
            'rules' => 'trim|strip_tags|xss_clean'
        )
    );

    protected $insert_validation_rules = array(
        'nombre_evento' => 'required',
        'fecha'         => 'required',
        'img_thumb'     => 'required',
        'img_destacada' => 'required',
        'convocatoria'  => 'required',
        'tipo_evento'   => 'required',
        'descripcion'   => 'required'

    );
}