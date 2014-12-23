<?php
/**
 * Created by PhpStorm.
 * User: Spark
 * Date: 05/12/2014
 * Time: 10:45 AM
 */

require(APPPATH.'libraries/REST_Controller.php');

class Gestion_eventos extends \REST_Controller{
/*
 * constructor
 *
 * funcion encargada de cargar los modelos que seran utilizados en
 * el proceso
 */
    public function __construct()
    {
        parent::__construct();
        $this->load->library('users/auth');
        $this->load->model('eventos_model');
        $this->load->model('tipo_evento_model');
    }//end function __construct(){


    /*
     * traer todos los eventos
     *
     * Funcion encargada de traer todos los eventos
     * (todos) que no tengan estatus delete
     */
    public function get_all_evento_post()
    {
        $eventos = $this->eventos_model->where('deleted', 0)->order_by("created_on", "desc")->find_all();

        $data = array('response' => 'ok','data'=>$eventos);
        $this->response($data);
    }// end get_all_evento_post()

    /**
     * Traer eventos actuales
     *
     * Funcion encargada de traer los eventos posteriores a la fecha de hoy
     *
     */
    public function get_eventos_now_post()
    {

        $eventos = $this->eventos_model->where(array('deleted'=> 0))->order_by("created_on", "desc")->find_all();

        $obj = array();

        foreach($eventos as $evento)
        {
            $fecha = strtotime($evento->fecha);
            $fecha = date('d-m-Y',$fecha);
            $hoy   = date('d-m-y');

            if($fecha > $hoy)
            {
                array_push($obj,$evento);

            }
        }

        $data = array('response' => 'ok','data'=>$obj);
        $this->response($data);
    }//end function get_eventos_now_post()

    /**
     * Traer eventos pasados
     *
     * Funcion encargada de traer los eventos anteriores a la fecha de hoy
     *
     */
    public function get_eventos_old_post()
    {

        $eventos = $this->eventos_model->where(array('deleted'=> 0))->order_by("created_on", "desc")->find_all();

        $obj = array();

        foreach($eventos as $evento)
        {
            $fecha = strtotime($evento->fecha);
            $fecha = date('d-m-Y',$fecha);
            $hoy   = date('d-m-y');

            if($fecha < $hoy)
            {
                array_push($obj,$evento);

            }
        }

        $data = array('response' => 'ok','data'=>$obj);
        $this->response($data);
    }//end function get_eventos_old_post()

    /*
     * buscar eventos
     *
     * Funcion encargada de buscar eventos si falta cualquiera de los datos se asinara uno
     * por defaul
     */
    public function find_evento_post()
    {
        $post_add = $this->post();
        /*verifico que haya datos post*/
        if($post_add)
        {
            $tamano_pagina = ($this->post('tamano')) ? ($this->post('tamano')) : 0;
            $buscar = ($this->post('buscar')) ? $this->post('buscar') : "";
            $order = ($this->post('asc')) ? $this->post('asc') : 0;

            if ($order == 0)
            {
                $cadena_order = "desc";
            } //end if ($order == 0)
            elseif ($order == 1)
            {
                $cadena_order = "asc";
            }//end elseif ($order == 1)

            if ($tamano_pagina == 0)
            {
                //todos
                $eventos = $this->eventos_model->where('deleted', 0)->find_all();
                $data = array('response' => 'ok', 'data' => $eventos);
            }//end  if($tamano_pagina ==0)
            else
            {

                if ($buscar != "")
                {

                    $eventos = $this->eventos_model->where('deleted', 0)->like('nombre_evento', $buscar)->limit($tamano_pagina)->order_by("created_on", $cadena_order)->find_all();
                    $data = array('response' => 'ok', 'data' => $eventos);

                }//end if($buscar != "")
                else
                {
                    $data = array('response' => 'error', 'message' => 'Debes ingresar un criterio de busqueda');
                }//end else

            }//end else

        }// end if($post_add)
        else
        {
            $data = array('response' => 'error','message'=>'Sin datos');

        }//end else

        $this->response($data);
    }

