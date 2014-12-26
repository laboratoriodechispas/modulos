<?php
/*
 *Controlador para la gestión de los eventos  de identidad atleta 
*/
/*class EventosControlador extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('eventos_model');
    }

    public function registra_eventos(){

        global $wpdb;
        /*$tipoEvento      =  $_POST["tipo"];
        $nombreEvento    =  $_POST["titulo"];
        $descripcion     =  $_POST["descripcion"];
        $fecha           =  $_POST["fecha"];
        $editor          =  $_POST["enriquecido"];
        $imagenDestacada =  $_POST["NombreImagenDestacada"];
        $imagenThumbnail =  $_POST["NombreImagenThumbnail"];

        $tipoEvento      =  $_POST["tipo"];
        $nombreEvento    =  "carrera demo";
        $descripcion     =  "una carrera demo bla bla";
        $fecha           =  "12-12-12";
        $editor          =  "imagen.thumb.jpg";
        $imagenDestacada =  ;
        $imagenThumbnail =  $_POST["NombreImagenThumbnail"];
        // Create post object
        nombre_evento,descripcion,fecha,img_destacada,img_thumb,convocatoria,tipo_evento,id_post,status


        if($consulta){
//CORRECTO
            $arr = array("msg"=>1);
            echo json_encode($arr);
            unset($objEvento);
        }else{
//FALSO
            $arr = array("msg"=>0);
            echo json_encode($arr);
            unset($objEvento);
        }
    }
}*/
/*
require($_SERVER['DOCUMENT_ROOT'].'/identidadatleta/v1/wp-content/plugins/gestion-identidad-atleta/mvc/envia/envia.php');
global $mvc;
$mvc =  $_SERVER['DOCUMENT_ROOT'] . "/identidadatleta/v1/wp-content/plugins/gestion-identidad-atleta/mvc/";
//ruta de la carpeta MVC
function vista_eventos()
{
	global $mvc;	/** llamo la ruta global **/	
    //llamar a la vista

	/*$path =  $mvc . 'vistas/eventos.php'; /** armo el path completo **/
 /* 	include($path);/**Muestra la vista*/
/*}*/



/*
@function Actualiza Eventos
*/
/*function actualiza_eventos(){
	
	 global $wpdb;
	 $idEvento = $_POST["idEvento"];
	 $tipoEvento=$_POST["tipo"];
	 $nombreEvento=$_POST["titulo"];
	 $descripcion=$_POST["descripcion"];
	 $fecha=$_POST["fecha"];
	 $editor=$_POST["enriquecido"];
	 $imagenDestacada=$_POST["NombreImagenDestacada"];
	 $imagenThumbnail=$_POST["NombreImagenThumbnail"];
	 // Create post object
		
		
		// Insert the post into the database
		//$post_ID = wp_insert_post( $my_post );
		//agregar modificación de evento
	 
	 
	 
	 $objEvento = new Evento();
     $objEvento->setId_evento($idEvento);	 
	 $objEvento->setNombre_evento($nombreEvento);
	 $objEvento->setTipo_evento($tipoEvento); 
	 $objEvento->setFecha($fecha);
	 $objEvento->setDescripcion($descripcion);
	 $objEvento->setConvocatoria($editor);
	 //$objEvento->setId_post($post_ID);
	 $objEvento->setImg_destacada($imagenDestacada);
	 $objEvento->setImg_thumb($imagenThumbnail);
	 
	 //para comprobar con query que sea mayor a 0
	 if($consulta>0){
	 $consulta = $wpdb->query($objEvento->actualizaEvento());
//CORRECTO
        $arr = array("msg"=>1);		
		echo json_encode($arr);		
        unset($objEvento);    
		}else{
//FALSO
        $arr = array("msg"=>0);		
		echo json_encode($arr);		
        unset($objEvento);    
	}
}*/

//funcion eliminar eventos

