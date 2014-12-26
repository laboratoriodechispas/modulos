<?php
 	class Control extends CI_Controller
    {
    public function __construct(){
        parent::__construct();
        $this->load->model('eventos_new_model');
    }
        function index(){

        $hc_controlador = "eventos";
            $hc_accion  = "registra_eventos";
                    $templatepath = "../gestion/";

                        /*
                        * Patron: MVC | Video Art
                        */
                //La carpeta donde buscaremos los controladores


                //Si no se indica un controlador, este es el controlador que se usar�

                //Si no se indica una accion, esta accion es la que se usar�
                if (! empty($_REQUEST['controlador']))
                {
                $controlador = $_REQUEST['controlador'];
                }

                else
                {
                    $controlador = $hc_controlador;
                }
                if (!empty($_REQUEST['accion'])) {
                    $accion = $_REQUEST['accion'];
                } else {
                    $accion = $hc_accion;
                }
                //Ya tenemos el controlador y la accion
                //Formamos el nombre del fichero que contiene nuestro controlador
                $controlador =  $controlador . 'Controlador.php';
                //Incluimos el controlador o detenemos todo si no existe
                if (!is_file($controlador)) {
                    include($controlador);
                } else {
                    die("El controlador no esta - 404 $controlador");
                }

                //Llamamos la accion o detenemos todo si no existe
            $clase = new EventosControlador();


                    $clase->$accion();

        }
}
?>