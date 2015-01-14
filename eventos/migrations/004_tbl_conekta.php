<?php
class Migration_Tbl_Conekta extends Migration
{

    public function up()
    {
        $this->load->dbforge();

        $this->dbforge->add_field('id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT');
        $this->dbforge->add_field('id_inscripcion BIGINT(20) UNSIGNED NOT NULL ');
        $this->dbforge->add_field('id_Evento BIGINT(20) UNSIGNED NOT NULL ');
        $this->dbforge->add_field('correo VARCHAR(255) NOT NULL');
        $this->dbforge->add_field('id_transaccion VARCHAR(255) ');
        $this->dbforge->add_field('codigo_barras VARCHAR(255) ');
        $this->dbforge->add_field('url_codigo_barras VARCHAR(255) ');
        $this->dbforge->add_field('referencia VARCHAR(255) ');
        $this->dbforge->add_field('status INT(11) NOT NULL');
        $this->dbforge->add_field('cantidad_pago VARCHAR(255) NOT NULL');
        $this->dbforge->add_field('fecha_operacion VARCHAR(255) NOT NULL');
        $this->dbforge->add_field('fecha_expiracion VARCHAR(255) ');
        $this->dbforge->add_field('pais VARCHAR(255) NOT NULL');
        $this->dbforge->add_field('origen VARCHAR(255) ');
        $this->dbforge->add_field('numero_servicio VARCHAR(255)');
        $this->dbforge->add_field('created_on DATETIME NOT NULL');
        $this->dbforge->add_field('modified_on DATETIME NULL');
        $this->dbforge->add_field('deleted TINYINT(1) NOT NULL DEFAULT 0');
        $this->dbforge->add_key('id', TRUE);

        $this->dbforge->create_table('tbl_conekta');

// Create the Permissions
        $this->load->model('permission_model');
        $this->permission_model->insert(array(
            'name'          => 'Bonfire.tbl_conekta.View',
            'description'   => 'To view the blog menu.',
            'status'        => 'active'
        ));

// Assign them to the admin role
        $this->load->model('role_permission_model');
        $this->role_permission_model->assign_to_role('Administrator', 'Bonfire.tbl_conekta.View');
    }

//--------------------------------------------------------------------

    public function down()
    {
        $this->load->dbforge();

        $this->dbforge->drop_table('tbl_conekta');
    }

//--------------------------------------------------------------------

}
?>