/*function eliminarEvento(){
	 global $wpdb;
	 $id_evento = $_GET["ideliminar"];
	 
	 $objEvento = new Evento();
     $objEvento->setId_evento($id_evento);	 
	 
	 $consulta = $wpdb->query($objEvento->eliminaEvento());
	 
	 //para comprobar con query que sea mayor a 0
	 if(!empty($consulta)){
	  
//CORRECTO
?>
<div class="mensaje-elimina">Se elimino el evento con exito
<a href="<?php bloginfo ('url'); ?>/wp-admin/admin.php?page=agregar_eventos">Regresar</a>
</div>

<?php
		}
		
	 
}*/






/*function tipoEvento(){
		 
  global $wpdb;
  $objEvento = new Evento();
  $items=$wpdb->get_results($objEvento->busquedaTipoEvento());  
  return $items;	
  unset($objEvento);
  //$wpdb->show_errors();
  //$wpdb->print_error();  
}*/
/*
Regresa los resultados para busqueda de empresas.
*/
        
/*function busquedaEventos($iduser,$buscar,$inicio,$TAMANO_PAGINA,$whereconsulta){
  global $wpdb;
  $objEvento = new Evento();
  $items=$wpdb->get_results($objEvento->busquedaEventos($iduser,$buscar,$inicio,$TAMANO_PAGINA,$whereconsulta));
  return $items;	
  unset($objEvento);
  $wpdb->show_errors();
  $wpdb->print_error();  
}*/


function request_URI() {
	
    if(!isset($_SERVER['REQUEST_URI'])) {
        $_SERVER['REQUEST_URI'] = $_SERVER['SCRIPT_NAME'];
        if($_SERVER['QUERY_STRING']) {
            $_SERVER['REQUEST_URI'] .= '?' . $_SERVER['QUERY_STRING'];
        }
    }
    return $_SERVER['REQUEST_URI'];
}

/*
Paginación
*/
/*function paginacion($buscar,$items,$TAMANO_PAGINA){

$pos = strpos($paginacion,"&pagina");
if($pos==0){
	$variables = request_URI() . "&pagina=";
}else{
	$variables = substr(request_URI(),0,$pos) . "&pagina="; 
}

$tamano = sizeof($items);
$total = $tamano / $TAMANO_PAGINA;
    $modulus = $tamano%$TAMANO_PAGINA;

if($total<=0 && $modulus >= 1) $total=2;
if($total>=1&&$modulus >= 1){ $total++; echo "<strong>Pagina: </strong>"; }
	for($i=0;$i<=$total-1;$i++){	  
	  echo "<a href='#' onclick=paginacion('".$buscar."','".$i."')>";
	  echo  $i+1;
	  echo "</a>";
	}
}

/*Adaptacion para busqueda*/
/*function buscaEventos(){
global $TAMANO_PAGINA;
//fill llena dos parametros texto para el GUI y un hidden para operacion
//fill(nombre,id,txtnombre,txthidden,listaaesconder);
?> 
<?php $templatepath = get_bloginfo("url") . "/wp-content/plugins/sistema/"; ?>
      <table class="lista"  width="100%">
        <tr>
          <th align="left">Nombre  (<a href='#' onClick="busqueda_usuario_orden('','asc');">asc</a>/<a href='#' onClick="busqueda_evento_orden('','desc');">desc</a>)</th>
          <th>Fecha</th>
          <th>Preguntas</th>
          <th>Inscritos</th>
          <th>Formas de Pago</th>
          <th>Modificar</th>
          <th>Eliminar</th>
        </tr>
<?php
/*Genera los resultados de la busueda*/
?>
<?php
  /*
  busqueda de empresas,solicita id user actual para activar permisos.
  regresa un array de items

  if(isset($_POST["busqueda"])){ $buscar = $_POST["busqueda"]; }

  if(isset($_POST["paginacion"])){ $inicio = $_POST["paginacion"]; }   //indicador de cursor

  if(isset($_POST["orden"])){ $orden = $_POST["orden"]; }else{ $orden = "desc";}

  if(!isset($inicio)){ $inicio = 0; }
  if(!isset($iduser)){ $iduser = ""; }
  $tamanopagina = $TAMANO_PAGINA;

  $whereconsulta = " ORDER BY nombre_evento $orden";
  $items = busquedaEventos($iduser,$buscar,$inicio,$tamanopagina,$whereconsulta);
  $contador=0; //para el id de jquery

  foreach($items as $item)
  {
  ?>
  <?php
  $contador++;
  /*estilo css dinamico
  	if($contador % 2){
		  $estilo = "background-color:#CCC;";	
	}else{
		  $estilo = "background-color:#eeeeec;";
	}	
?>
        <tr>
          <td><?php echo $item->nombre_evento; ?></td>
          <td><?php echo fechaMexico($item->fecha);?></td>
          <td><a href="?page=agregar_eventos&id=<?php echo $item->id_evento;?>&questions=1"><img src="<?php echo $templatepath; ?>../gestion-identidad-atleta/images/pregunta.png"> Gestionar</a></td>
          <td><a href="?page=agregar_eventos&accion=datos_inscripcion&id=<?php echo $item->id_evento;?>&inscripcions=1"><img src="<?php echo $templatepath; ?>../gestion-identidad-atleta/images/inscritos.png"> Consultar</a></td>   
          <td><a href="?page=agregar_eventos&id=<?php echo $item->id_evento;?>&payments=1"><img src="<?php echo $templatepath; ?>../gestion-identidad-atleta/images/pago.png"> Gestionar</a></td>  
          
          <td><a href="?page=agregar_eventos&id=<?php echo $item->id_evento;?>"><img src="<?php echo $templatepath; ?>../gestion-identidad-atleta/images/modificar.png" /> Modificar</a></td>
          <td><a href="?page=agregar_eventos&controlador=eventos&accion=eliminarEvento&ideliminar=<?php echo $item->id_evento;?>" class="ask"><img src="<?php echo $templatepath; ?>../gestion-identidad-atleta/images/borrar.png" /> Eliminar</a></td>
        </tr>
        <?php 
  }
?>
   <!-- paginacion -->
   <tr>
       <td colspan="7" class="pie-tabla"><?php
           $items = busquedaEventos($idusersicisa,$buscar,0,0,$whereconsulta);
           paginacion("",$items,$TAMANO_PAGINA);
           ?></td>
   </tr>
   <!-- paginacion --><!-- paginacion -->
</td>
</table>
 </div>
<?php/*
}*/

