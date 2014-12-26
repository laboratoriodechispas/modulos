<?php
class Control_old extends CI_Controller{


/*
Plugin Name: Gestión Identidad Atleta
Plugin URI: http://www.idetidadatleta.com/
Description: Tener la posibilidad de administrar las herramientas de eventos de identidad atleta.
Author: David Aguilar Sánchez / Sergio Nava Reyna
Version: 1.0
Author URI: http://www.sparklabs.com.mx/
*/

/*
*Conexión a la base de datos externa a wordpress
*/
/**/

public $TAMANO_PAGINA = 10;



function ajax_general(){
	     /*hc - harcodeado*/          
            $hc_controlador = $_GET["controlador"];
            $hc_accion = $_GET["accion"];
            include('mvc/mvc.php');    
}



function caja_busca(){
         /*hc - harcodeado*/          
            $hc_controlador = 'eventos';
            $hc_accion = $_GET["accion"];
            include('mvc/mvc.php'); 
            exit;
}

function caja_busca_usuario(){
         /*hc - harcodeado*/          
            $hc_controlador = 'usuarios';
            $hc_accion = $_GET["accion"];
            include('mvc/mvc.php'); 
            exit;
}

/*
*Funciones del plugin
*/
function panel_administrador(){	
	
	
	//echo "<h2>Bienvenido a su sistema:</h2>";
	?>
    <style>
	/*.content-imagen{
		width:500px;
		height:500px;
		margin:50px auto;
	}*/
	</style>
    <div class="content-imagen">
    <img src="<?php echo plugin_dir_url( __FILE__ )."images/ia.jpg"?>" />
    </div>
    <?php
	
}

/*
*Funcion que sube un archi lo ejecuta comprueba e inserta a los americanistas 
*/
function agregar_eventos(){       
    if($_GET)   /**En caso de que tenga una envio  va al controlador correspondiente y manda la accón correspondiente ($_GET)*/    {              
        
            $hc_controlador = 'eventos'; /**nombre del controlador*/
            $hc_accion = $_GET["accion"]; /**acción correspondiente*/  
            include('mvc/mvc.php');   /**incluye el archivo mvc que manda los datos*/
            
                        
}  
    //Vista
    if(!$_GET)   /**En caso de que no exista una acción se incluye de manera directa para que el controlador muestre la vista correspondiente*/
    {
            
            $hc_controlador = 'eventos'; /**nombre del controlador*/
            $hc_accion = 'vista_eventos'; /**acción correspondiente*/
            include('mvc/mvc.php'); /**incluye el archivo mvc que manda los datos*/   
            add_action('admin_head', 'registra_eventos_javascript');/**agrega la acción del archivo js*/ 			
                 
    }   
}

function perfil_usuarios(){       
    if($_GET)   /**En caso de que tenga una envio  va al controlador correspondiente y manda la accón correspondiente ($_GET)*/
    {              
       
            $hc_controlador = 'usuarios'; /**nombre del controlador*/
            $hc_accion = $_GET["accion"]; /**acción correspondiente*/
            include('mvc/mvc.php');   /**incluye el archivo mvc que manda los datos*/
                        
}
    //Vista
    if(!$_GET)   /**En caso de que no exista una acción se incluye de manera directa para que el controlador muestre la vista correspondiente*/
    {
            
            $hc_controlador = 'usuarios'; /**nombre del controlador*/
            $hc_accion = 'perfil_usuario'; /**acción correspondiente*/
            include('mvc/mvc.php'); /**incluye el archivo mvc que manda los datos*/ 
           // add_action('admin_head', 'registra_eventos_javascript');/**agrega la acción del archivo js*/ 			
                 
    }   
}  


/**funciones Calllback*/
function registra_eventos_callback() {		       
            $hc_controlador = $_GET["controlador"];
            $hc_accion = $_GET["accion"];
            include('mvc/mvc.php');       
            die(''); // this is required to return a proper result   
}     

function fechaMexico($strFecha){
   return date( "d/m/y",  strtotime($strFecha));
}
}
?>