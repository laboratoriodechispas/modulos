<?php
ini_set("display_errors",0);
include("header.php"); //incluye el header se encuentra dentro del directorio mvc/vista
global $PATH_DESTACADA;
global $PATH_THUMBNAIL;
?>
<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.3.0/pure-min.css"> 
<?php
$respuesta = $_GET['respuestas'];
$idUser = $_GET['id_user'];
$idEvento = $_GET['id_evento'];

if(!empty($idUser)){
	
$id_usuario = $idUser;
$usuarioInscrito=nombreUsuario($id_usuario);	
	foreach($usuarioInscrito as $datos)
	$nombre = $datos->nombre;
	$apellido_p = $datos->apellido_paterno;
	$apellido_m = $datos->apellido_materno;
}
	$nombreCompleto = $nombre . " " . $apellido_p . " " . $apellido_m;

if(!empty($idUser)){
	
	?><h3 class="titulo-main-corto"><?php echo "Respuestas de $nombreCompleto"; ?></h3><?php
	
	
	$items = consulta_preguntas($idUser,$idEvento);

	foreach($items as $items){      
		$answer = $items->respuesta;
		$question = $items->pregunta; 

		?>
	 <table class="lista" width="50%">
     	<tr>
        	<th>Pregunta</th>
            <th>Respuesta</th>
        </tr>
        <tr>
        	<td class="izquierda"><?php echo $question; ?></td>
        	<td class="izquierda"><?php echo $answer; ?></td>
        </tr>
        </table>
		<?php 
		}
	 
		
} else { 
	
$inscripcion = $_GET['inscripcions'];
$id_evento= $_GET['id'];

if(!empty ($id_evento)){
	$datosInscritos = consultarInscritos($id_evento);
	
	foreach($datosInscritos as $datosInscritos){
		$id_usuario = $datosInscritos->id_usuario;
		$id_evento = $datosInscritos->id_evento;
		$fecha_inscripcion = $datosInscritos->fecha_inscripcion;
		$funte_suscripcion = $datosInscritos->fuente_suscripcion;
		$tipo_pago = $datosInscritos->tipo_pago;
	}
	if(!empty($id_usuario)){
		$usuarioInscrito = nombreUsuario($id_usuario);	

		foreach($usuarioInscrito as $usuarioInscrito){
			$nombre = $usuarioInscrito->nombre;
			$apaterno = $usuarioInscrito->apellido_paterno;
			$amaterno = $usuarioInscrito->apellido_materno;
			$nombre_completo = $nombre . " " . $apaterno . " " . $amaterno;
		}
	}
	?>
    <h3 class="titulo-main">Competidores Inscritos</h3>
	 <table class="lista" border="0" width="100%">
        <tr>
          <th>Id Usuario</th>
          <th>Nombre</th>
          <th>Fecha de Iscripción</th>
          <th>Fuente de Suscripción</th>
          <th>Tipo de Pago</th>
          <th>Respuestas</th>
        </tr> 
        <tr>
        	<td><?php echo $id_usuario; ?></td>
            <td class="izquierda"><?php echo $nombre_completo; ?></td>
            <td><?php echo $fecha_inscripcion; ?></td>
            <td><?php echo $funte_suscripcion; ?></td>
            <?php 
			switch ($tipo_pago){
				case 1:
				$tipo_pago = "PayPal";
				break;
				case 2:
				$tipo_pago = "Tarjeta";
				break;
			}
			?>
            <td><?php echo $tipo_pago; ?></td>
            <td><a href="?page=agregar_eventos&accion=datos_inscripcion&id_evento=<?php echo $id_evento?>&id_user=<?php echo $id_usuario; ?>&respuestas=1">Ver Respuestas</a></td>
        </tr>                       
 </table>
 
<?php
}
}
?>