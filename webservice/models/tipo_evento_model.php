<?php
class Tipo_evento_model extends MY_Model
{
    /*
    * variables y arrays de validacion a la hora de insertar
    *
    * estas variables se utilizan el controlador
    * para hacer las diferentes validaciones
    */
    protected $table_name   = 'tbl_tipo_evento';
    protected $key          = 'id';
    protected $set_created  = true;
    protected $set_modified = true;
    protected $soft_deletes = true;
    protected $date_format  = 'datetime';


//---------------------------------------------------------------

}