<?php

class Usuario extends Front_Controller
{
    /*
     * funcion constructor
     *
     * Esta funcion se encarga de precargar el modelo que a de ser usado
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->model('post_model');
        $this->load->model('update_model');
        $this->load->helper('form');
        $this->load->library('users/auth');
        $this->load->library('form_validation');
        $this->load->helper('typography');
    }

    //--------------------------------------------------------------------
    /*
     * funcion index
     *
     * Esta funcion se encarga de mostrar la pantalla principal de usuarios
     * sin embargo no existe tal cosa es decir; el modulo usuarios es inutil
     * sin los demas modulos por eso muestra la pantalla 404.
     */
    public function index()
    {

        $this->load->helper('typography');
        $this->output->set_status_header('404');
        $this->load->view('404');

    }
    //--------------------------------------------------------------------
    /*
     * funcion encargada de agregar usuarios
     *
     * Esta es la funcion que se encarga de la insersion a la base de datos
     * y de los datos adicionales del usuario
     *
     */
    public function agregar()
    {

        $post_add = $this->input->post();
        /*
         * verifico que exista un envio de datos, de no ser asi solo cargo la
         * pantalla de registro
         */
        if (!empty($post_add)) {

                $data = array(
                    'nombre'               => $this->input->post('nombre'),
                    'apellido_paterno'     => $this->input->post('apellido_paterno'),
                    'apellido_materno'     => $this->input->post('apellido_materno'),
                    'fecha_nacimiento'     => $this->input->post('fecha_nacimiento'),
                    'pais_nacimiento'      => $this->input->post('pais_nacimiento'),
                    'residencia'           => $this->input->post('residencia'),
                    'direccion'            => $this->input->post('direccion'),
                    'colonia'              => $this->input->post('colonia'),
                    'delegacion_municipio' => $this->input->post('delegacion_municipio'),
                    'cp'                   => $this->input->post('cp'),
                    'edad'                 => $this->input->post('edad'),
                    'sexo'                 => $this->input->post('sexo'),
                    'email'                => $this->input->post('email'),
                    'telefono_contacto'    => $this->input->post('telefono_contacto'),
                    'id_estado_residencia' => 10,
                    'id_estado'            => 10,
                    'codigo'               => 10,
                    'status'               => 10,
                    'idUser'               => 0,
                    'slug'                 => 'abel'
                );
            /*
             * mensajes traducidos al español
             */
            $this->form_validation->set_message('required','El campo %s es obligatorio.');
            $this->form_validation->set_message('matches','Los campos %s y %s no coinciden');
            $this->form_validation->set_message('numeric','El campo %s debe ser numerico');

            /*
             * compruebo la insercion en la tabla usuarios creada por mi
             */
                if ($this->post_model->insert($data)) {
                    $usuario = array(
                        'email'     =>  $this->input->post('email'),
                        'username'  =>  $this->input->post('username'),
                        'password'  =>  $this->input->post('password')
                    );
                    /*
                     * compruebo la insercion a la tabla usuarios de bonfire
                     */
                    if($this->user_model->insert($usuario)) {

                        $idUsuario = $this->user_model->find_by('email',$this->input->post('email'));
                        $idTarjet  = $this->post_model->find_by('email',$this->input->post('email'));

                        /*
                         * ejecuto la funcion update para agregar el id del usuario de bonfire
                         * a la tabla de usuarios creada por mi
                         */
                        if($this->updateUsuario($idUsuario->id,$idTarjet->id_usuario)) {
                            Template::set_message('Dado de alta correctamente.', 'success');
                            redirect('usuario/login');

                            /*
                             * sino hace el update lo vuelvo a ejecutar
                             */
                        }elseif($this->updateUsuario($idUsuario->id,$idTarjet->id_usuario)){//if($this->updateUsuario($idUsuario->id,$idTarjet->id_usuario)) {
                            Template::set_message('Dado de alta correctamente.', 'success');
                            redirect('usuario/login');
                        }

                    }else{//if($this->user_model->insert($usuario)) {
                        Template::set_message('Ha ocurrido un error.', 'error');
                        redirect(current_url());
                    }

                }else{//if ($this->post_model->insert($data)) {
                    Template::set_message('Ha ocurrido un error.', 'error');
                }


        }




        Template::set('toolbar_title', 'crear nuevo usuario');
        Template::set_view('agregar');
        Template::render();
    }
    //--------------------------------------------------------------------
    /*
     * funcion encargada de mostrar el login
     *
     * Esta es la funcion encargada del login al sistema
     * lo unico que hace es cargar una vista views/entrar
     *
     */
    public function entrar()
    {
        $post_add = $this->input->post();

        if (!empty($post_add)) {
            redirect('usuario/perfil');
        }

        Template::set_view('entrar');
        Template::render();


    }
    //--------------------------------------------------------------------
    /*
     * mostrar el formulario de recuperacion
     *
     * Esta funcion carga la vista de recuperar contraseña
     * una vez hecho el submit toda la logica se
     * delega al gestor de usuario de bonfire
     *
     */
    public function recuperar()
    {

        Template::set_view('recuperar_pass');
        Template::render();

    }

