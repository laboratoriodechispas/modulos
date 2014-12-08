<?php
 	
  $templatepath = "../wp-content/plugins/gestion-identidad-atleta/mvc/";

/*
* Patron: MVC | Video Art 
*/ 
//La carpeta donde buscaremos los controladores
$carpetaControladores = "controladores/";

//Si no se indica un controlador, este es el controlador que se usar�

//Si no se indica una accion, esta accion es la que se usar�
if(! empty($_REQUEST['controlador']))
{
    $controlador = $_REQUEST['controlador'];
}
else
{
    $controlador = $hc_controlador;
}
if(! empty($_REQUEST['accion']))
{
    $accion = $_REQUEST['accion'];
}
else
{
    $accion = $hc_accion;
}
//Ya tenemos el controlador y la accion
//Formamos el nombre del fichero que contiene nuestro controlador
$controlador = $carpetaControladores . $controlador . 'Controlador.php';
//Incluimos el controlador o detenemos todo si no existe
if(!is_file($controlador))
{
   include($controlador);
}
else
{
	die("El controlador no esta - 404 $controlador");
}

//Llamamos la accion o detenemos todo si no existe
if(is_callable($accion))
{
    $accion();
}
else
{
    die('La accion no existe - 404 not found');
}
?>