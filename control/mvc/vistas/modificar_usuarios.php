<?php
ini_set("display_errors",0);
include("header.php"); //incluye el header se encuentra dentro del directorio mvc/vista
global $PATH_DESTACADA;
global $PATH_THUMBNAIL;

$id_usuario_mod = $_GET['modificar_id'];
?>
<script type="text/javascript" src="<?php echo $templatepath; ?>js/spark.validator.js"></script>
<script type="text/javascript" src="<?php echo $templatepath; ?>js/modifica_usuario.js"></script>
<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.3.0/pure-min.css">
<div class="content">
	
    <?php //consulta para jalar datos de tbl usuarios y perfil
	 
	if(!empty ($id_usuario_mod)){
	$datos_usuario = datosUsuario($id_usuario_mod);
		foreach($datos_usuario as $datos_usuario){
			$txtNombre = $datos_usuario->nombre; 
			$txtPaterno = $datos_usuario->apellido_paterno;
			$txtMaterno = $datos_usuario->apellido_materno;
			$txtFechaNac = $datos_usuario->fecha_nacimiento;
			$txtPaisNac = $datos_usuario->pais_nacimiento;
			$dataEstado = $datos_usuario->id_estado;
			$txtDireccion = $datos_usuario->direccion;
			$txtColonia = $datos_usuario->colonia;
			$txtDelegacion = $datos_usuario->delegacion_municipio;
			$txtCp = $datos_usuario->cp;
			$txtSexo = $datos_usuario->sexo;
			$txtEmail = $datos_usuario->email;
			$txtTelefono = $datos_usuario->telefono_contacto;
			$txtId_user = $datos_usuario->idUser;
			$id_Usuario = $datos_usuario->id_usuario;
		}

		//se explotea la fecha 
		$fechaNacimiento = explode("-", $txtFechaNac);
		$diaFecha = $fechaNacimiento[0];
		$mesFecha = $fechaNacimiento[1];
		$anioFecha = $fechaNacimiento[2];
		
	//consulta los datos de la tabla perfil 		
     $datos_Perfil_Us = consultaPerfilMod($id_usuario_mod);
		foreach($datos_Perfil_Us as $datosPerfil){
			$tallaPlayera = $datosPerfil->id_talla_playera; 
			$carreraPreferida = $datosPerfil->id_carrera_preferida;
			$entrenamientoPer = $datosPerfil->id_entrenamiento;
			$marcaTennis = $datosPerfil->id_marca_tennis;
			$marcaBici = $datosPerfil->id_marca_bicicleta;
			$marcaRopaPer = $datosPerfil->id_marca_ropa;
			$medioPer = $datosPerfil->id_medio;	
		}
	
	?>
    
	        <h2>Usuarios</h2>
    

	<form id="formulario-perfil">
    <fieldset class="modificar-perfil">
    	<legend class="nuevo-evento-titulo">Modificar Uauario</legend>
	<div class="col-left">
		<table>
        <tr>
        <td><label>Nombre (s):</label></td>
        <td><input type="text" name="nombre" id="nombre" class="txt-campo bg-name" value="<?php echo $txtNombre; ?>"/>
        <div id="AvisoNombre"></div></td>
        </tr>
		<tr>	
        <td><label>Apellido Paterno</label></td>
        <td><input type="text" name="apaterno" id="apaterno" class="txt-campo bg-name" value="<?php echo $txtPaterno; ?>" /></td>
        </tr>
        <tr>
        <td><label>Apellido Materno:</label></td>
        <td><input type="text" name="amaterno" id="amaterno" class="txt-campo bg-name" value="<?php echo $txtMaterno; ?>"/></td>
        </tr>
        <tr>
        <td><label>Fecha de Nacimiento</label></td>
        <td><select id="dia" name="dia" class="dia-fecha">
             <option value=""> Dia </option>
                <?php
		  for($i=1;$i<=31;$i++){   
		  ?>
              <option value="<?php echo $i; ?>" <?php if($diaFecha==$i){echo "selected='selected'";}?>> <?php echo $i; ?> </option>
              <?php
		  }
		  ?>
         </select>
                        
         <select id="mes" name="mes" class="mes-fecha">
         	<option value="">Mes</option>
            <option value="01" <?php if($mesFecha=="01"){echo "selected='selected'";}?>>ENERO</option>
            <option value="02" <?php if($mesFecha=="02"){echo "selected='selected'";}?>>FEBRERO</option>
            <option value="03" <?php if($mesFecha=="03"){echo "selected='selected'";}?>>MARZO</option>
            <option value="04" <?php if($mesFecha=="04"){echo "selected='selected'";}?>>ABRIL</option>
            <option value="05" <?php if($mesFecha=="05"){echo "selected='selected'";}?>>MAYO</option>
            <option value="06" <?php if($mesFecha=="06"){echo "selected='selected'";}?>>JUNIO</option>
            <option value="07" <?php if($mesFecha=="07"){echo "selected='selected'";}?>>JULIO</option>
            <option value="08" <?php if($mesFecha=="08"){echo "selected='selected'";}?>>AGOSTO</option>
            <option value="09" <?php if($mesFecha=="09"){echo "selected='selected'";}?>>SEPTIEMBRE</option>
            <option value="10" <?php if($mesFecha=="10"){echo "selected='selected'";}?>>OCTUBRE</option>
            <option value="11" <?php if($mesFecha=="11"){echo "selected='selected'";}?>>NOVIEMBRE</option>
            <option value="12" <?php if($mesFecha=="12"){echo "selected='selected'";}?>>DICIEMBRE</option>
        </select>
                        
            
		<select name="anio" id="anio" class="anio-fecha">
        	<option value=""> Año </option>
    		<?php
     		for($anio=(date("Y")); 1940<=$anio; $anio--) {								?>
            	<option value="<?php echo $anio; ?>" <?php if($anioFecha==$anio){echo "selected='selected'";}?>><?php echo $anio ;?></option>
<?php } ?>              
		</select></td>
        </tr>
        <tr>                
		<td><label>Pais de Nacimiento:</label></td>
		<td><input type="text" name="paisNacimiento" id="paisNacimiento" class="txt-campo bg-name" value="<?php echo $txtPaisNac ?>"/></td>
        </tr>
        <tr>   
		<td><label>Correo Electrónico:</label></td>
		<td><input type="text" name="email" id="email" class="txt-campo bg-name" readonly value="<?php echo $txtEmail; ?>"/></td>
        </tr>
        <tr>
        <td><label>Telefono de Contacto:</label></td>
		<td><input type="text" name="telefono" id="telefono" class="txt-campo bg-name" value="<?php echo $txtTelefono ?>"/></td>
        </tr>
        <tr>
		<td><label>Sexo:</label></td>
		<div class="sexo">
		<td><input type="radio" name="sexo"  class="txt-campo bg-name" 
			value="masculino"<?php if($txtSexo=="masculino"){echo "checked='checked'";}?>/>Masculino
			<input type="radio" name="sexo"  class="txt-campo bg-name" 
			value="femenino" <?php if($txtSexo=="femenino"){echo "checked='checked'";}?>/>Femenino<br />
        </td>
		</div>
        </tr>               
        <tr>
        	<td><label>Calle y Numero:</label></td>
            <td><input type="text" name="calle" id="calle" class="txt-campo bg-name" value="<?php echo $txtDireccion ?>"/></td>
        </tr>
        <tr>          
		<td><label>Estado:</label></td>
		<td><select name="estado" id="estado">
            <option value="">Selecciona una opción </option>
        <?php
        $nombre_estado=nombreEstado();
		foreach($nombre_estado as $nombre_estado){
			$idEstado=$nombre_estado->id_estado;
			$nombreEstado=$nombre_estado->nombre_estado;
		?>
			<option value="<?php echo $idEstado; ?>" <?php if($idEstado==$dataEstado){ echo "selected='selected'"; } ?>><?php echo $nombreEstado; ?></option>
		  <?php } ?>
            </select></td>
            </tr>
			<tr>
            <td><label>Colonia:</label></td>
			<td><input type="text" name="colonia" id="colonia" class="txt-campo bg-name" value="<?php echo $txtColonia; ?>"/></td>
            </tr>
            <tr>      
			<td><label>Delegación / Municipio:</label></td>
            <td><input type="text" name="municipio" id="municipio" class="txt-campo bg-name" value="<?php echo $txtDelegacion; ?>"/></td>		
            </tr>
            <tr>
			<td><label>Código Postal:</label></td>
            <td><input type="text" name="cp" id="cp" class="txt-campo bg-name" value="<?php echo $txtCp ?>"/></td>
            </tr>
            <tr>
			<td><label class="label-tabla">Talla de Playera:</label></td>
            <td><select name="playera" id="playera" class="select-tabla">
			<option value="">Selecciona una opción </option>
			<?php 
				$opcion_playera = consultaTallaPlayera(); 
				foreach($opcion_playera as $opcion_playera){
				$idPlayera=$opcion_playera->id_talla_playera;
				$talla=$opcion_playera->talla;
				echo $idPlayera;
				echo $talla;
			?>
			<option value="<?php echo $idPlayera; ?>" <?php if($idPlayera==$tallaPlayera){ echo "selected='selected'"; } ?>><?php echo $talla; ?></option>
			<? } ?>
			</select></td>
            </tr>                
            <tr>
			<td><label class="label-tabla">Medio por el cual prefieres recibir información:</label></td>
			<td><select name="medio" id="medio" class="select-tabla">
					<option value="">Selecciona una opción </option>
					<?php 
							 
					$opcion_medio = consultaMedio();
					foreach($opcion_medio as $opcion_medio){
					$idMedio=$opcion_medio->id_medio;
					$medio=ucfirst(strtolower($opcion_medio->medio));
					?>
					<option value="<?php echo $idMedio; ?>" <?php if($idMedio==$medioPer){ echo "selected='selected'"; } ?>><?php echo $medio; ?></option>
					<? } ?>                       
                    </select></td>
                    </tr>
			</table>
            </div> <!-- close col-left -->
            
            <div class="col-right">
            <table>
            
                    <tr>
                    <td><label class="label-tabla">Carrera(s) que prefieres:</label></td>
                    </tr>
						<?php   
                        $opcion_carrera = consultaCarrera();		 
						
						$i=0;
						foreach($opcion_carrera as $opcion_carrera){
						$idDeporte=$opcion_carrera->id_deporte;
						$deporte=ucfirst(strtolower($opcion_carrera->deporte));
						?>
					<tr>
                    <td><input type="checkbox" name="carrerafavoritas<?php echo $i; ?>" id="carrerafavoritas<?php echo $i; ?>"  value="<?php echo $idDeporte;?>" <?php if($idDeporte==$carreraPreferida){ echo "checked='checked'"; } ?> /><?php echo $deporte . "<br>";?>			  
					<?php	$i++; } ?></td>
                    </tr>
                    <tr>
                    	<td>&nbsp;</td>
                    </tr> 
                    <tr>
                    <td><label class="label-tabla">¿Cuantas veces por semana entrena?:</label></td>
					</tr>
					<?php   
					$opcion_entrenamientos = consultaEntrenamientos();
							
					foreach($opcion_entrenamientos as $opcion_entrenamientos){
					$idEntrenamiento=$opcion_entrenamientos->id_entrenamiento;
					$entrenamiento=ucfirst(strtolower($opcion_entrenamientos->entrenamiento));
					?>
                    <tr>
					<td><input type="radio" name="entrena" id="entrena" value="<?php echo $idEntrenamiento; ?>" <?php if($idEntrenamiento==$entrenamientoPer){echo "checked='checked'";}?>/> <?php echo $entrenamiento . "<br>"; ?>
					<?php } ?></td>
                    </tr>
                    <tr>
                    	<td>&nbsp;</td>
                    </tr>
                    <tr>
                    <td><label class="label-tabla">¿Cual es la marca de tenis que usas?:</label></td>
                    </tr>
                    <?php   
					$opcion_marcaTenis = consultaMarcaTenis();
					$i=0;
						foreach($opcion_marcaTenis as $opcion_marcaTenis){
						$idTenis=$opcion_marcaTenis->id_marca_tennis;
						$tenis=ucfirst(strtolower($opcion_marcaTenis->marca_tennis));
					?>
                    <tr>
					<td><input type="radio" name="tenis" id="tenis" value="<?php echo $idTenis;?>" <?php if($idTenis==$marcaTennis){echo "checked='checked'";}?> /><?php echo $tenis . "<br>";  ?>
					<?php $i++; } ?></td>
                    </tr>
                    <tr>
                    	<td>&nbsp;</td>
                    </tr>
                    <tr>
                    <td><label class="label-tabla">¿Cual es la marca de bicicleta que usas?:</label></td> 
                    </tr>
                    <?php   
					$opcion_marcaBici = consulta_MarcaBicicleta();
							
					foreach($opcion_marcaBici as $opcion_marcaBici){
					$idBicicleta=$opcion_marcaBici->id_marca_bicicleta;
					$bicicleta=ucfirst(strtolower($opcion_marcaBici->marca_bicicleta));								   
					?>
                    <tr>
					<td><input type="radio" name="bicicleta" id="bicicleta" value="<?php echo $idBicicleta;?>" <?php if($idBicicleta==$marcaBici){echo "checked='checked'";}?> /><?php echo $bicicleta . "<br>";?>
					<?php } ?> </td>
                    </tr>
                    <tr>
                    <tr>
                    	<td>&nbsp;</td>
                    </tr>
                    <td><label class="label-tabla">¿Cual es la marca de ropa de natación que usas?:</label></td>
                    </tr      
                    ><?php   
					$opcion_marcaRopa = consultaMarcaRopa();
							
					foreach($opcion_marcaRopa as $opcion_marcaRopa){
					$idMarcaRopa=$opcion_marcaRopa->id_marca_ropa;
					$marcaRopa=ucfirst(strtolower($opcion_marcaRopa->marca_ropa));
					?>
                    <tr>
                    <td><input type="radio" name="ropanatacion" id="ropanatacion" value="<?php echo $idMarcaRopa; ?>" <?php if($idMarcaRopa==$marcaRopaPer){echo "checked='checked'";}?> /><?php echo $marcaRopa; ?>
					<?php } ?></td>
                    </tr>
        </table>                 
        </div>    <!-- close col-right -->                  
        </fieldset>
        <div class="control">
        <input type="button" name="modificar_perfil" class="pure-button" id="modificar_perfil" value="Actualizar">
        <input type="hidden" name="id_user" id="id_user" value="<?php echo $txtId_user; ?>" >
        <input type="hidden" name="id_Usuario" id="id_Usuario" value="<?php echo $id_Usuario; ?>" >
        <input type="hidden" name="accion" value="actualizar_infoUsuario" >
        <input type="hidden" name="controlador" value="usuarios">
        <input type="hidden" name="action" value="wpaction_general"/>
    	</form>
        
    </div>
<?php } ?>