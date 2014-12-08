<?php  
include("header.php"); //incluye el header se encuentra dentro del directorio mvc/vista
global $PATH_DESTACADA;
global $PATH_THUMBNAIL;


$id = (empty($_GET['id'])) ? '' : $_GET['id'];
$questions = (empty($_GET['questions'])) ? '' : $_GET['questions'];
$payments = (empty($_GET['payments'])) ? '' : $_GET['payments'];
$answers = (empty($_GET['answers'])) ? '' : $_GET['answers'];


?>

<script src="<?php echo $templatepath; ?>ckeditor/ckeditor.js"></script>  
<script type="text/javascript" src="<?php echo $templatepath; ?>js/spark.validator.js"></script>
<script type="text/javascript" src="<?php echo $templatepath; ?>js/eventos.js"></script>
<script type="text/javascript" src="<?php echo $templatepath; ?>js/scriptEventos.js"></script>
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
    <h2>Eventos</h2>
    <!---busqueda de eventos-->
    <table >
      <tr>
        <td><h4>Busqueda:</h4></td>
        <td><input type="text" name="buscar_evento" id="buscar_evento" /></td>
        <td></td>
          </td>
        <td><div id="cargando_busqueda"><img src="<?php echo get_bloginfo("url")."/wp-content/plugins/gestion-identidad-atleta/images/loading.gif"; ?>" width="30" height="30" /></div></td>
      </tr>
    </table>


<!--seccion dinamica -->
  <?php 
      
      if(!empty($questions)){
          include($_SERVER['DOCUMENT_ROOT'] . "identidadatleta/v1/wp-content/plugins/gestion-identidad-atleta/inc/questions.php");
      }	
	  
	  if(!empty($answers)){
		  include($_SERVER['DOCUMENT_ROOT'] . "identidadatleta/v1/wp-content/plugins/gestion-identidad-atleta/inc/answers.php");
	  }
  ?>
  
