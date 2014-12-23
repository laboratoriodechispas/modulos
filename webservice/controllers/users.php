<?php
/**
 * Created by PhpStorm.
 * User: Spark
 * Date: 05/12/2014
 * Time: 10:45 AM
 */

require(APPPATH.'libraries/REST_Controller.php');

class users extends \REST_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('users/auth');
        $this->load->model('webservice_model');
    }

    /*
         * Funcion buscar usuario
         *
         * funcion encargada de buscar un usuario por su id via post
         */
    public function find_user_by_email_post()
    {
        $post_add = $this->post();
        if($post_add)
        {
            $user = $this->user_model->find_by(array('email'=> $this->post('email'),'bf_users.deleted'=>0));
            if ($user)
            {
                $data = $user;
                $this->response($data);
            }//end if ($user)
            else
            {
                $data = array('response' => 'error','message'=>'Usuario no encontrado o se dio de baja');
                $this->response($data);
            }//end else
        }//end if($post_add)
    }//end function buscar_user_by_email_post

    /*
     * funcion login
     *
     * devuelve true o false si el usuario y la contraseña son  correctos
     * $this->auth->check_password funcion nativa de bonfire para comparar
     * contraseñas encriptadas tambien devuelve los datos del usuario sin
     * incluir la contraseña ni ellenguage
     *
     */
    public function login_post()
    {
        $post_add = $this->post();
        if($post_add)
        {
            $email = $this->post('email') ? $this->post('email') : 'null';
            $pass = $this->post('password') ? $this->post('password') : 'null';


                $user = $this->check_user($email);

                if ($user['response'])
                {

                    if ($this->auth->check_password($pass, $user['user']->password_hash))
                    {

                        unset($user['user']->password_hash);
                        unset($user['user']->language);
                        $data = array('response' => 'ok','data'=>$user);
                    }//end if ($this->auth->check_password($pass, $user['user']->password_hash))
                    else
                    {
                        $data = array('response' => 'error');

                    }//end else
                }//end if ($user['response'])
                else
                {
                    $data = array('response' => 'error','message'=>'Usuario no encontrado');

                }//end else


        }//end  if($post_add)
        else
        {
            $data = array('response' => 'error','message'=>'faltan datos');
        }//end  else
        $this->response($data);
    }//end function login_post()

    /*
     * traer datos adicionales
     *
     * funcion encargada de traer datos adicionales del usuario
     * directo de la tabla usuarios
     */
    public function get_info_user_post()
    {
        $post_add = $this->post();
        if($post_add)
        {
            $user = $this->webservice_model->find_by(array('idUser'=>$this->post('id'),'deleted'=>0));
            unset($user->id_usuario);
            if ($user)
            {
                $data = array('data' => $user, 'response' => 'ok');

            }//end  if ($user)
            else
            {
                $data = array('response' => 'error','message'=>'El usuario o existe en base de datos o se dio de baja');

            }//end else
        }//end if($post_add)
        else
        {
            $data = array('response' => 'error','message'=>'faltan datos');
        }//end else
        $this->response($data);
    }//end function get_info_user_post

    /*
     * funcion para insertar usuarios
     *
     * funcion encargada de insertar un usuario en ambas bases de datos
     */
    public function insert_user_post()
    {
        $post_add = $this->post();
        /*
         * verifico que exista un envio de datos, de no ser asi solo cargo la
         * pantalla de registro
         */
        if (!empty($post_add))
        {
            $email = $this->post('email') ? $this->post('email') : 'null';
            if($email == 'null')
            {
                $data = array('response'=>'error','mesagge'=>'Falta correo');
                $this->response($data);
            }//end if($email == 'null')
            $user = $this->check_user($this->post('email'));
            if($user['response'])
            {
                $data = array('response'=>'error','mesagge'=>'Correo duplicado');
                $this->response($data);
            }//end if($user['response'])
            $data = array(
                'nombre'               => $this->post('nombre'),
                'apellido_paterno'     => $this->post('apellido_paterno'),
                'apellido_materno'     => $this->post('apellido_materno'),
                'fecha_nacimiento'     => $this->post('fecha_nacimiento'),
                'pais_nacimiento'      => $this->post('pais_nacimiento'),
                'residencia'           => $this->post('residencia'),
                'direccion'            => $this->post('direccion'),
                'colonia'              => $this->post('colonia'),
                'delegacion_municipio' => $this->post('delegacion_municipio'),
                'cp'                   => $this->post('cp'),
                'edad'                 => $this->post('edad'),
                'sexo'                 => $this->post('sexo'),
                'email'                => $this->post('email'),
                'telefono_contacto'    => $this->post('telefono_contacto'),
                'id_estado_residencia' => 10,
                'id_estado'            => 10,
                'codigo'               => 10,
                'status'               => 10,
                'idUser'               => 0,
                'slug'                 => "null"
            );
            $slug = $this->post('nombre')." ".$this->post('apellido_paterno');
            if ($this->webservice_model->insert($data))
            {
                $usuario = array(
                    'email'    => $this->post('email'),
                    'username' => $this->post('username'),
                    'password' => $this->post('password')
                );
                /*
                 * compruebo la insercion a la tabla usuarios de bonfire
                 */
                if ($this->user_model->insert($usuario))
                {

                    $idUsuario = $this->user_model->find_by('email', $this->post('email'));
                    $idTarjet  = $this->webservice_model->find_by('email', $this->post('email'));

                    /*
                     * ejecuto la funcion update para agregar el id del usuario de bonfire
                     * a la tabla de usuarios creada por mi
                     */
                    if ($this->update_user($idUsuario->id, $idTarjet->id_usuario,$slug))
                    {
                        $data = array('response'=>'ok');


                        /*
                         * sino hace el update lo vuelvo a ejecutar
                         */
                    } //end if ($this->update_user($idUsuario->id, $idTarjet->id_usuario,$slug))
                    elseif ($this->update_user($idUsuario->id, $idTarjet->id_usuario,$slug))
                    {
                        $data = array('response'=>'ok');

                    }//end elseif ($this->update_user($idUsuario->id, $idTarjet->id_usuario,$slug))

                }//end  if ($this->user_model->insert($usuario))
                else
                {//if($this->user_model->insert($usuario)) {
                    $data = array('response'=>'error','message'=>'error en insercion');

                }//end  else

            }//end if ($this->webservice_model->insert($data))
            else
            {
                $data = array('response'=>'error','mesagge'=>'Correo duplicado');

            }//end else
        }//end if (!empty($post_add))
        else
        {
            $data = array('response' => 'error','message'=>'faltan datos');
        }//end else
        $this->response($data);
    }//end function insert_user_post()

    /*
     * funcion para eliminar usuario
     *
     * funcion encargada de eliminar un usuario
     * toma como argumento el id y se elimina tanto en
     * la tabla users de bonfire como en la tabla
     * usuarios
     */
    public function delete_user_post()
    {
        $post_add = $this->post();
        if($post_add)
        {

            $deleted_post_model = $this->webservice_model->delete($this->post('id'));
            $deleted_user_model = $this->user_model->delete($this->post('id'));
            if ($deleted_user_model && $deleted_post_model)
            {
                $data = array('response' => 'ok');
            }//end if ($deleted_user_model && $deleted_post_model)
            else
            {
                $data = array('response' => 'error','message'=>'no se pudo borrar el campo');

            }//end else
        }//end  if($post_add)
        else
        {
            $data = array('response' => 'error','message'=>'faltan datos');
        }//end else
        $this->response($data);
    }//end function delete_user_post()
    /*
     * funcion actualizar datos
     *
     * funcion que actualiza los datos de un usuario
     * tanto en la tabla users(bonfire) como en usuarios
     */
    public function update_user_post()
    {

        $post_add = $this->post();
        if($post_add)
        {
            $data = array(
                'nombre'               => $this->post('nombre'),
                'apellido_paterno'     => $this->post('apellido_paterno'),
                'apellido_materno'     => $this->post('apellido_materno'),
                'fecha_nacimiento'     => $this->post('fecha_nacimiento'),
                'pais_nacimiento'      => $this->post('pais_nacimiento'),
                'residencia'           => $this->post('residencia'),
                'direccion'            => $this->post('direccion'),
                'colonia'              => $this->post('colonia'),
                'delegacion_municipio' => $this->post('delegacion_municipio'),
                'cp'                   => $this->post('cp'),
                'edad'                 => $this->post('edad'),
                'sexo'                 => $this->post('sexo'),
                'telefono_contacto'    => $this->post('telefono_contacto'),
                'slug'                 => url_title($this->post('nombre')." ".$this->post('apellido_paterno')." ".$this->post('id'),'dash',true)
            );
            /*
             * compruebo la actualizacion en la tabla usuarios creada por mi
             */

            if ($this->webservice_model->update($this->post('id'), $data))
            {
                $pass = $this->post('password');
                /*
                 * verifico que exista la contraseña
                 *
                 * sino hay contraseña lo doy por bueno directamente
                 *
                 */
                if ($pass != "")
                {
                    $usuario = array(
                        'password' => $this->post('password')
                    );
                    /*
                    * compruebo la actualizacion a la tabla usuarios de bonfire
                    */
                    if ($this->user_model->update($this->post('id'), $usuario))
                    {

                        $data = array('response' => 'ok');


                    } //end if ($this->user_model->update($this->post('id'), $usuario))
                    else
                    {
                        $data = array('response' => 'error','message'=>'error en update verifica los campos');

                    }//end else
                } // end if ($pass != "")
                else
                {
                    $data = array('response' => 'ok');

                }//end else
            }//end if ($this->webservice_model->update($this->post('id'), $data))
            else
            {
                $data = array('response' => 'error','message'=>'error en update verifica los campos');

            }//end else
        }//end if($post_add)
        else
        {
            $data = array('response' => 'error','message'=>'faltan datos');
        }//end else
        $this->response($data);

    }//end function update_user_post()

    /*
     * funcion actualizar datos
     *
     * funcion que actualiza los datos de un usuario
     * tanto en la tabla users(bonfire) como en usuarios
     */
    public function update_user_password_post()
    {

        $post_add = $this->post();
        if($post_add)
        {

                    $usuario = array(
                        'password' => $this->post('password')
                    );
                    /*
                    * compruebo la actualizacion a la tabla usuarios de bonfire
                    */
                    if ($this->user_model->update($this->post('id_user'), $usuario))
                    {

                        $data = array('response' => 'ok');


                    } //end if ($this->user_model->update($this->post('id_user'), $usuario))
                    else
                    {
                        $data = array('response' => 'error','message'=>'error en update verifica los campos');

                    }//end else

        }//end if($post_add)
        else
        {
            $data = array('response' => 'error','message'=>'faltan datos');
        }//end else
        $this->response($data);

    }//end function update_user_password_post()

    /*
     * funcion verificar usuario
     *
     * Funcion encargada de verificar si un usuario existe
     * devuelve un array con la contraseña en base de datos
     * y un response true si el usuario se encuentra y false
     * sino esta en base de datos
     */
    private function check_user($email)
    {
        $user   = $this->user_model->find_by(array('email'=>$email,'bf_users.deleted'=>0));

        if($user)
        {
            return array('user'=>$user,'response'=>true);
        }//end if($user)
        else
        {
            return array('response'=>false);
        }//end else
    }//end function check_user($email)
    /*
     * funcion que updetea
     *
     * hace un update del slug y del id para que ambos coincidan
     * id de tabla users(bonfire) y usuarios
     */
    private function update_user($idSet,$idTarjet,$slug)
    {

        $data = array(
            'idUser' => $idSet,
            'slug'   => url_title($slug." ".$idSet,'dash',true)
        );

        if($this->webservice_model->update_where('id_usuario',$idTarjet, $data))
        {
            return true;
        }//end if($this->webservice_model->update_where('id_usuario',$idTarjet, $data))

    }//end function update_user($idSet,$idTarjet,$slug)

} 