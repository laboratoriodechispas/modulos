<?php

/*

 * Modelo que crea los objetos de equipos, en este archivo solo se puede dar de alta (insert) y modificar (update) la tabla de equipos (tbl_equipos) 

 */

ini_set('display_errors',1);

  class Usuario

  {

  	
     
	protected $_idUsuario_fmr;

	protected $_nombre_frm;

	protected $_aPaterno_frm;		
	
	protected $_aMaterno_frm;
	
	protected $_fechaNacimiento_frm;
	
	protected $_paisNacimiento_frm;
	
	protected $_telefono_frm;
	
	protected $_sexo_frm;
	
	protected $_calle_frm;
	
	protected $_estado_frm;
	
	protected $_colonia_frm;
	
	protected $_delegacion_frm;
	
	protected $_cp_frm;
	
	protected $_tallaPlayera_frm;
	
	protected $_medio_frm;

	protected $_entrenamiento;
	
	protected $_marcaTenis_frm;
	
	protected $_marcaBici_frm;
	
	protected $_marcaRopa_frm;
	

	/***PROPIEDADES****/

	

	public function set_id_usuario($idUsuario_fmr)
    {
		$this->_idUsuario_fmr =$idUsuario_fmr;
    }

	public function get_id_usuario()
	{
		return $this->_idUsuario_fmr;
	}

	public function set_nombre($nombre_frm)
    {
		$this->_nombre_frm =$nombre_frm;
    }

	public function get_nombre()
	{
		return $this->_nombre_frm;
	}

	public function set_aPaterno($aPaterno_frm)
    {
		$this->_aPaterno_frm =$aPaterno_frm;
    }

	public function get_aPaterno()
	{
		return $this->_aPaterno_frm;
	}

	public function set_aMaterno($aMaterno_frm)
    {
		$this->_aMaterno_frm =$aMaterno_frm;
    }

	public function get_aMaterno()
	{
		return $this->_aMaterno_frm;
	}

	public function set_fecha_nacimiento($fechaNacimiento_frm)
    {
		$this->_fechaNacimiento_frm =$fechaNacimiento_frm;
    }

	public function get_fecha_nacimiento()
	{
		return $this->_fechaNacimiento_frm;
	}

	public function set_pais($paisNacimiento_frm)
    {
		$this->_paisNacimiento_frm =$paisNacimiento_frm;
    }

	public function get_pais()
	{
		return $this->_paisNacimiento_frm;
	}

	public function set_telefono($telefono_frm)
    {
		$this->_telefono_frm =$telefono_frm;
    }

	public function get_telefono()
	{
		return $this->_telefono_frm;
	}

	public function set_sexo($sexo_frm)
    {
		$this->_sexo_frm =$sexo_frm;
    }

	public function get_sexo()
	{
		return $this->_sexo_frm;
	}

	public function set_calle($calle_frm)
    {
		$this->_calle_frm =$calle_frm;
    }

	public function get_calle()
	{
		return $this->_calle_frm;
	}

	public function set_estado($estado_frm)
    {
		$this->_estado_frm =$estado_frm;
    }

	public function get_estado()
	{
		return $this->_estado_frm;
	}

	public function set_colonia($colonia_frm)
    {
		$this->_colonia_frm =$colonia_frm;
    }

	public function get_colonia()
	{
		return $this->_colonia_frm;
	}

	public function set_delegacion($delegacion_frm)
    {
		$this->_delegacion_frm =$delegacion_frm;
    }

	public function get_delegacion()
	{
		return $this->_delegacion_frm;
	}

	public function set_cp($cp_frm)
    {
		$this->_cp_frm =$cp_frm;
    }

	public function get_cp()
	{
		return $this->_cp_frm;
	}

	public function set_talla_playera($parametro)
    {
		$this->_tallaPlayera_frm =$parametro;
    }

	public function get_talla_playera()
	{
		return $this->_tallaPlayera_frm;
	}

	public function set_medio($parametro)
    {
		$this->_medio_frm =$parametro;
    }

	public function get_medio()
	{
		return $this->_medio_frm;
	}

	public function set_entrenamiento($parametro)
    {
		$this->_entrenamiento =$parametro;
    }

	public function get_entrenamiento()
	{
		return $this->_entrenamiento;
	}

	public function set_marca_tenis($parametro)
    {
		$this->_marcaTenis_frm =$parametro;
    }

	public function get_marca_tenis()
	{
		return $this->_marcaTenis_frm;
	}
	
	public function set_marca_bicicleta($parametro)
    {
		$this->_marcaBici_frm =$parametro;
    }

	public function get_marca_bicicleta()
	{
		return $this->_marcaBici_frm;
	}
	
	public function set_marca_ropa($parametro)
    {
		$this->_marcaRopa_frm =$parametro;
    }

	public function get_marca_ropa()
	{
		return $this->_marcaRopa_frm;
	}	



	public function __toString()
    {

        return "";

    }

	

    //Updates

	public function actualizaDatosUsuario(){
		
	$query = "UPDATE tbl_usuarios SET nombre='$this->_nombre_frm',apellido_paterno='$this->_aPaterno_frm',apellido_materno='$this->_aMaterno_frm',fecha_nacimiento='$this->_fechaNacimiento_frm',pais_nacimiento='$this->_paisNacimiento_frm',telefono_contacto='$this->_telefono_frm',sexo='$this->_sexo_frm',direccion='$this->_calle_frm',id_estado='$this->_estado_frm',colonia='$this->_colonia_frm',delegacion_municipio='$this->_delegacion_frm',cp='$this->_cp_frm' WHERE id_usuario='$this->_idUsuario_fmr'";	
	return ($query);
 	}
	
	
	//elimina usuario
		public function EliminaUsuario($IdEliminar)

    {		
	 $query = "UPDATE tbl_usuarios set status=0 WHERE id_usuario=$IdEliminar";
	return $query;	
    }
	
	//--INSERTS

	public function busquedaUsuarios($iduser,$buscar,$inicio,$TAMANO_PAGINA,$whereconsulta)
	{
		if($TAMANO_PAGINA==0)
		{
			//todos

			$query= "SELECT * FROM tbl_usuarios WHERE status=1";			
			return $query;
			break;
		}
		if($buscar != "")
		{
			$query= "SELECT * FROM tbl_usuarios WHERE nombre LIKE '%$buscar%' limit $inicio,$TAMANO_PAGINA";			
	    }else{
			$query= "SELECT * FROM tbl_usuarios WHERE status=1 $whereconsulta limit $inicio,$TAMANO_PAGINA"; 
	    } //if(buscar)		
		return $query;
	}
	
	public function busquedaPerfiles($consultar_perfil){		

		$query = "SELECT * FROM tbl_usuarios WHERE id_usuario=$consultar_perfil";	

    	 return $query;

	}
	
	public function datostblPerfil($consultar_perfil){		

		$query = "SELECT * FROM tbl_perfiles WHERE id_usuario=$consultar_perfil";	

    	 return $query;

	}
		
	public function datostblPerfilMod($id_usuario_mod){		

	$query = "SELECT * FROM tbl_perfiles WHERE id_usuario=$id_usuario_mod";	

    return $query;

	}
	
	public function opcionTallaPlayera(){
	
	$query = "SELECT * FROM tbl_tallas_playeras";
	
	return($query);
	
	}
	
	public function opcionMedio(){
	
	$query = "SELECT * FROM tbl_medios";
	
	return($query);
	
    }
	
	public function opcionCarrera(){

	$query = "SELECT * FROM tbl_deportes";
	
	return($query);
		
	}
	
	public function opcionEntrenamientos(){
		
	$query = "SELECT * FROM tbl_entrenamientos";
	
	return($query);
		
	}	
	
	public function opcionMarcaTenis(){
	
	$query = "SELECT * FROM tbl_marcas_tennis";
	
	return($query);
		
	}
	
	public function opcionMarcaBicicleta(){

	$query = "SELECT * FROM tbl_marcas_bicicletas";
	
	return($query);
		
	}
	
	public function opcionMarcaRopa(){

	$query = "SELECT * FROM tbl_marcas_ropas";
	
	return($query);
		   
	}		
		
	public function consultarDatos($id_usuario_mod){		

	$query = "SELECT * FROM tbl_usuarios WHERE id_usuario=$id_usuario_mod";	

    return $query;

	}
		
	public function datosNombreEstado(){		

	$query = "SELECT * FROM tbl_estados";	
	
    return $query; 

	}
	
	public function name_EstadoPerfil($dataEstado){
		
	$query = "SELECT * FROM tbl_estados WHERE id_estado=$dataEstado";	
	
    return $query; 

	}
	
	public function busquedausuario($idEvento){		

		$query = "SELECT * FROM tbl_usuario WHERE id_evento=$idEvento";	

    	 return $query;

	}


  }/**Fin de la clase Usuario*/

 ?>