<!-- seccion dinamica -->



    <?php 
    /*
    *Activar busqueda si se detecta un ID diferente a vacio.
    */
    

    if($id<=0){      
    ?>
    <h3 class="titulo-main">Lista de Eventos</h3>
    <div id="frmBusqueda">
      <table class="lista"  width="100%">
        <tr>
          <th>Nombre  (<a href='#' onClick="busqueda_usuario_orden('','asc');">asc</a>/<a href='#' onClick="busqueda_evento_orden('','desc');">desc</a>)</th>
          <th>Fecha</th>
          <th>Preguntas</th>
          <th>Inscritos</th>
          <th>Formas de Pago</th>
          <th>Modificar</th>
          <th>Eliminar</th>
        </tr>
        <?php
      /*Genera los resultados de la busqueda*/
      ?>
        <?php
  /*
  busqueda de empresas,solicita id user actual para activar permisos.
  regresa un array de items
  */  
  global $TAMANO_PAGINA;  
  $inicio = $_GET["pagina"]; //indicador de cursor 
  if($inicio=="") $inicio = 0;  
  $items = busquedaEventos($idusersicisa,$buscar,$inicio,$TAMANO_PAGINA,$whereconsulta);
  $contador=0; //para el id de jquery

  foreach($items as $item)
  {
  ?>
        <?php
  $contador++;
  /*estilo css dinamico*/

?>
        <tr>
          <td class="izquierda"><?php echo $item->nombre_evento; ?></td>
          <td><?php echo fechaMexico($item->fecha);?></td>
          <td><a href="?page=agregar_eventos&id=<?php echo $item->id_evento;?>&questions=1"><img src="<?php echo $templatepath; ?>/images/pregunta.png"> Gestionar</a></td>
          <td><a href="?page=agregar_eventos&accion=datos_inscripcion&id=<?php echo $item->id_evento;?>&inscripcions=1"><img src="<?php echo $templatepath; ?>/images/inscritos.png"> Consultar</a></td>   
          <td><a href="?page=agregar_eventos&id=<?php echo $item->id_evento;?>&payments=1"><img src="<?php echo $templatepath; ?>/images/pago.png"> Gestionar</a></td>  
          
          <td><a href="?page=agregar_eventos&id=<?php echo $item->id_evento;?>"><img src="<?php echo $templatepath; ?>/images/modificar.png" /> Modificar</a></td>
          <td><a href="?page=agregar_eventos&controlador=eventos&accion=eliminarEvento&ideliminar=<?php echo $item->id_evento;?>" class="ask"><img src="<?php echo $templatepath; ?>/images/borrar.png" /> Eliminar</a></td>
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
        <!-- paginacion -->
      </table>
    </div>


    <?php
} //if id

if(!empty($payments)){
	
	$consulta_pago = consulta_pagos($id);
	$i=1;
?>	
<form id="form-pay" class="pure-form pure-form-stacked" method="post">
	<fieldset>
    	
        <legend class="nuevo-evento-titulo">Formas de Pago</legend>	
        <h3>Selecciona las formas de pago para el evento: <?php echo $items->nombre_evento; ?> </h3>
        <?php 

		foreach($consulta_pago as $consulta_pago){ //recorre formas de pago existentes
		
		  $formaPago = $consulta_pago->indicador_pago;
		  //1 = t.c. , 2 = t.d. , 3 = paypal
		  switch($formaPago){
		  case 1:		 
			  $checkedTC = "checked";
		      break;
		  case 2:
			  $checkedTD = "checked";
		      break;
		  case 3:
			  $checkedPaypal = "checked";
			  break;
		  }//switch
		  
		  
		}//foreach
		?>
        <input type="checkbox" value="1" name="option-pay[]" <?php echo $checkedTC;  ?> > &nbsp;&nbsp; Tarjeta de credito<br>
        <input type="checkbox" value="2" name="option-pay[]" <?php echo $checkedTD;  ?> > &nbsp;&nbsp; Tarjeta de debito<br>
        <input type="checkbox" value="3" name="option-pay[]" <?php echo $checkedPaypal;  ?> > &nbsp;&nbsp; Pago por PayPal
        
        <br><br><br>
        
        <input type="hidden" name="controlador" value="eventos"/>
        <input type="hidden" name="id_evento" value="<?php echo $id; ?>">
        <?php 
		if(!empty ($consulta_pago)){ ?>
        <input type="submit" id="modify-pay" name="modify-pay" value="Modificar" class="pure-button">		   
        <input type="hidden" name="accion" value="modifyPay"/>
		<?php 
		}else{    
		?>
        <input type="submit" id="save-pay" name="save-pay" value="Guardar" class="pure-button">	
        <input type="hidden" name="accion" value="savePay"/>
		<?php } ?>
<br>
<br>    

    </fieldset>       
</form>
<?php    
}


/**
* Modificacion obtener registros
**/
  if($id>0  && empty($questions) && empty($payments) && empty($answers)){   

   $items = traeEvento($id);

    foreach($items as $item)
    {

      $txtidevento = $item->id_evento;
      $txtid_requerimiento = $item->id_requerimiento;
      $txtnombreevento = $item->nombre_evento;
      $txtdescripcion = $item->descripcion;
      $txtfecha = $item->fecha;
      $txtruta = $item->ruta;
      
      
      $txtconvocatoria = $item->convocatoria;
      $txttipoevento = $item->tipo_evento; 
      $txtidorganizador = $item->id_organizador; 
      $txtidpost = $item->id_post; 
      $txtidstatus = $item->status; 
      $txtimgthumb = $item->img_thumb; 
      $txtimgdestacada = $item->img_destacada;

       
    }
    //print_r($items)>

  ?>
  <div id="frmBusqueda"></div>
  </div>
    <!--- MODIFICAR --> 
    <!--busqueda de eventos::eof-->
    <div style="width:820px;">
      <form id="frmUpdateEvento" class="pure-form pure-form-stacked" >
        <fieldset>
          <legend class="nuevo-evento-titulo">Modificar Evento</legend>
          <label for="tipo">Tipo del Evento: </label>
          <select id="tipo" name="tipo" style="height:30px;">
            <option value="">Selecciona una opción</option>
            <?php 

        $items = tipoEvento(); //trae el tipo de evento 

        
        foreach($items as $items){
                echo $txttipoevento . "tipo";
                if($items->id_tipoEvento == $txttipoevento){
                  $seleccionado = "selected='selected'"; 
                }else{
                  $seleccionado = "";
                }
                echo "<option $seleccionado value='".$items->id_tipoEvento."'>".$items->tipo."</option>";
        } ?>
          </select>
          <input type="hidden" value="<?php echo $txtidevento;?>" name="idevento" id="idevento">
          <label for="titulo">Titulo del Evento:</label>
          <input type="text" name="titulo"  id="titulo" class="input-titulo" value="<?php echo $txtnombreevento; ?>"/>
          <label for="descripcion">Descripción del Evento: </label>
          <input type="text" name="descripcion"  id="descripcion" class="input-descripcion"  value="<?php echo $txtdescripcion; ?>"/>
          <label for="descripcion">Fecha del Evento: </label>
          <input type="text" name="fecha"  id="fecha" class="input-normal"  value="<?php echo $txtfecha; ?>"/>
          <label for="descripcion">Imagen Destacada: </label>
          <img id="imgDestacadaSrc"  src="<?php echo $PATH_DESTACADA; ?><?php echo $txtimgdestacada; ?>">
          <input type='file' name='imagenDestacada' id='imagenDestacada'  class="input-normal"/>
          <input type="hidden" name="NombreImagenDestacada" id="NombreImagenDestacada"  value="<?php echo $txtimgdestacada; ?>"/>
          <input type="hidden" name="OldNombreImagenDestacada" id="OldNombreImagenDestacada"  value="<?php echo $txtimgdestacada; ?>"/>
          <div id="imgDestacada"></div>
          <input class="pure-button"  type='button' id='botonDestacada' onClick="actualizaDestacadaAjax('imagenDestacada','<?php echo $templatepath; ?>inc/')"  value="Actualizar Destacada"/>
          <label for="descripcion">Imagen Thumbnail: </label>
          <img id="imgThumbSrc" src="<?php echo $PATH_THUMBNAIL; ?><?php echo $txtimgthumb; ?>">
          <input type='file' name='imagenThumbnail' id='imagenThumbnail'  class="input-normal"/>
          <input type="hidden" name="NombreImagenThumbnail" id="NombreImagenThumbnail"   value="<?php echo $txtimgthumb; ?>"/>
          <input type="hidden" name="OldNombreImagenThumbnail" id="OldNombreImagenDestacada"  value="<?php  echo $txtimgthumb; ?>"/>
          <div id="imgThumbnail"></div>
          <input class="pure-button"  type='button' id='botonThumbnail' onClick="actualizaThumbnailAjax('imagenThumbnail','<?php echo $templatepath; ?>inc/')" value="Actualizar Thumbnail"/>
          <label for="editor1">Convocatoria del Evento: </label>
          <input onClick="createEditor();" class="pure-button"  type="button" value="Crear Convocatoria">
          <input onClick="removeEditor();" class="pure-button"  type="button" value="Borrar Convocatoria">
          <textarea name="enriquecido" id="enriquecido"  style="display:none;">
           
          </textarea>
          <div id="editor"> </div>
          <div id="contents" style="display: none">
            <div id="editorcontents"> </div>
          </div>



            <div id="frmAvisoError"></div>
            <input type="hidden" name="idEvento" value="<?php echo $id;?>">
          <input type="hidden" name="accion" value="actualiza_eventos"/>
          <input type="hidden" name="controlador" value="eventos"/>
          <input type="hidden" name="action" value="wpaction_actualiza_eventos"/>
          </fieldset>
          <input type="button" class="pure-button"  value="Actualizar Convocatoria" id="btnActualizaEvento">
                  <input type="button" class="pure-button"  value="Cancelar" id="btnCancelarEvento">
    
      </form>
    </div>
   
    <!--- MODIFICAR -->
    <textarea style="display:none;" id="contenidohtml">
      <?php echo $txtconvocatoria; ?>
    </textarea>
     <script>
     
    //Iniciar el 
    var config = {
        startupMode:'source'
      };
    editor = CKEDITOR.appendTo( 'editor', config, html );
    CKEDITOR.instances.editor1.setData($("#contenidohtml").val());

      

    </script>

    <?php
  }else{

   ?>
  
    <div id="frmBusqueda"></div>
  </div>
  <?php 
  if(empty($questions) && empty($payments) && empty($answers)){
  ?>
  <!--- AGREGAR --> 
  <!--busqueda de eventos::eof-->
  <div style="width:820px;">
    <form id="frmAddEvento" class="pure-form pure-form-stacked" >
      <fieldset>
        <legend class="nuevo-evento-titulo">Nuevo Evento</legend>
	<table>
        <tr>
        <td><label for="tipo">Tipo del Evento: </label></td>
        <td><select id="tipo" name="tipo" style="height:30px;">
          <option value="">Selecciona una opción</option>
          <?php 
        $items = tipoEvento(); //trae el tipo de evento
          foreach($items as $items){
                echo "<option value='".$items->id_tipoEvento."'>".$items->tipo."</option>";
        } ?>
        </select></td>
        </tr>
        <tr>
        <td><label for="titulo">Titulo del Evento:</label></td>
        <td><input type="text" name="titulo"  id="titulo" class="input-titulo"/></td>
        </tr>
        <tr>
        <td><label for="descripcion">Descripción del Evento: </label></td>
        <td><input type="text" name="descripcion"  id="descripcion" class="input-descripcion"/></td>
        </tr>
        <tr>
        <td><label for="descripcion">Fecha del Evento: </label></td>
        <td><input type="text" name="fecha"  id="fecha" class="input-normal"/></td>
        </tr>
        <tr>
        <td><label for="descripcion">Imagen Destacada: </label></td>
        <td><input type='file' name='imagenDestacada' id='imagenDestacada'  class="input-normal"/>
        <input type="hidden" name="NombreImagenDestacada" id="NombreImagenDestacada"  value=""/>
        <div id="imgDestacada"></div>
        <input class="pure-button"  type='button' id='botonDestacada' onClick="uploadDestacadaAjax('imagenDestacada','<?php echo $templatepath; ?>inc/')"  value="Subir Destacada"/></td>
        </tr>
        <tr>
        	<td colspan="2">&nbsp;</td>
        </tr>
        <tr>
        <td><label for="descripcion">Imagen Thumbnail: </label></td>
        <td><input type='file' name='imagenThumbnail' id='imagenThumbnail'  class="input-normal"/>
        <input type="hidden" name="NombreImagenThumbnail" id="NombreImagenThumbnail"  value=""/>
        <div id="imgThumbnail"></div>
        <input class="pure-button"  type='button' id='botonThumbnail' onClick="uploadThumbnailAjax('imagenThumbnail','<?php echo $templatepath; ?>inc/')" value="Subir Thumbnail"/></td>
        </tr>
        <tr>
        	<td colspan="2">&nbsp;</td>
        </tr>
        <tr>
        <td><label for="editor1">Convocatoria del Evento: </label></td>
        <td><input onClick="createEditor();" class="pure-button"  type="button" value="Crear Convocatoria">
        <input onClick="removeEditor();" class="pure-button"  type="button" value="Borrar Convocatoria">
        <textarea name="enriquecido" id="enriquecido"  style="display:none;"></textarea>
        <div id="editor"> </div></td>
        </tr>
        <tr>
        	<td colspan="2">&nbsp;</td>
        </tr>
        <div id="contents" style="display: none">
          <div id="editorcontents"> </div>
        </div>
       </table>
       
          <div id="frmAvisoError"></div>
  <input type="hidden" name="accion" value="registra_eventos"/>
            <input type="hidden" name="controlador" value="eventos"/>
            <input type="hidden" name="action" value="registra_eventos"/>
        </fieldset>
        <input type="button" class="pure-button"  value="Guardar Evento" id="btnEnviarEvento">
        <input type="button" class="pure-button"  value="Cancelar" id="btnCancelarEvento">
     
    </form>
  </div>
  <!--- AGREGAR -->
  <?php } 
} //questions?>
  <div class="clearing"></div>
  <div><!--frm-principal-eventos-->
    <div class="clearing"></div>
  </div>
  <!--main-content-plugin--> 
  
</div>
<!--wpbody-content--> 

<script type="text/javascript" src="<?php echo $templatepath; ?>js/vistaAddEventos.js"></script>