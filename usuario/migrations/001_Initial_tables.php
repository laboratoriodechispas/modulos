<?php
class Migration_Initial_tables extends Migration
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

        $this->dbforge->add_field('id_usuario BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT');
        $this->dbforge->add_field('nombre VARCHAR(255) NOT NULL');
        $this->dbforge->add_field('apellido_paterno VARCHAR(255) NOT NULL');
        $this->dbforge->add_field('apellido_materno VARCHAR(255) NOT NULL');
        $this->dbforge->add_field('fecha_nacimiento VARCHAR(255) NOT NULL');
        $this->dbforge->add_field('pais_nacimiento VARCHAR(255) NOT NULL');
        $this->dbforge->add_field('id_estado_residencia VARCHAR(255) NOT NULL');
        $this->dbforge->add_field('residencia VARCHAR(255) NOT NULL');
        $this->dbforge->add_field('direccion VARCHAR(255) NOT NULL');
        $this->dbforge->add_field('id_estado VARCHAR(255) NOT NULL');
        $this->dbforge->add_field('colonia VARCHAR(255) NOT NULL');
        $this->dbforge->add_field('delegacion_municipio VARCHAR(255) NOT NULL');
        $this->dbforge->add_field('cp VARCHAR(255) NOT NULL');
        $this->dbforge->add_field('edad VARCHAR(255) NOT NULL');
        $this->dbforge->add_field('sexo VARCHAR(255) NOT NULL');
        $this->dbforge->add_field('email VARCHAR(255) NOT NULL');
        $this->dbforge->add_field('telefono_contacto VARCHAR(255) NOT NULL');
        $this->dbforge->add_field('codigo VARCHAR(255) NOT NULL');
        $this->dbforge->add_field('status BIGINT(20) UNSIGNED NOT NULL');
        $this->dbforge->add_field('idUser BIGINT(20) UNSIGNED NOT NULL');
        $this->dbforge->add_field('slug VARCHAR(255) NOT NULL');
        $this->dbforge->add_field('created_on DATETIME NOT NULL');
        $this->dbforge->add_field('modified_on DATETIME NULL');
        $this->dbforge->add_field('deleted TINYINT(1) NOT NULL DEFAULT 0');
        $this->dbforge->add_key('id_usuario', TRUE);

        $this->dbforge->create_table('usuarios');

// Create the Permissions
        $this->load->model('permission_model');
        $this->permission_model->insert(array(
            'name'          => 'Bonfire.usuario.View',
            'description'   => 'To view the user menu.',
            'status'        => 'active'
        ));

// Assign them to the admin role
        $this->load->model('role_permission_model');
        $this->role_permission_model->assign_to_role('Administrator', 'Bonfire.usuario.View');
    }

//--------------------------------------------------------------------

    public function down()
    {
        $this->load->dbforge();

        $this->dbforge->drop_table('usuarios');
    }

//--------------------------------------------------------------------

}
?>