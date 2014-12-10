<?php
class Migration_respuestas_table extends Migration
{
    /*
     * funcion para subir las tablas
     *
     * esta funcion inicializa la migracion crea las tablas
     * en este caso la tabla usuarios y los campos que se
     * requieren para la misma
     */

    public function up()
    {
        $this->load->dbforge();

        $this->dbforge->add_field('id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT');
        $this->dbforge->add_field('id_pregunta INT(11) NOT NULL');
        $this->dbforge->add_field('id_evento INT(11) NOT NULL');
        $this->dbforge->add_field('id_usuario INT(11) NOT NULL');
        $this->dbforge->add_field('respuesta VARCHAR(255) NOT NULL');
        $this->dbforge->add_field('created_on DATETIME NOT NULL');
        $this->dbforge->add_field('modified_on DATETIME NULL');
        $this->dbforge->add_field('deleted TINYINT(1) NOT NULL DEFAULT 0');
        $this->dbforge->add_key('id', TRUE);

        $this->dbforge->create_table('tbl_respuestas');

// Create the Permissions
        $this->load->model('permission_model');
        $this->permission_model->insert(array(
            'name'          => 'Bonfire.tbl_respuestas.View',
            'description'   => 'To view the user menu.',
            'status'        => 'active'
        ));

// Assign them to the admin role
        $this->load->model('role_permission_model');
        $this->role_permission_model->assign_to_role('Administrator', 'Bonfire.tbl_respuestas.View');
    }

//--------------------------------------------------------------------

    public function down()
    {
        $this->load->dbforge();

        $this->dbforge->drop_table('tbl_respuestas');
    }

//--------------------------------------------------------------------

}
?>