/*function traeEvento($idEvento){
	global $wpdb;	
	$objEvento = new Evento();	
	$items=$wpdb->get_results($objEvento->busquedaEvento($idEvento));  
    return $items;	
    unset($objEvento);
}

function nombreEvento($idEvento){
	global $wpdb;	
	$objEvento = new Evento();	
	$items=$wpdb->get_results($objEvento->nombreEvento($idEvento));  		
	foreach($items as $evento){
			$nombre_evento = $evento->nombre_evento;
	}
    return $nombre_evento;
    unset($objEvento);
}*/
/*Gestion Preguntas*/
/*function guardarPreguntas(){
	global $wpdb;		
	$consulta = "";
	$id = $_POST["idEvento"];
	if($_POST['preguntas'])
	{
	$array=$_POST['preguntas'];
	//borrar todas primero. recordemos que este modulo no modifica , borra y agrega solamente.
	$consulta = $wpdb->query("DELETE FROM tbl_preguntas WHERE id_evento=$id;");

	foreach($array as $preguntas)
	{

	if(strlen($preguntas)>0)
	{	
	$consulta = $wpdb->query("insert into tbl_preguntas (id_evento,pregunta) values('$id','$preguntas')");
	}
	} //foreach


	 if($consulta){
//CORRECTO
        $arr = array("msg"=>1);		
		echo json_encode($arr);		
        unset($objEvento);    
		}else{
//FALSO
        $arr = array("msg"=>0);		
		echo json_encode($arr);		
        unset($objEvento);    
	}
  }
}*/
/*function consultaPreguntas ($id){
	global $wpdb;	
	$sqlQuery = "SELECT * FROM tbl_preguntas WHERE id_evento=$id";
	$items=$wpdb->get_results($sqlQuery);  		
	foreach($items as $evento){
			$mtzPreguntas[] = $evento->pregunta;
	}
    return $mtzPreguntas;
    unset($objEvento);
}

function textoPregunta ($id){
	global $wpdb;	
	$sqlQuery = "SELECT * FROM tbl_preguntas WHERE id_pregunta=$id";
	$items=$wpdb->get_results($sqlQuery);  		
	foreach($items as $evento){
			$stringPreguntas = $evento->pregunta;
	}
    return $stringPreguntas;
    unset($objEvento);
}


function consultaTotalPreguntas ($id){
	global $wpdb;	
	$sqlQuery = "SELECT * FROM tbl_preguntas WHERE id_evento=$id";
	$items=$wpdb->get_results($sqlQuery);  		
	foreach($items as $evento){
			$mtzPreguntas[] = $evento->id_pregunta;
	}
    return $mtzPreguntas;
    unset($objEvento);
}*/

