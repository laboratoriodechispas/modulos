<?php
/*
 *Controlador para la gestión de los eventos  de identidad atleta 
*/
require($_SERVER['DOCUMENT_ROOT'].'/identidadatleta/v1/wp-content/plugins/gestion-identidad-atleta/mvc/modelos/Usuarios.php'); // se define el modelo que se usara de manera general
global $mvc;
$mvc =  $_SERVER['DOCUMENT_ROOT'] . "/identidadatleta/v1/wp-content/plugins/gestion-identidad-atleta/mvc/";
//ruta de la carpeta MVC
function perfil_usuario()
{  
	global $mvc;	/** llamo la ruta global **/	
    //llamar a la vista

	$path =  $mvc . 'vistas/usuarios.php'; /** armo el path completo **/		
  	include($path);/**Muestra la vista*/	
}

//consulta los datos del usuario de la tabla tblusuarios
function datosPerfil($consultar_perfil){	
  global $wpdb;
  $objEvento = new Usuario();
  $datos_perfil=$wpdb->get_results($objEvento->busquedaPerfiles($consultar_perfil));
  return $datos_perfil;	
  unset($objEvento);
//  $wpdb->show_errors();
//  $wpdb->print_error();  
}

//consulta los datos del usuario de la tabla tblperfiles
function datos_Perfil_Us($consultar_perfil){	
  global $wpdb;
  $objEvento = new Usuario();
  $datosPerfilUs=$wpdb->get_results($objEvento->datostblPerfil($consultar_perfil));
  return $datosPerfilUs;	
  unset($objEvento);
//  $wpdb->show_errors();
//  $wpdb->print_error();  
}

//CONSULTA EL NOMBRE DEL ESTADO 
function nombreEstado(){	
  global $wpdb;
  $objEvento = new Usuario();
  $nombre_estado=$wpdb->get_results($objEvento->datosNombreEstado());
  return $nombre_estado;	
  unset($objEvento);
//  $wpdb->show_errors();
//  $wpdb->print_error();  
}


//update para descativar usuario

function eliminarUsuario($IdEliminar){	
  global $wpdb;
  $objEvento = new Usuario();
  $elimina_usuario=$wpdb->query($objEvento->EliminaUsuario($IdEliminar));
  return $elimina_usuario;	
  unset($objEvento);
//  $wpdb->show_errors();
//  $wpdb->print_error();  
}

function busquedaUsuarios($iduser,$buscar,$inicio,$TAMANO_PAGINA,$whereconsulta){	
  global $wpdb;
  $objEvento = new Usuario();
  $items=$wpdb->get_results($objEvento->busquedaUsuarios($iduser,$buscar,$inicio,$TAMANO_PAGINA,$whereconsulta));
  return $items;	
  unset($objEvento);
  $wpdb->show_errors();
  $wpdb->print_error();  
}


/*
Paginación
*/
function paginacion($buscar,$items,$TAMANO_PAGINA){	

$pos = strpos($paginacion,"&pagina");
if($pos==0){
	$variables = request_URI() . "&pagina=";
}else{
	$variables = substr(request_URI(),0,$pos) . "&pagina="; 
}

$tamano = sizeof($items);
$total = $tamano / $TAMANO_PAGINA;
if($total<=0) $total=1;
if($total>=1){ echo "<strong>Paginación: </strong>"; }
	for($i=0;$i<=$total-1;$i++){	  
	  echo "<a href='#' onclick=paginacion('".$buscar."','".$i."')>";
	  echo  $i+1;
	  echo "</a>";
	}
}