    //--------------------------------------------------------------------
    /*
     * mostrar el perfil del usuario
     *
     * Esta funcion se encarga de mostrar el perfil
     * hace un update si es que   se hacen cambios
     */
    public function perfil()
    {


        if ($this->auth->is_logged_in()) {
            $idUser = $this->auth->user_id();
            $tablaUsuario = $this->post_model->find_by('idUser',$idUser);
            $tablaUser = $this->user_model->find($idUser);
        }

        $post_add = $this->input->post();
        /*
         * verifico que exista un envio de datos, de no ser asi solo cargo la
         * pantalla de registro
         */
        if (!empty($post_add)) {
            /*
             * comprueboo que haya mail pues es mi llave principal
             * si viene vacio mando un mensaje y si contiene datos los
             * compruebo con la tabla users de bonfire asignando el resultado
             * a una variable
             *
             */
            if ($this->input->post('email') != "") {

                $user = $this->user_model->find_by('email', $this->input->post('email'));

            } else {

                Template::set_message('Debes ingresar todos los datos.', 'error');
                redirect(current_url());
            }
            /*
             * compruebo si el mail ingresado existe, sino existe en la base
             * de datos le permito el paso
             */
            if ($user) {
                /*
                 * validaciones
                 *
                 * este metodo solo debe usarse en updates
                 * la funcion get rules se encarga de traerme las
                 * validaciones del modelo en este caso update_model
                 */

                $this->form_validation->set_rules($this->update_model->get_validation_rules('insert'));
                /*
                 * mensajes traducidos al español
                 */
                $this->form_validation->set_message('required','El campo %s es obligatorio.');
                $this->form_validation->set_message('matches','Los campos %s y %s no coinciden');
                $this->form_validation->set_message('numeric','El campo %s debe ser numerico');

                if ($this->form_validation->run())
                {
                $data = array(
                    'nombre'               => $this->input->post('nombre'),
                    'apellido_paterno'     => $this->input->post('apellido_paterno'),
                    'apellido_materno'     => $this->input->post('apellido_materno'),
                    'fecha_nacimiento'     => $this->input->post('fecha_nacimiento'),
                    'pais_nacimiento'      => $this->input->post('pais_nacimiento'),
                    'residencia'           => $this->input->post('residencia'),
                    'direccion'            => $this->input->post('direccion'),
                    'colonia'              => $this->input->post('colonia'),
                    'delegacion_municipio' => $this->input->post('delegacion_municipio'),
                    'cp'                   => $this->input->post('cp'),
                    'edad'                 => $this->input->post('edad'),
                    'sexo'                 => $this->input->post('sexo'),
                    'telefono_contacto'    => $this->input->post('telefono_contacto')
                );
                /*
                 * compruebo la actualizacion en la tabla usuarios creada por mi
                 */

                    if ($this->update_model->update($tablaUser->id, $data)) {
                        $pass = $this->input->post('password');
                        /*
                         * verifico que exista la contraseña
                         *
                         * sino hay contraseña lo doy por bueno directamente
                         *
                         */
                        if($pass != ""){
                            $usuario = array(
                                'password' => $this->input->post('password')
                            );
                            /*
                            * compruebo la actualizacion a la tabla usuarios de bonfire
                            */
                            if ($this->user_model->update($idUser, $usuario)) {

                                Template::set_message('Datos actualizados correctamente.', 'success');
                                redirect(current_url());

                            } else {//if($this->user_model->update($usuario)) {
                                Template::set_message('Ha ocurrido un error.', 'error');
                                redirect(current_url());
                            }
                        }else{//if(isset($pass)){
                            Template::set_message('Datos actualizados correctamente.', 'success');
                            redirect(current_url());
                        }

                    } else {//if ($this->post_model->update($data)) {
                        Template::set_message('Ha ocurrido un error.', 'error');

                    }
                }


            } else {//if($user){
                Template::set_message('Este usuario no se encuentra en nuestra base de datos.', 'error');
                redirect(current_url());
            }

        }
            Template::set('tablaUsuario', (isset($tablaUsuario))?$tablaUsuario:" ");
            Template::set('tablaUser',(isset($tablaUser))?$tablaUser:" " );
            Template::set_view('perfil');
            Template::render();


    }
    //--------------------------------------------------------------------
    /*
     * Funcion actualizar datos usuario
     *
     * Esta funcion hace un update dependiendo del id que le mandemos
     * funcion update de post model update($idDeLaTabla,$camposModificados)
     *
     */
    private function updateUsuario($idSet,$idTarjet)
    {

            $data = array(
                'idUser' => $idSet
            );

            if($this->post_model->update($idTarjet, $data)) {
                return true;
            }

    }

}
?>