<?php

$carpeta=get_site_url()."/wp-content/plugins/gestion-identidad-atleta/images/uploads/imgDestacada";
//$upload_folder ='images';
$upload_folder=$carpeta;

$nombre_archivo = $_FILES['archivo']['name'];

$tipo_archivo = $_FILES['archivo']['type'];

$tamano_archivo = $_FILES['archivo']['size'];  

$tmp_archivo = $_FILES['archivo']['tmp_name'];

$archivador = $upload_folder . '/' . $nombre_archivo;



if (!move_uploaded_file($tmp_archivo, $archivador)) {

	$return = array('ok' => FALSE, 'msg' => "Ocurrio un error al subir el archivo. No pudo guardarse.", 'status' => 'error');

}else{
	$return = array('msg' => "Se subio con exito ",'archivo'=>$nombre_archivo);
}

echo json_encode($return);


?>