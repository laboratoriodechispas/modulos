<?php
class Migration_perfiles_table extends Migration
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
        $this->dbforge->add_field('id_usuario INT(11) NOT NULL');
        $this->dbforge->add_field('id_facebook VARCHAR(255) NOT NULL');
        $this->dbforge->add_field('email VARCHAR(255) NOT NULL');
        $this->dbforge->add_field('password VARCHAR(255) NOT NULL');
        $this->dbforge->add_field('id_talla_playera VARCHAR(255) NOT NULL');
        $this->dbforge->add_field('id_entrenamiento VARCHAR(255) NOT NULL');
        $this->dbforge->add_field('id_marca_tennis VARCHAR(255) NOT NULL');
        $this->dbforge->add_field('id_marca_ropa VARCHAR(255) NOT NULL');
        $this->dbforge->add_field('id_marca_bicicleta VARCHAR(255) NOT NULL');
        $this->dbforge->add_field('id_carrera_preferida VARCHAR(255) NOT NULL');
        $this->dbforge->add_field('id_medio VARCHAR(255) NOT NULL');
        $this->dbforge->add_field('tiempo_aproximado VARCHAR(255) NOT NULL');
        $this->dbforge->add_field('equipo VARCHAR(255) NOT NULL');
        $this->dbforge->add_field('status INT(11) NOT NULL');
        $this->dbforge->add_field('activo INT(11) NOT NULL');
        $this->dbforge->add_field('created_on DATETIME NOT NULL');
        $this->dbforge->add_field('modified_on DATETIME NULL');
        $this->dbforge->add_field('deleted TINYINT(1) NOT NULL DEFAULT 0');
        $this->dbforge->add_key('id', TRUE);

        $this->dbforge->create_table('tbl_perfiles');

// Create the Permissions
        $this->load->model('permission_model');
        $this->permission_model->insert(array(
            'name'          => 'Bonfire.tbl_perfiles.View',
            'description'   => 'To view the user menu.',
            'status'        => 'active'
        ));

// Assign them to the admin role
        $this->load->model('role_permission_model');
        $this->role_permission_model->assign_to_role('Administrator', 'Bonfire.tbl_perfiles.View');
    }

//--------------------------------------------------------------------

    public function down()
    {
        $this->load->dbforge();

        $this->dbforge->drop_table('tbl_perfiles');
    }

//--------------------------------------------------------------------

}
?>