<?php
class Convocatorias_model extends MY_Model
{

    protected $table_name   = 'tbl_convocatorias';
    protected $key          = 'id';
    protected $set_created  = true;
    protected $set_modified = true;
    protected $soft_deletes = true;
    protected $date_format  = 'datetime';

}
?>