/*FRONT END*/
function obtenerFechaEventos($tipo){
	global $wpdb;	
	$sqlQuery = "SELECT fecha FROM tbl_eventos WHERE tipo_evento=$tipo ORDER BY fecha desc";
	$items=$wpdb->get_results($sqlQuery);  		

	foreach($items as $evento){
			//bajar a un digito el dia por el datepicker
			$expFecha = explode("-",$evento->fecha);
			$anio = $expFecha[0];
			$mes = $expFecha[1];
			$dia = $expFecha[2];
			
			if(strlen($dia)>=2){
				$diaDigit = substr($dia,0,1);
				if($diaDigit=="0"){
					$dia = substr($dia,1,1);
				}
				}
			$expFecha = $dia . "-" . $mes . "-" . $anio ;
			$mtzFechas[] = "'" . $expFecha . "'";
			}
		

    return $mtzFechas;
    unset($objEvento);
	//$mtz = array("'8-11-2013'","'9-11-2013'");
	//return $mtz;
	}


function obtenerEvento($id){
	global $wpdb;	
	$sqlQuery = "SELECT * FROM tbl_eventos WHERE id_evento=$id";
	$items=$wpdb->get_results($sqlQuery);  		

	foreach($items as $evento){

			$mtz[] = $evento;
	
	}
    return $mtz;
    unset($objEvento);
	//$mtz = array("'8-11-2013'","'9-11-2013'");
	//return $mtz;
}

function obtenerUsuario($id){
	global $wpdb;	
	$sqlQuery = "SELECT * FROM tbl_usuarios WHERE idUser=$id";
	$items=$wpdb->get_results($sqlQuery);  		
	foreach($items as $usuario){

			$mtz[] = $usuario;
	
	}
    return $mtz;
    unset($objEvento);
	//$mtz = array("'8-11-2013'","'9-11-2013'");
	//return $mtz;
}

function obtenerPreguntas($id){

	global $wpdb;	
	$sqlQuery = "SELECT * FROM tbl_preguntas WHERE id_evento=$id";
	$items=$wpdb->get_results($sqlQuery);  		
	foreach($items as $pregunta){
			$mtz[] = $pregunta;	
	}
    return $mtz;
    unset($objEvento);
	//$mtz = array("'8-11-2013'","'9-11-2013'");
	//return $mtz;
}

//consultar respuestas del evento

function obtenerRespuestas($id){

	global $wpdb;	
	$sqlQuery = "SELECT * FROM tbl_respuestas_definidas WHERE id_pregunta=$id";
	$itemsA=$wpdb->get_results($sqlQuery);  		
	foreach($itemsA as $respuesta){
			$mtzA[] = $respuesta;	
	}
    return $mtzA;
    unset($objEvento);
	//$mtz = array("'8-11-2013'","'9-11-2013'");
	//return $mtz;
}


