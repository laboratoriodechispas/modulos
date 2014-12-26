<?php
/**
 * Created by PhpStorm.
 * User: Spark
 * Date: 09/12/2014
 * Time: 12:40 PM
 */

class Eventos_new_model  extends  MY_Model{
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
} 