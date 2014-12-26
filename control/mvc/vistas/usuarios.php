<?php
ini_set("display_errors",0);
include("header.php"); //incluye el header se encuentra dentro del directorio mvc/vista
global $PATH_DESTACADA;
global $PATH_THUMBNAIL;
   
?>

<script src="<?php echo $templatepath; ?>ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo $templatepath; ?>js/spark.validator.js"></script>
<script type="text/javascript" src="<?php echo $templatepath; ?>js/usuarios.js"></script>
<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.3.0/pure-min.css">
<script type="text/javascript" src="<?php echo $templatepath; ?>js/jconfirmaction.jquery.js"></script>
<script><!-- Script para eliminar usuario (Eliminado logico)-->
  $(document).ready(function() {        
        
    $('.ask-plain').click(function(e) {
          
      e.preventDefault();
      thisHref  = $(this).attr('href');
          
      if(confirm('Are you sure')) {
      window.location = thisHref;
      }
          
    });
        
    $('.ask-custom').jConfirmAction({question : "Anda Yakin?", yesAnswer : "Ya", cancelAnswer : "Tidak"});
    $('.ask').jConfirmAction();
  });
      
</script>

<div id="main-content-plugin">
  <div class="frm-principal-eventos">
    <h2>Usuarios</h2>
<?php
$id = (empty($_GET['id'])) ? '' : $_GET['id'];
$questions = (empty($_GET['questions'])) ? '' : $_GET['questions'];
$payments = (empty($_GET['payments'])) ? '' : $_GET['payments'];

$consultar_perfil = $_GET['consulta_id'];

//**********************consulta detalles de perfil****************************