//registro
/*function registra_evento(){
	ini_set("display_errors",1);
	global $wpdb;		
	$consulta = "";
	$id = $_POST["idUser"];
	$idEvento = $_POST["idEvento"];
	$preguntas = $_POST['preguntas'];
	$preguntast = $_POST['preguntast'];
	$respuestas = $_POST['respuestas'];
	$id_usuario = $_POST['id_usuario'];
	$fecha_inscripcion= date("Y-m-d");
	$tipoPago = $_POST['tipodepago'];
	$to = $_POST['email'];
	$fecha_evento = $_POST['fecha_evento'];
	//$to = "alejandro.garcia@sparklabs.com.mx";
	$nombre_completo = $_POST['nombre_completo'];
	$nombr_evento = $_POST['nombre_evento'];
	$img_evento = $_POST['img_evento'];
	$subject = "Registro de Inscripcion";
	$headers [] = "Content-type: text/html; charset=iso-8859-1\r\n"; 
	$cuerpo =  
	"<meta http-equiv=Content-Type content=text/html;charset=utf-8 />
	 <meta http-equiv=Content-Type content=charset=UTF-8 />
     <meta http-equiv=Content-Language content=es-ES />
<table border='0'>
	<tr>  
    	<td colspan='2'><img src='http://identidadatleta.com/images/logo-identidad.png' width='226' height='69'></td>
	</tr>
    <tr>
    	<td colspan='2'>
        	Estimado <strong> $nombre_completo </strong><br><br>
            Gracias por registrarte en <a href='http://identidadatleta.com' target='_blank'>identidadatleta.com.mx</a><br>
        </td>
    </tr>
    <tr>
    	<td colspan='2'>A continuación encontraras la información del evento:</td>
    </tr>
    <tr>
       	<td style='vertical-align:top; padding-top:10px; width:430px;'>  
           <fieldset>
             	<legend style='color:#F00; font-size:16px'><strong> Datos: </strong></legend><br>
                <strong>Evento:</strong> $nombr_evento<br><br>
                <strong>Fecha:</strong> $fecha_evento<br><br>
                <strong>Sede:</strong> México <br><br><br>
           </fieldset>
        </td>    
        <td>
            <img src='http://www.identidadatleta.com/cms/wp-content/plugins/gestion-identidad-atleta/images/uploads/imgThumbnail/".$img_evento."'/>
        </td>
	</tr>
        
</table>
		"; 
		//$envia_confirmacion = mail3($to,$subject,$cuerpo);   
		$envia_confirmacion = wp_mail($to,$subject,$cuerpo,$headers);   
		
$re = 	count($preguntas); //leer sizeof

for($i=0;$i<$re;$i++){    

if(!empty($respuestas[$i])){
$sql = 
"insert into tbl_respuestas (id_pregunta,id_evento,id_usuario,respuesta) values ($preguntas[$i],$idEvento,$id_usuario,'$respuestas[$i]')"	;
$consulta = $wpdb->query($sql);

}//end for
//$wpdb->show_errors();
//$wpdb->print_error();
}//end if

	$objEvento = new Evento();
	  $objEvento->set_Id_evento($idEvento);
	  $objEvento->setId_usuario($id_usuario);
	  $objEvento->setFecha_inscripcion($fecha_inscripcion);	  
	  $objEvento->set_tipo_pago($tipoPago); 
	  $sqlIns = $wpdb->query($objEvento->agregarInscripcion());  


//$wpdb->show_errors();
//$wpdb->print_error();
	
	//el envio es correcto
	 if($sqlIns && $envia_confirmacion){
        $arr = array("msg"=>1);		
		echo json_encode($arr);		
        unset($objEvento);    
		}
	 //si no se inserto
		elseif(empty ($sqlIns) && !empty ($envia_confirmacion)){
        $arr = array("msg"=>2);		
		echo json_encode($arr);		
        unset($objEvento);    
     	}
	 //si no se envio el mail
		elseif(!empty ($sqlIns) && empty ($envia_confirmacion)){
        $arr = array("msg"=>3);		
		echo json_encode($arr);		
        unset($objEvento);    
     	}
	 //no inserta ni se envia
		elseif(empty ($sqlIns) && empty ($envia_confirmacion)){
        $arr = array("msg"=>0);		
		echo json_encode($arr);		
        unset($objEvento);    
     	}

}*/

function datos_inscripcion(){	
	global $mvc;	/** llamo la ruta global **/	
    //llamar a la vista

	$path =  $mvc . 'vistas/datos_inscripcion.php'; /** armo el path completo **/		
  	include($path);/**Muestra la vista*/	
}

function consultarInscritos($id_evento){
    global $wpdb;
	$objEvento = new Evento();
	$datosInscritos=$wpdb->get_results($objEvento->buscarInscritos($id_evento));
	return $datosInscritos;	
	unset ($objEvento);
}

