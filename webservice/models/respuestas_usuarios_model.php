<?php
class Respuestas_usuarios_model extends MY_Model
{
    /*
    * variables y arrays de validacion a la hora de insertar
    *
    * estas variables se utilizan el controlador
    * para hacer las diferentes validaciones
    */
    protected $table_name   = 'tbl_respuestas_usuarios';
    protected $key          = 'id';
    protected $set_created  = true;
    protected $set_modified = true;
    protected $soft_deletes = true;
    protected $date_format  = 'datetime';

//---------------------------------------------------------------

}