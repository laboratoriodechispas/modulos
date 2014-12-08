<?php
/**
* Actualiza imagen de thumbnail de eventos.
* En este modulo los paths se mueven manualmente
*@author Sergio Nava
*@version 1.0 | Creación: 2 noviembre 2013 | Ultima Actualización: 2 de noviembre del 2013 , por: SNR
*
*/

$carpeta = get_site_url()."/wp-content/plugins/gestion-identidad-atleta/images/uploads/imgThumbnail";
$archivadorUrl = get_site_url()."/wp-content/plugins/gestion-identidad-atleta/images/uploads/imgThumbnail/";
//$upload_folder ='images';
$upload_folder=$carpeta;
$nombre_archivo_anterior = $_REQUEST["OldNombreImagenThumbnail"];

$nombre_archivo = $_FILES['archivo']['name'];

$tipo_archivo = $_FILES['archivo']['type'];

$tamano_archivo = $_FILES['archivo']['size'];

$tmp_archivo = $_FILES['archivo']['tmp_name'];

$archivador = $upload_folder . '/' . $nombre_archivo;

if (file_exists($upload_folder . $nombre_archivo_anterior)) { unlink ($upload_folder . $nombre_archivo_anterior); }

if (!move_uploaded_file($tmp_archivo, $archivador)) {

	$return = array('ok' => FALSE, 'msg' => "Ocurrio un error al subir el archivo. No pudo guardarse.", 'status' => 'error');

}else{
	$return = array('msg' => "Se subio con exito ",'archivo'=>$archivadorUrl . $nombre_archivo,'nombreArchivo'=> $nombre_archivo);
}

echo json_encode($return);


?>