if($consultar_perfil){
	?><h3 class="titulo-main-corto">Detalles del perfil</h3><?php 
  $datos_perfil = datosPerfil($consultar_perfil);
	

  foreach($datos_perfil as $datos_perfil){
	  $dataIdUsuario = $datos_perfil->id_usuario;
	  $dataNombreUsuario = $datos_perfil->nombre;
	  $dataApellidoPat = $datos_perfil->apellido_paterno;
	  $dataApellidoMat = $datos_perfil->apellido_materno;
 	  $dataTxtemail = $datos_perfil->email; 
	  $dataFechaNacimiento = $datos_perfil->fecha_nacimiento;
	  $dataPais = $datos_perfil->pais_nacimiento;
	  $dataDireccion = $datos_perfil->direccion;
	  $dataEstado = $datos_perfil->id_estado;
	  $dataColonia = $datos_perfil->colonia;
	  $dataDelegacion = $datos_perfil->delegacion_municipio;
	  $dataCp = $datos_perfil->cp;
	  $dataSexo = $datos_perfil->sexo;
	  $dataTelefono = $datos_perfil->telefono_contacto;
	  $datosActivo = $datos_perfil->status;
	  
	  $dataNombreCompleto = $dataNombreUsuario . $dataApellidoPat . $dataApellidoMat;
	  
	  //datos de la tabla Perfil
	  $nombre_estado = nombreEstadoPerfil($dataEstado);
	  	
	  
	  //trae el nombre del estado en un arreglo 
	  foreach($nombre_estado as $nombre_estado){
		$dataNombreEstado = $nombre_estado->nombre_estado;
	  }
	  
	  $datosPerfilUs = datos_Perfil_Us($consultar_perfil);
	  
	  foreach ($datosPerfilUs as $usuarioPerfil){

	  $id_playera = $usuarioPerfil->id_talla_playera;
	  $id_marca_tenis = $usuarioPerfil->id_marca_tennis;
	  $id_marca_ropa = $usuarioPerfil->id_marca_ropa;
	  $id_marca_bicicleta = $usuarioPerfil->id_marca_bicicleta;
	  $id_entrenamiento = $usuarioPerfil->id_entrenamiento;
	  $id_carrera = $usuarioPerfil->id_carrera_preferida;
	  $id_medio = $usuarioPerfil->id_medio;
  	  }
	  
	  //talla de playera 	  
	  switch ($id_playera){
		  case 1:
		  $talla_playera = "XS";
		  break;
		  
		  case 2:
		  $talla_playera = "S";
		  break;
		  
		  case 3;
		  $talla_playera = "M";
		  break;
		  
		  case 4:
		  $talla_playera = "L";
		  break;
		  
		  case 5:
		  $talla_playera = "XL";
		  break;
	  }
	  
	  //MARCA DE TENIS 
	  switch ($id_marca_tenis){
		  case 1;
		  $marca_tenis = "NIKE";
		  break;
		  
		  case 2:
		  $marca_tenis = "REBOOK";
		  break;
		  
		  case 3:
		  $marca_tenis = "NEWTON";
		  break;
		  
		  case 4:
		  $marca_tenis = "MIZUNO";
		  break;
		  
		  case 5:
		  $marca_tenis = "BROOKS";
		  break;
		  
		  case 6:
		  $marca_tenis = "NEW BALANCE";
		  break;
		  
		  case 7:
		  $marca_tenis = "PEARL";
		  break;
		  
		  case 8:
		  $marca_tenis = "IZUMO";
		  break;
		  
		  case 9:
		  $marca_tenis = "ZOOT";
		  break;
		  
		  case 10:
		  $marca_tenis = "OTROS";
		  break;		  		 
	  }
	  
	  //NOMBRE DE LA MARCA DE ROPA 
	  switch ($id_marca_ropa){
		  case 1:
		  $marca_ropa = "ARENA";
		  break;
		  
		  case 2:
		  $marca_ropa = "SPEED";
		  break;
		  
		  case 3:
		  $marca_ropa = "OTRA";
		  break;
	  }
	  
	  //NOMBRE DE LA MARCA DE BICICLETA 
	  switch ($id_marca_bicicleta){
		  case 1;
		  $marca_bicicleta = "PINARELLO";
		  break;
		  
		  case 2;
		  $marca_bicicleta = "TREK";
		  break;
		  
		  case 3;
		  $marca_bicicleta = "QUINTA ROO";
		  break;
		  
		  case 4;
		  $marca_bicicleta = "ORBEA";
		  break;
		  
		  case 5;
		  $marca_bicicleta = "BMC";
		  break;
		  
		  case 6;
		  $marca_bicicleta = "SPECIALIZED";
		  break;
		  
		  case 7;
		  $marca_bicicleta = "OTRA";
		  break;
	  }
	  
	  //ENTRENAMIENTO POR SEMANA 
	  switch($id_entrenamiento){
		  case 1:
		  $entrenamiento = "1 DIA A LA SEMANA";
		  break;
		  
		  case 2:
		  $entrenamiento = "3 DIAS A LA SEMANA";
		  break;
		  
		  case 3:
		  $entrenamiento = "5 DIAS A LA SEMANA";
		  break;
		  
		  case 4:
		  $entrenamiento = "MAS DIAS A LA SEMANA";
		  break;
	  }
	  
	  //CARRERA PREFERIDA 
	  switch ($id_carrera){
		  case 1:
		  $carrera_preferida = "CARRERA 5KM";
		  break;
		  
		  case 2:
		  $carrera_preferida = "CARRERA 10KM";
		  break;
		  
		  case 3:
		  $carrera_preferida = "MEDIO MARATÓN";
		  break;
		  
		  case 4:
		  $carrera_preferida = "MARATÓN";
		  break;
		  
		  case 5:
		  $carrera_preferida = "TRIATLÓN OLÍMPICO";
		  break;
		  
		  case 6:
		  $carrera_preferida = "IRONMAN";
		  break;
		  
		  case 7:
		  $carrera_preferida = "DUATLÓN";
		  break;
		  
		  case 8:
		  $carrera_preferida = "CICLISMO DE RUTA";
		  break;
		  
		  case 9:
		  $carrera_preferida = "CICLISMO DE MONTAÑA";
		  break;
		  
		  case 10:
		  $carrera_preferida = "NATACIÓN AGUAS ABIERTAS";
		  break;
	  }
	  
	  switch ($id_medio){
		  case 1:
		  $medio_informativo = "SMARTPHONE";
		  break;
		  
		  case 2:
		  $medio_informativo = "TABLETA";
		  break;

		  case 3:
		  $medio_informativo = "PC";
		  break;

		  case 4:
		  $medio_informativo = "MAC";
		  break;
	  }
    
?>		
	<table class="lista" width="51%">
    <tr>
    	<td class="izquierda" style="font-weight:bold">Id Usuario</td>
        <td class="izquierda"><?php echo $dataIdUsuario; ?></td>
    </tr>
    <tr>
    	<td class="izquierda" style="font-weight:bold">Nombre</td>
        <td class="izquierda"><?php echo $dataNombreCompleto; ?></td>
    </tr>
    <tr>
    	<td class="izquierda" style="font-weight:bold">Fecha de Nacimiento</td>
        <td class="izquierda"><?php echo $dataFechaNacimiento; ?></td>
    </tr>
    <tr>
    	<td class="izquierda" style="font-weight:bold">Pais de Nacimiento</td>
        <td class="izquierda"><?php echo $dataPais; ?></td>
    </tr>
    <tr>
    	<td class="izquierda" style="font-weight:bold">Estado</td>
        <td class="izquierda"><?php echo $dataNombreEstado; ?></td>
    </tr>
    <tr>
    	<td class="izquierda" style="font-weight:bold">Calle y Número</td>
        <td class="izquierda"><?php echo $dataDireccion; ?></td>
    </tr>
    <tr>
    	<td class="izquierda" style="font-weight:bold">Colonia</td>
        <td class="izquierda"><?php echo $dataColonia; ?></td>
    </tr>
    <tr>
    	<td class="izquierda" style="font-weight:bold">Delegación</td>
        <td class="izquierda"><?php echo $dataDelegacion; ?></td>
    </tr>
    <tr>
    	<td class="izquierda" style="font-weight:bold">Codigo Postal</td>
        <td class="izquierda"><?php echo $dataCp; ?></td>
    </tr>
    <tr>
    	<td class="izquierda" style="font-weight:bold">Sexo</td>
        <td class="izquierda"><?php echo $dataSexo; ?></td>
    </tr>
    <tr>
    	<td class="izquierda" style="font-weight:bold">Teléfono</td>
        <td class="izquierda"><?php echo $dataTelefono; ?></td>
    </tr>
    <tr>
    	<td class="izquierda" style="font-weight:bold">Talla de Playera</td>
        <td class="izquierda"><?php echo $talla_playera; ?></td>
    </tr>
    <tr>
    	<td class="izquierda" style="font-weight:bold">Marca de Tenis</td>
        <td class="izquierda"><?php echo $marca_tenis; ?></td>
    </tr>
    <tr>
    	<td class="izquierda" style="font-weight:bold">Marca de Ropa</td>
        <td class="izquierda"><?php echo $marca_ropa; ?></td>
    </tr>
    <tr>
    	<td class="izquierda" style="font-weight:bold">Marca de Bicicleta</td>
        <td class="izquierda"><?php echo $marca_bicicleta; ?></td>
    </tr>
    <tr>
    	<td class="izquierda" style="font-weight:bold">Entrenamiento por Semana</td>
        <td class="izquierda"><?php echo $entrenamiento; ?></td>
    </tr>
    <tr>
    	<td class="izquierda" style="font-weight:bold">Carrera Preferida por el Usuario</td>
        <td class="izquierda"><?php echo $carrera_preferida; ?></td>
    </tr>
    <tr>
    	<td class="izquierda" style="font-weight:bold">Medio de Información</td>
        <td class="izquierda"><?php echo $medio_informativo; ?></td>
    </tr>
    <tr>
    	<td class="izquierda" style="font-weight:bold">Activo</td>
        <td class="izquierda"><?php if($datosActivo==1){ echo "Si"; } if($datosActivo==0){ echo "No"; } ?></td>
    </tr>
    </table>
    
    <a href="admin.php?page=perfil_usuarios">Regresar</a>
        
        <?php
  }
?>
	</div>

<?php

}else{    //termina busqueda detalle perfil
	
//************************busqueda de todos los usuarios***********************************
?>
    <!---busqueda de eventos-->

    <table>
      <tr>
        <td><h4>Busqueda:</h4></td>
        <td><input type="text" name="buscar_usuario" id="buscar_usuario" /></td>
        <td></td>
          </td>
        <td><div id="cargando_busqueda"><img src="<?php echo get_bloginfo("url")."/wp-content/plugins/gestion-identidad-atleta/images/loading.gif"; ?>" width="30" height="30" /></div></td>
      </tr>
    </table>

<?php 
/********************************************************
*Activar busqueda si se detecta un ID diferente a vacio.*
*********************************************************/
  $IdEliminar = $_GET['ideliminar'];
	if($IdEliminar){
		$elimina_usuario = eliminarUsuario($IdEliminar);
	}
    if($id<=0){      
    ?>
    <h3 class="titulo-main">Lista de Usuarios</h3>
    <div id="frmBusqueda">
      <table class="lista"  width="100%">
      <tr>
      	<th>Numero de usuario</th>
          <th align="left">Nombre   <a href='#' onClick="busqueda_clinte_orden('','asc');"><img src="<?php bloginfo('url'); ?>/wp-content/plugins/gestion-identidad-atleta/images/arrow-up-icon.png" ></a> <strong>|</strong> <a href='#' onClick="busqueda_cliente_orden('','desc');"><img src="<?php bloginfo('url'); ?>/wp-content/plugins/gestion-identidad-atleta/images/arrow-down-icon.png" ></a> </th>
          <th>E-mail</th>
          <th>Perfil</th>
          <th>Modiicar</th>
          <th>Eliminar</th>
        </tr> 
        <?php
      /*Genera los resultados de la busqueda*/
      ?>
        <?php
  /*
  busqueda de usuario ,solicita id user actual para activar permisos.
  regresa un array de items
  */  
 
  global $TAMANO_PAGINA;  
  $inicio = $_GET["pagina"]; //indicador de cursor 
  if($inicio=="") $inicio = 0;  
  $items = busquedaUsuarios($idusersicisa,$buscar,$inicio,$TAMANO_PAGINA,$whereconsulta);
  $contador=0; //para el id de jquery

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
          <td class="izquierda"><?php echo $nombreCompleto; ?></td>
          <td class="izquierda"><?php  echo $txtemail; ?></td>
          <td><a href="?page=perfil_usuarios&consulta_id=<?php echo $idUsuario_cos;?>"><img src="<?php echo $templatepath; ?>images/usuario.png" >Ver Perfil</a></td>
          <td><a href="?page=perfil_usuarios&accion=modificar_perfil&modificar_id=<?php echo $idUsuario_cos;?>"><img src="<?php echo $templatepath; ?>images/modificaru.png" >Modificar</a></td>
          <td><a href="?page=perfil_usuarios&ideliminar=<?php echo $idUsuario_cos;?>" class="ask"><img src="<?php echo $templatepath; ?>/images/borraru.png" /> Eliminar</a></td>
          
        </tr>
        <?php
  }
?>
        <!-- paginacion -->
        <tr>
          <td colspan="6"><?php 

        ?></td>
        </tr>
        <!-- paginacion -->
      </table>
    </div>


<?php } ?>



     <script>
     
    //Iniciar el 
    var config = {
        startupMode:'source'
      };
    editor = CKEDITOR.appendTo( 'editor', config, html );
    CKEDITOR.instances.editor1.setData($("#contenidohtml").val());

      

    </script>

    <?php } ?>
    <?php
	
	$modificar_usuario = $_GET['modificar_id'];
	
	if($modificar_usuario){
		echo "aqui estoy";
	}
	
	?>
  <div class="clearing"></div>
  <div><!--frm-principal-eventos-->
    <div class="clearing"></div>
  </div>
  <!--main-content-plugin--> 
  
</div>
<!--wpbody-content--> 

<script type="text/javascript" src="<?php echo $templatepath; ?>js/vistaAddUsuarios.js"></script>