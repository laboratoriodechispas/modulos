<?php
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


/**Add Actions*/
add_action('wp_ajax_registra_eventos', 'registra_eventos_callback');  
add_action('wp_ajax_nopriv_registra_eventos', 'registra_eventos_callback'); 

add_action('wp_ajax_wpaction_actualiza_eventos', 'registra_eventos_callback'); //uso el mismo callback por que post define la interacción vease registra_eventos_callback
add_action('wp_ajax_nopriv_wpaction_actualiza_eventos', 'registra_eventos_callback');

add_action('wp_ajax_wpaction_guardar_preguntas', 'registra_eventos_callback'); //uso el mismo callback por que post define la interacción vease registra_eventos_callback
add_action('wp_ajax_nopriv_wpaction_guardar_preguntas', 'registra_eventos_callback');

add_action('wp_ajax_wpaction_registrar_evento', 'registra_eventos_callback');
add_action('wp_ajax_nopriv_wpaction_registrar_evento', 'registra_eventos_callback');

add_action('wp_ajax_nopriv_wpaction_registrar_evento', 'registra_eventos_callback'); //uso el mismo callback por que post define la interacción vease registra_eventos_callback
add_action('wp_ajax_wpaction_registrar_evento', 'registra_eventos_callback');

add_action('wp_ajax_wpaction_general','ajax_general');
add_action('wp_ajax_nopriv_wpaction_general','ajax_general');   

 
$PATH_THUMBNAIL = plugins_url() . "/gestion-identidad-atleta/images/uploads/imgThumbnail/";
$PATH_DESTACADA = plugins_url() . "/gestion-identidad-atleta/images/uploads/imgDestacada/";

$TAMANO_PAGINA = 10;

if (function_exists('add_action')) {
	add_action('admin_menu', 'menu_americanista'); //Agrega el menu del plugin 
	
}//Fin function_exists('add_action')
function menu_americanista(){
	$icon_url = plugin_dir_url( __FILE__ )."images/16x16.png";//Ruta del icono del menu     	
	if (function_exists('add_options_page')) {
/*
 *add_menu_page -- función que muestra el contenido de la página del menú
*/
    /*Perfil: Administrador(Americanista)*/
	add_menu_page('Gestión Identidad Atleta', 'Gestión Identidad Atleta', 'administrator', 'identidad' , 'panel_administrador',$icon_url);
	add_submenu_page('identidad','Eventos','Eventos','administrator','agregar_eventos', 'agregar_eventos');
	add_submenu_page('identidad','Usuarios','Usuarios','administrator','perfil_usuarios', 'perfil_usuarios');
    
    }
}//FIN fucntion add_menu 




function ajax_general(){
	     /*hc - harcodeado*/          
            $hc_controlador = $_POST["controlador"];
            $hc_accion = $_POST["accion"];
            include('mvc/mvc.php');    
}


/*Caja de busquedas*/
add_action('wp_ajax_caja_busca_evento', 'caja_busca');
add_action('wp_ajax_nopriv_caja_busca_evento', 'caja_busca');

function caja_busca(){
         /*hc - harcodeado*/          
            $hc_controlador = 'eventos';
            $hc_accion = $_POST["accion"];
            include('mvc/mvc.php'); 
            exit;
}

add_action('wp_ajax_caja_busca_usuario', 'caja_busca');
add_action('wp_ajax_nopriv_caja_busca_usuario', 'caja_busca');  

function caja_busca_usuario(){
         /*hc - harcodeado*/          
            $hc_controlador = 'usuarios';
            $hc_accion = $_POST["accion"];
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
    if($_POST)   /**En caso de que tenga una envio  va al controlador correspondiente y manda la accón correspondiente ($_POST)*/    {              
        
            $hc_controlador = 'eventos'; /**nombre del controlador*/
            $hc_accion = $_POST["accion"]; /**acción correspondiente*/  
            include('mvc/mvc.php');   /**incluye el archivo mvc que manda los datos*/
            
                        
}  
    //Vista
    if(!$_POST)   /**En caso de que no exista una acción se incluye de manera directa para que el controlador muestre la vista correspondiente*/
    {
            
            $hc_controlador = 'eventos'; /**nombre del controlador*/
            $hc_accion = 'vista_eventos'; /**acción correspondiente*/
            include('mvc/mvc.php'); /**incluye el archivo mvc que manda los datos*/   
            add_action('admin_head', 'registra_eventos_javascript');/**agrega la acción del archivo js*/ 			
                 
    }   
}

function perfil_usuarios(){       
    if($_POST)   /**En caso de que tenga una envio  va al controlador correspondiente y manda la accón correspondiente ($_POST)*/
    {              
       
            $hc_controlador = 'usuarios'; /**nombre del controlador*/
            $hc_accion = $_POST["accion"]; /**acción correspondiente*/
            include('mvc/mvc.php');   /**incluye el archivo mvc que manda los datos*/
                        
}
    //Vista
    if(!$_POST)   /**En caso de que no exista una acción se incluye de manera directa para que el controlador muestre la vista correspondiente*/
    {
            
            $hc_controlador = 'usuarios'; /**nombre del controlador*/
            $hc_accion = 'perfil_usuario'; /**acción correspondiente*/
            include('mvc/mvc.php'); /**incluye el archivo mvc que manda los datos*/ 
           // add_action('admin_head', 'registra_eventos_javascript');/**agrega la acción del archivo js*/ 			
                 
    }   
}  


/**funciones Calllback*/
function registra_eventos_callback() {		       
            $hc_controlador = $_POST["controlador"];
            $hc_accion = $_POST["accion"];
            include('mvc/mvc.php');       
            die(''); // this is required to return a proper result   
}     

function fechaMexico($strFecha){
   return date( "d/m/y",  strtotime($strFecha));
}
?>