    /*
     * agregar un evento
     *
     * funcion encargada de hacer una insercion en base de datos
     * de un nuevo evento
     */
    public function add_evento_post()
    {

        $post_add = $this->post();
        /*verifico que haya datos post*/
        if($post_add)
        {
            $data = array(

                'nombre_evento'  => $this->post("nombre_evento"),
                'descripcion'    => $this->post("descripcion"),
                'fecha'          => $this->post("fecha"),
                'ruta'           => $this->post("ruta"),
                'img_destacada'  => $this->post("imagen_destacada"),
                'img_thumb'      => $this->post("imagen_thumbail"),
                'convocatoria'   => $this->post("convocatoria"),
                'tipo_evento'    => $this->post("tipo_evento"),
                'id_organizador' => $this->post("user_id"),
                'slug'           => url_title($this->post("nombre_evento"),'dash',true),
                'status' => 1
            );
            /*verifico la insercion*/
            if ($this->eventos_model->insert($data))
            {
                $data = array('response' => 'ok');

            }//end if ($this->eventos_model->insert($data)) {
            else
            {
                $data = array('response' => 'error','message'=>'La insercion no se pudo realizar');

            }//end else
        }//end if($post_add) {
        else
        {
            $data = array('response' => 'error','message'=>'Sin datos');

        }//end else

        $this->response($data);
    }//end  public function agregar_evento_post(){


    /*
     * actualizar/modificar un evento
     *
     * funcion encargada de llevar a cabo una actualizacion
     * de campos de la tabla eventos
     */
    public function update_evento_post()
    {

        $post_add = $this->post();
        if($post_add)
        {
            $data = array(
                'nombre_evento'  => $this->post("nombre_evento"),
                'descripcion'    => $this->post("descripcion"),
                'fecha'          => $this->post("fecha"),
                'ruta'           => $this->post("ruta"),
                'img_destacada'  => $this->post("imagen_destacada"),
                'img_thumb'      => $this->post("imagen_thumbail"),
                'convocatoria'   => $this->post("convocatoria"),
                'tipo_evento'    => $this->post("tipo_evento"),
                'slug'           => url_title($this->post("nombre_evento"),'dash',true)

            );
            /*
             * compruebo la actualizacion en la tabla eventos
             */

            if ($this->eventos_model->update($this->post('id_evento'), $data))
            {

                        $data = array('response' => 'ok');


            } // end if ($this->eventos_model->update($this->post('id'), $data))
            else
            {
                $data = array('response' => 'error','message'=>'error en update verifica los campos');

            }//end else
        }//end if($post_add)
        else
        {
            $data = array('response' => 'error','message'=>'Sin datos');

        }//end else
        $this->response($data);
    }//end function update_evento_post()

    /*
     * obtener informacion del evento
     *
     * funcion encargada de retornar detalles del evento
     * a travez del nombre del mismo
     * este metodo se encargade traer todo el array del evento
     * y puede ser usado con dos propositos:
     * 1. traer el array completo para x fin
     * 2. comporbar la existencia de un nombre(evitar duplicados)
     */
    public function get_info_evento_post()
    {
        $post_add = $this->post();
        if($post_add)
        {
            $evento = $this->check_event($this->post("nombre_evento"));
            if($evento['response'])
            {
                unset($evento['data']->deleted);
                unset($evento['data']->status);

                $data = array('response' => 'ok','data'=>$evento['data']);

            }//end if($evento)
            else
            {
                $data = array('response' => 'error','message'=>'el nombre no se encuentra en la base de datos');

            }//end else
        }//end if($post_add)
        else
        {
            $data = array('response' => 'error','message'=>'Sin datos');

        }//end else
        $this->response($data);
    }//end function get_info_evento_post()



    /*
     * eliminar evento
     *
     * funcion encargada de eliminar un evento
     * no lo elimina totalmente solo cambia ese estatus
     */
    public function  delete_evento_post()
    {
        $post_add = $this->post();
        if($post_add)
        {

            $deleted_post_model = $this->eventos_model->delete($this->post('id_evento'));

            if ($deleted_post_model)
            {
                $data = array('response' => 'ok');

            }//end if ($deleted_post_model)
            else
            {
                $data = array('response' => 'error','message'=>'no se pudo borrar el campo');

            }//end else
        }//end if($post_add)
        else
        {
            $data = array('response' => 'error','message'=>'Sin datos');

        }//end else
        $this->response($data);
    }//end function  delete_evento_post()



