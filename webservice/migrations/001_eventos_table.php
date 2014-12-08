<?php
class Migration_eventos_table extends Migration
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
        $this->dbforge->add_field('id_requerimiento INT(5) NOT NULL');
        $this->dbforge->add_field('nombre_evento VARCHAR(255) NOT NULL');
        $this->dbforge->add_field('descripcion TEXT NOT NULL');
        $this->dbforge->add_field('fecha VARCHAR(255) NOT NULL');
        $this->dbforge->add_field('ruta VARCHAR(255) NOT NULL');
        $this->dbforge->add_field('img_thumb VARCHAR(255) NOT NULL');
        $this->dbforge->add_field('img_destacada VARCHAR(255) NOT NULL');
        $this->dbforge->add_field('convocatoria TEXT NOT NULL');
        $this->dbforge->add_field('tipo_evento INT(5) NOT NULL');
        $this->dbforge->add_field('id_organizador INT(11) NOT NULL');
        $this->dbforge->add_field('id_post INT(10) NOT NULL');
        $this->dbforge->add_field('status INT(1) NOT NULL');
        $this->dbforge->add_field('slug VARCHAR(255) NOT NULL');
        $this->dbforge->add_field('created_on DATETIME NOT NULL');
        $this->dbforge->add_field('modified_on DATETIME NULL');
        $this->dbforge->add_field('deleted TINYINT(1) NOT NULL DEFAULT 0');
        $this->dbforge->add_key('id', TRUE);

        $this->dbforge->create_table('tbl_eventos');

// Create the Permissions
        $this->load->model('permission_model');
        $this->permission_model->insert(array(
            'name'          => 'Bonfire.tbl_eventos.View',
            'description'   => 'To view the user menu.',
            'status'        => 'active'
        ));

// Assign them to the admin role
        $this->load->model('role_permission_model');
        $this->role_permission_model->assign_to_role('Administrator', 'Bonfire.tbl_eventos.View');
    }

//--------------------------------------------------------------------

    public function down()
    {
        $this->load->dbforge();

        $this->dbforge->drop_table('tbl_eventos');
    }

//--------------------------------------------------------------------

}
?>