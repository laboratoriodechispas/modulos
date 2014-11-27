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
        $this->load->helper('form');
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
    public function add()
    {

        $this->load->helper('typography');
        $this->load->helper('form');
        $this->load->model('post_model');
        $this->load->library('users/auth');

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
            if($this->input->post('email')!= ""){

                $user = $this->user_model->find_by('email',$this->input->post('email'));

            }else{

                Template::set_message('Debes ingresar todos los datos.', 'success');
                redirect(current_url());
            }
            /*
             * compruebo si el mail ingresado existe, sino existe en la base
             * de datos le permito el paso
             */
            if(!$user){

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
                        Template::set_message('Ha ocurrido un error.', 'success');
                        redirect(current_url());
                    }
                }else{//if ($this->post_model->insert($data)) {
                    Template::set_message('Ha ocurrido un error.', 'success');
                    redirect(current_url());
                }
            }else{//if(!$user){
                Template::set_message('Este usuario ya se encuentra en nuestra base de datos.', 'success');
                redirect(current_url());
            }
        }




        Template::set('toolbar_title', 'crear nuevo usuario');
        Template::set_view('add');
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
    public function login()
    {
        $this->load->library('users/auth');
        $this->load->helper('form');
        Template::set_view('entrar');
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