function nombreUsuario($id_usuario){
    global $wpdb;
	$objEvento = new Evento();
	$usuarioInscrito=$wpdb->get_results($objEvento->nombre_usuario($id_usuario));
	return $usuarioInscrito;
	unset ($objEvento);
}

function consultaRespuestas($idUser,$idEvento){
	global $wpdb;
	$objEvento = new Evento();
	$respuestas=$wpdb->get_results($objEvento->consultar_respuestas($idUser,$idEvento));
	return $respuestas;
	unset ($objEvento); 
}

function consulta_preguntas($idUser,$idEvento){
	global $wpdb;	
	$sqlQuery = "SELECT * FROM tbl_preguntas INNER JOIN tbl_respuestas ON tbl_preguntas.id_pregunta=tbl_respuestas.id_pregunta WHERE tbl_respuestas.id_usuario = $idUser AND tbl_preguntas.id_evento=$idEvento";
	$items=$wpdb->get_results($sqlQuery);  	
	return  $items;	
}	


//agregar respuestas 
function addRespuestas(){
	global $wpdb;		
    $consultaNoPreguntas = $_POST["numeroPreguntas"]; //count -> indica el numero de preguntas 

	  if(!empty($consultaNoPreguntas)){
	    for($i=1;$i<=$consultaNoPreguntas;$i++){
			$pregunta = $_POST["pregunta".$i];
			$id_evento = $_POST["idEvento"];
			$mtzRespuesta = $_POST["respuestas".$i];   

// 			$HK_mtz = array("azul","rojo","tres","verde","amarillo");
			//$mtzRespuesta = $HK_mtz;
	        $topeRespuesta = count($mtzRespuesta);
			
    	$contMtz = 0;
    	for($a=1;$a<=$topeRespuesta;$a++){
    		//echo $mtzRespuesta[$contMtz]. "<br>";
			if(!empty($mtzRespuesta[$contMtz])){
		    $sql = "INSERT INTO tbl_respuestas_definidas (id_pregunta,id_evento,respuesta) VALUES ($pregunta,$id_evento, '$mtzRespuesta[$contMtz]')";   
			$consulta = $wpdb->query($sql);
			}//end if respuestas vacias

    		$contMtz++;
    	}//close for topeRespuestas 

	 }//close for consultanoPreguntas 

   }//close if
   
   	 if($consulta){
//CORRECTO
        $arr = array("msg"=>1);		
		echo json_encode($arr);		
        unset($objEvento);    
		}else{
//FALSO
        $arr = array("msg"=>0);		
		echo json_encode($arr);		
        unset($objEvento);    
	}

   
}// end function

function savePay(){
	global $wpdb;
if (isset($_POST['option-pay'])) {
    $optionArray = $_POST['option-pay'];
	$id_evento = $_POST['id_evento'];
    for ($i=0; $i<count($optionArray); $i++) {
		//echo "$optionArray[$i] del evento $id_evento <br>";
		$sql = "INSERT INTO tbl_tipoPagos (id_evento, indicador_pago) VALUES ($id_evento,$optionArray[$i])";		
		$consulta = $wpdb->query($sql); 
    }
}
 	 if($consulta){ //CORRECTO ?>
     <div class="mensaje"><h2>Se asignaron exitosamente los metodos de pago.</h2></div>       
		<script>            			
		setTimeout(function(){location.href="http://identidadatleta.com/cms/wp-admin/admin.php?page=agregar_eventos", 8000} );        </script>
	 
	 <?php 
	 }else{  //FALSO 
     
	 echo "No se Agregaron Metodos de pago";
     
	}
}

function consulta_pagos($id_evento){
	global $wpdb;	
	$sqlQuery = "SELECT * FROM tbl_tipoPagos WHERE id_evento=$id_evento";
	$pagos=$wpdb->get_results($sqlQuery);  	
	return  $pagos;
}	

function modifyPay(){
	global $wpdb;
	$id_evento=$_POST["id_evento"];  	
	$sqlQuery = "DELETE FROM tbl_tipoPagos WHERE id_evento=$id_evento";
	$pagos=$wpdb->query($sqlQuery);  	
	savePay();
}	



?>      
