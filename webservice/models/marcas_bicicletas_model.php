<?php
class Marcas_bicicletas_model extends MY_Model
{
    /*
    * variables y arrays de validacion a la hora de insertar
    *
    * estas variables se utilizan el controlador
    * para hacer las diferentes validaciones
    */
    protected $table_name   = 'tbl_marcas_bicicletas';
    protected $key          = 'id';
    protected $set_created  = true;
    protected $set_modified = true;
    protected $soft_deletes = true;
    protected $date_format  = 'datetime';


//---------------------------------------------------------------

}