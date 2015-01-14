
<?php
class Migration_Tbl_Convocatorias extends Migration
{

    public function up()
    {
        $this->load->dbforge();

        $this->dbforge->add_field('id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT');
        $this->dbforge->add_field('id_evento BIGINT(20) UNSIGNED NOT NULL ');
        $this->dbforge->add_field('id_tit_convocatoria BIGINT(20) UNSIGNED NOT NULL ');
        $this->dbforge->add_field('contenido TEXT NULL');
        $this->dbforge->add_field('created_on DATETIME NOT NULL');
        $this->dbforge->add_field('modified_on DATETIME NULL');
        $this->dbforge->add_field('deleted TINYINT(1) NOT NULL DEFAULT 0');
        $this->dbforge->add_key('id', TRUE);

        $this->dbforge->create_table('tbl_convocatorias');

// Create the Permissions
        $this->load->model('permission_model');
        $this->permission_model->insert(array(
            'name'          => 'Bonfire.tbl_convocatorias.View',
            'description'   => 'To view the blog menu.',
            'status'        => 'active'
        ));

// Assign them to the admin role
        $this->load->model('role_permission_model');
        $this->role_permission_model->assign_to_role('Administrator', 'Bonfire.tbl_convocatorias.View');
    }

//--------------------------------------------------------------------

    public function down()
    {
        $this->load->dbforge();

        $this->dbforge->drop_table('tbl_convocatorias');
    }

//--------------------------------------------------------------------

}
?>