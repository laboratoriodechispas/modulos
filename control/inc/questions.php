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
<script type="text/javascript" src="<?php echo $templatepath; ?>js/reCopy.js"></script>
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
$id = $_GET['id'];
?>

<form method="post" id="frmPreguntas">
<fieldset class="preguntas-evento">
   <legend class="nuevo-evento-titulo">Preguntas</legend>
   <h4>Evento: <?php echo nombreEvento($id); ?></h4>

<?php 
if(!empty($mtz)){
foreach($mtz as $preguntas){
?>
<p class="clone"><input type="text" name="preguntas[]" id="preguntas" class='input' style="width:200px;" value="<?php echo $preguntas; ?>"/></p>
<?php 
} //foreach
} else { ?>
<p class="clone"><input type="text" name="preguntas[]" id="preguntas" class='input' style="width:200px;"/></p>
<?php } ?>


<p><a href="#" class="add" rel=".clone">Agregar Más</a></p>
       <input type="hidden" name="accion" value="guardarPreguntas"/>
       <input type="hidden" name="controlador" value="eventos"/>
       <input type="hidden" name="action" value="wpaction_guardar_preguntas"/>
       <input type="hidden" name="idEvento" id="idEvento" value="<?php echo $id; ?>">
       <div id="frmAviso"></div>
       <input type="button" class="pure-button"  value="Guardar Preguntas" id="btnGuardarPreguntas">
       <input type="button" class="pure-button"  value="Terminar" id="btnCancelarEvento">
       <a href="?page=agregar_eventos&id=<?php echo $id;?>&answers=1"><div class="btn-respuestas">Agregar Respuestas</div></a>
</fieldset>
</form>