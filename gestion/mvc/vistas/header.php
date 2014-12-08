<?php 
/*
 *Hedear principala para todas las vistas, contiene las llamadas a los archivos que se comparten con todas las vistas 
 */
//session_start();  
$templatepath = get_bloginfo("url") . "/wp-content/plugins/gestion-identidad-atleta/"; //variable general de la ubicación de los archivos  

 /**archivos css*/ ?>
<link rel="stylesheet" href="<?php echo $templatepath; ?>css/main.css" />

<?php /**script archivos js*/ ?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
