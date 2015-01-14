<?php
class Tit_Convocatoria_model extends MY_Model
{

    protected $table_name   = 'tbl_tit_convocatoria';
    protected $key          = 'id';
    protected $set_created  = true;
    protected $set_modified = true;
    protected $soft_deletes = true;
    protected $date_format  = 'datetime';

}
?>