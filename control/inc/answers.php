<?php
/**
* Actualiza imagen de destacada de eventos.
* Gestion de preguntas
*@author Sergio Nava
*@version 1.0 | Creación: 3 noviembre 2013 | Ultima Actualización: 3 de noviembre del 2013 , por: SNR
*
*/
ini_set("display_errors",1);
//Importacion de librerias MVC



//Obtener nombre de Evento

?>
<!--scripts-->
<script type="text/javascript" src="<?php echo $templatepath; ?>js/reCopyAnswers.js"></script>
<script type="text/javascript">
$(function(){
var removeLink = ' <a class="remove" href="#" onclick="$(this).parent().slideUp(function(){ $(this).remove() }); return false">Eliminar</a>';
$('a.add').relCopy({ append: removeLink});
});
</script>
<!--scripts-->

<?php



//obtener preguntas
$mtz = consultaPreguntas($id);
$mtzPreguntas = consultaTotalPreguntas($id);
$noPreguntas = count($mtz);
?>

<form method="post" id="frmPreguntas">
<fieldset class="preguntas-evento">
   <legend class="nuevo-evento-titulo">Respuestas Definidas</legend>
   <h4>Evento: <?php echo nombreEvento($id); ?></h4>   
<?php
//foreach($mtzPreguntas as $idPreguntas){ 

if(!empty($mtzPreguntas)){
	$a=0;
  $b=1;
   foreach($mtzPreguntas as $preguntas){
	   
?>
    <p class="clone">
    <p><label><?php echo textoPregunta($preguntas); ?></label></p>   
    
    <input type="hidden" name="pregunta<?php echo $b;?>" value="<?php echo $preguntas; ?>">
    <p class="clone<?php echo $b;?>">
    <input type="text" name="respuestas<?php echo $b;?>[]" id="respuestas" class='input' style="width:200px;" />
   </p>
    <a href="#" class="add" rel=".clone<?php echo $b;?>">Agregar Más</a>
    

    </p>
<?php 
    $b++; //para usar el contador desde 1, es decir pregunta1, pregunta2.
    $a++;
   } //foreach
} else { 
 echo "Primero agregar preguntas.";
  ?>

<?php } ?>
       <input type="hidden" name="accion" value="addRespuestas"/>
       <input type="hidden" name="controlador" value="eventos"/>
       <input type="hidden" name="action" value="wpaction_guardar_preguntas"/>
       <input type="hidden" name="idEvento" id="idEvento" value="<?php echo $id; ?>">
       <input type="hidden" name="numeroPreguntas" id="numeroPreguntas" value="<?php echo $noPreguntas; ?>">
       <div id="frmAviso"></div>
       <input type="button" class="pure-button"  value="Guardar Respuestas" id="btnGuardarPreguntas">
       <input type="button" class="pure-button"  value="Terminar" id="btnCancelarEvento">
</fieldset>
</form>