/*Adaptacion para busqueda*/
function buscaUsuarios(){		
global $TAMANO_PAGINA;
//fill llena dos parametros texto para el GUI y un hidden para operacion
//fill(nombre,id,txtnombre,txthidden,listaaesconder);
?> 
<?php $templatepath = get_bloginfo("url") . "/wp-content/plugins/sistema/"; ?>
<table class="lista"  width="100%">
      <tr>
      	<th>Numero de usuario</th>
          <th align="left">Nombre   <a href='#' onClick="busqueda_usuario_orden('','asc');"><img src="<?php bloginfo('url'); ?>/wp-content/plugins/gestion-identidad-atleta/images/arrow-up-icon.png" ></a> <strong>|</strong> <a href='#' onClick="busqueda_usuario_orden('','desc');"><img src="<?php bloginfo('url'); ?>/wp-content/plugins/gestion-identidad-atleta/images/arrow-down-icon.png" ></a> </th>
          <th>E-mail</th>
          <th>Perfil</th>
          <th>Eliminar</th>
        </tr>
<?php
/*Genera los resultados de la busueda*/
?>
<?php
  /*
  busqueda de empresas,solicita id user actual para activar permisos.
  regresa un array de items
  */  
 global $TAMANO_PAGINA;  
  $inicio = $_GET["pagina"]; //indicador de cursor 
  if($inicio=="") $inicio = 0;  
  $items = busquedaUsuarios($idusersicisa,$buscar,$inicio,$TAMANO_PAGINA,$whereconsulta);
  $contador=0; //para el id de jquery
  print_r($items);
  foreach($items as $item){
	  $idUsuario_cos = $item->id_usuario;
	  $nombreUsuario = $item->nombre;
	  $apellidoPat = $item->apellido_paterno;
	  $apellidoMat = $item->apellido_materno;
 	  $txtemail = $item->email; 
	  
	  $nombreCompleto = $nombreUsuario . $apellidoPat . $apellidoMat;
	  
  $contador++;
  /*estilo css dinamico*/
  	if($contador % 2){
		  $estilo = "background-color:#CCC;";	
	}else{
		  $estilo = "background-color:#eeeeec;";
	}	
?>
          <tr>
          <td><?php echo $idUsuario_cos; ?></td>
          <td><?php echo $nombreCompleto; ?></td>
          <td><?php  echo $txtemail; ?></td>
          <td>Ver Perfil</a></td>
          
          <td><a href="?page=agregar_eventos&controlador=eventos&accion=eliminarEvento&ideliminar=<?php echo $item->id_evento;?>" class="ask"><img src="<?php echo $templatepath; ?>/images/delete-icon.png" /> Eliminar</a></td>
        </tr>
<?php
  }
?> 
<!-- paginacion -->
<tr>   
<td colspan="4">
<?php 
 		//$items = busquedaClientes($iduser,$buscar,0,0,$whereconsulta);
        //paginacion("",$items,$TAMANO_PAGINA);
?>
</td>
</tr>
<!-- paginacion -->
</td>
</table>
 </div>
<?php
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

function modificar_perfil(){	
	global $mvc;	/** llamo la ruta global **/	
    //llamar a la vista

	$path =  $mvc . 'vistas/modificar_usuarios.php'; /** armo el path completo **/		
  	include($path);/**Muestra la vista*/	
}

function datosUsuario($id_usuario_mod){
	global $wpdb;
	$objEvento = new Usuario();
	$datos_usuario=$wpdb->get_results($objEvento->consultarDatos($id_usuario_mod));
	return $datos_usuario;	
	unset($objEvento);
	$wpdb->show_errors();
	$wpdb->print_error();  
}

function consultaPerfilMod($id_usuario_mod){	
  global $wpdb;
  $objEvento = new Usuario();
  $datos_Perfil_Us=$wpdb->get_results($objEvento->datostblPerfilMod($id_usuario_mod));
  return $datos_Perfil_Us;	
  unset($objEvento);
//  $wpdb->show_errors();
//  $wpdb->print_error();  
}

function consultaTallaPlayera(){
  global $wpdb;
  $objEvento = new Usuario();
  $opcion_playera=$wpdb->get_results($objEvento->opcionTallaPlayera());
  return $opcion_playera;	
  unset($objEvento);
	
}

function consultaMedio(){
  global $wpdb;
  $objEvento = new Usuario();
  $opcion_medio=$wpdb->get_results($objEvento->opcionMedio());
  return $opcion_medio;	
  unset($objEvento);
	
}

function consultaCarrera(){
  global $wpdb;
  $objEvento = new Usuario();
  $opcion_carrera=$wpdb->get_results($objEvento->opcionCarrera());
  return $opcion_carrera;	
  unset($objEvento);
}

function consultaEntrenamientos(){
  global $wpdb;
  $objEvento = new Usuario();
  $opcion_entrenamientos=$wpdb->get_results($objEvento->opcionEntrenamientos());
  return $opcion_entrenamientos;	
  unset($objEvento);
}

function consultaMarcaTenis(){
  global $wpdb;
  $objEvento = new Usuario();
  $opcion_marcaTenis=$wpdb->get_results($objEvento->opcionMarcaTenis());
  return $opcion_marcaTenis;	
  unset($objEvento); 
}

function consulta_MarcaBicicleta(){
  global $wpdb;
  $objEvento = new Usuario();
  $opcion_marcaBici=$wpdb->get_results($objEvento->opcionMarcaBicicleta());
  return $opcion_marcaBici;	
  unset($objEvento); 
}

function consultaMarcaRopa(){
  global $wpdb;
  $objEvento = new Usuario();
  $opcion_marcaRopa=$wpdb->get_results($objEvento->opcionMarcaRopa());
  return $opcion_marcaRopa;	
  unset($objEvento); 	
}
	
function nombreEstadoPerfil($dataEstado){	
  global $wpdb;
  $objEvento = new Usuario();
  $nombre_estado=$wpdb->get_results($objEvento->name_EstadoPerfil($dataEstado));
  return $nombre_estado;	
  unset($objEvento);
//  $wpdb->show_errors();
//  $wpdb->print_error();  
}

function actualizar_infoUsuario(){
	global $wpdb;
	
	$idUsuario_fmr = $_POST["id_Usuario"];	
	$nombre_frm = $_POST["nombre"];
	$aPaterno_frm = $_POST["apaterno"];		
	$aMaterno_frm = $_POST["amaterno"];	
	$dia_frm = $_POST["dia"];
	$mes_frm = $_POST["mes"];
	$anio_frm = $_POST["anio"];
	$paisNacimiento_frm = $_POST["paisNacimiento"];		
	$telefono_frm = $_POST["telefono"];	
	$sexo_frm = $_POST["sexo"];	
	$calle_frm = $_POST["calle"];	
	$estado_frm =  $_POST["estado"];
	$colonia_frm = $_POST["colonia"];	
	$delegacion_frm = $_POST["municipio"];	
	$cp_frm = $_POST["cp"];	
	$tallaPlayera_frm = $_POST["playera"];	 
	$medio_frm = $_POST["medio"];	
	$entrenamiento = $_POST["entrena"];	
	$marcaTenis_frm = $_POST["tenis"];	
	$marcaBici_frm = $_POST["bicicleta"];	
	$marcaRopa_frm = $_POST["ropanatacion"];	
	$fechaNacimiento_frm = $dia_frm . "-" . $mes_frm . "-" . $anio_frm; 
	
	$objEvento = new Usuario();
	$objEvento->set_id_usuario($idUsuario_fmr);
	$objEvento->set_nombre($nombre_frm);
	$objEvento->set_aPaterno($aPaterno_frm);
	$objEvento->set_aMaterno($aMaterno_frm);
	$objEvento->set_fecha_nacimiento($fechaNacimiento_frm);
	$objEvento->set_pais($paisNacimiento_frm);
	$objEvento->set_telefono($telefono_frm);
	$objEvento->set_sexo($sexo_frm);
	$objEvento->set_calle($calle_frm);
	$objEvento->set_estado($estado_frm);
	$objEvento->set_colonia($colonia_frm);
	$objEvento->set_delegacion($delegacion_frm);
	$objEvento->set_cp($cp_frm);
	/*$objEvento->set_talla_playera($tallaPlayera_frm);
	$objEvento->set_medio($medio_frm);
	$objEvento->set_entrenamiento($entrenamiento);
	$objEvento->set_marca_tenis($marcaTenis_frm);
	$objEvento->set_marca_bicicleta($marcaBici_frm);
	$objEvento->set_marca_ropa($marcaRopa_frm);*/
	
	
	$consulta = $wpdb->query($objEvento->actualizaDatosUsuario());
		 
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
	


?>