    /*
     * verificar evento
     *
     * funcion encargada de verificar si un evento existe
     * la comprobacion se realiza a travez del nombre
     */
    private function check_event($nombre)
    {
        $evento   = $this->eventos_model->find_by(array('nombre_evento'=>$nombre,'bf_tbl_eventos.deleted'=>0,'status'=>1));//compruebo que no tenga staus delete

        if($evento)
        {
            return array('response'=>true,'data'=>$evento);
        }//end if($evento)
        else
        {
            return array('response'=>false);
        }//end else
    } //end function check_event($nombre)

/******************************************************************************
 *                                                                             *
 *                             Tipo evento                                     *
 *                                                                             *
 *******************************************************************************/
/*
 * añadir un tipo de evento
 *
 * funcion encargada de añadir un nuevo tipo de evento
 * antes de hacer inserciones verificar que no se repitan nombres
 */
    public function add_tipo_evento_post()
    {
        $post_add = $this->post();
        if($post_add)
        {
            $data = array(
                'tipo' => $this->post("tipo_evento")
            );

            if($this->tipo_evento_model->insert($data))
            {
                $data = array('response' => 'ok');

            }//end  if($this->tipo_evento_model->insert($data))
            else
            {
                $data = array('response' => 'error','message'=>'Error en insercion');

            }//end else
        }//end if($post_add)
        else
        {
            $data = array('response' => 'error','message'=>'Sin datos');

        }//end else
        $this->response($data);
    }//end function add_tipo_evento_post()

    /*
     * actualiza la informacion de un tipo de evento
     *
     * funcion encargada de actualizar un tipo de evento
     * usando el id como llave para permitir dicho proceso
     */
    public function update_tipo_evento_post()
    {
        $post_add = $this->post();
        if($post_add)
        {
            $data = array(
                'tipo' => $this->post("tipo_evento")
            );

            if($this->tipo_evento_model->update($this->post('id_tipo_evento'), $data))
            {
                $data = array('response' => 'ok');

            }//end if($this->tipo_evento_model->update($this->post('id_tipo_evento'), $data))
            else
            {
                $data = array('response' => 'error','message'=>'Error en update');

            }//end else
        }//end if($post_add)
        else
        {
            $data = array('response' => 'error','message'=>'Sin datos');

        }//end else
        $this->response($data);
    }//end function update_tipo_evento_post()


    /*
     * obtener el id de un tipo de evento
     *
     * funcion encargada de devolver el id
     * de un evento por medio del nombre del mismo(tipo_evento)
     * puede ser usada para comprobar la existencia de tipos de evento(evitar duplicados)
     */
    public function get_id_tipo_evento_post()
    {
        $post_add = $this->post();
        if($post_add)
        {
            $evento = $this->post('tipo_evento');
            $tipo_evento = $this->tipo_evento_model->select('id')->where('deleted',0)->like('tipo',$evento)->find_all();

            if($tipo_evento)
            {
                $data = array('response' => 'ok','id'=>$tipo_evento);

            }//end if($tipo_evento)
            else
            {
                $data = array('response' => 'error','message'=>'Error en servidor/de conexion o no hay datos que mostrar');

            }//else
        }//end if($post_add)
        else
        {
            $data = array('response' => 'error','message'=>'Sin datos');

        }//end else
        $this->response($data);
    }//end function get_id_tipo_evento_post()

    /*
     * Obtiene tipo de evento
     *
     * funcion encargada de mostrar todos los tipos de eventos
     * en base de datos
     */
    public function get_tipo_evento_post()
    {
        $post_add = $this->post();
        if($post_add)
        {
            $tipo_evento = $this->tipo_evento_model->where('deleted', 0)->find_all();

            if($tipo_evento)
            {
                $data = array('response' => 'ok','data'=>$tipo_evento);

            }// end if($tipo_evento)
            else
            {
                $data = array('response' => 'error','message'=>'Error en servidor/de conexion o no hay datos que mostrar');

            }//end else
        }//end if($post_add)
        else
        {
            $data = array('response' => 'error','message'=>'Sin datos');

        }//end else
        $this->response($data);
    }//end function get_tipo_evento_post()

    public function  delete_tipo_evento_post()
    {
        $post_add = $this->post();
        if($post_add)
        {

            $deleted_post_model = $this->tipo_evento_model->delete($this->post('id_tipo_evento'));

            if ($deleted_post_model)
            {
                $data = array('response' => 'ok');

            }//end if ($deleted_post_model)
            else
            {
                $data = array('response' => 'error','message'=>'no se pudo borrar el campo');

            }//end else
        }//end if($post_add)
        else
        {
            $data = array('response' => 'error','message'=>'Sin datos');

        }//end else
        $this->response($data);
    }//end function  delete_evento_post(){


} 