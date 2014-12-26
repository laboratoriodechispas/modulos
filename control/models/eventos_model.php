<?php

/*

 * Modelo que crea los objetos de equipos, en este archivo solo se puede dar de alta (insert) y modificar (update) la tabla de equipos (tbl_equipos) 

 */

  class Eventos_model extends MY_Model

  {

	protected $_id_evento;

	protected $_id_requerimiento;

	protected $_nombre_evento;

	protected $_descripcion;

	protected $_fecha;

	protected $_ruta;

	protected $_img_thumb;

	protected $_img_destacada;

	protected $_convocatoria;

	protected $_tipo_evento;

	protected $_id_organizador;

	protected $_id_post;

	protected $_id_uduario;	
	
	protected $_tipo_pago;
	
	protected $_fecha_inscripcion;

	

	/***PROPIEDADES****/

	

	public function setId_evento($id_evento)

    {

		$this->_id_evento =$id_evento;

    }

	public function getId_evento()

	{

		return $this->_id_evento;

	}

	public function setId_requerimiento($id_requerimiento)

    {

		$this->_id_requerimiento =$id_requerimiento;

    }

	public function getId_requerimiento()

	{

		return $this->_id_requerimiento;

	}

	public function setNombre_evento($nombre_evento)

    {

		$this->_nombre_evento =$nombre_evento;

    }

	public function getNombre_evento()

	{

		return $this->_nombre_evento;

	}

	public function setDescripcion($descripcion)

    {

		$this->_descripcion =$descripcion;

    }

	public function getDescripcion()

	{

		return $this->_descripcion;

	}

	public function setFecha($fecha)

    {

		$this->_fecha =$fecha;

    }

	public function getFecha()

	{

		return $this->_fecha;

	}

	public function setRuta($ruta)

    {

		$this->_rutar =$ruta;

    }

	public function getRuta()

	{

		return $this->_ruta;

	}

	public function setImg_thumb($img_thumb)

    {

		$this->_img_thumb =$img_thumb;

    }

	public function getImg_thumb()

	{

		return $this->_img_thumb;

	}

	public function setImg_destacada($img_destacada)

    {

		$this->_img_destacada =$img_destacada;

    }

	public function getImg_destacada()

	{

		return $this->_img_destacada;

	}

	public function setConvocatoria($convocatoria)

    {

		$this->_convocatoria =$convocatoria;

    }

	public function getConvocatoria()

	{

		return $this->_convocatoria;

	}

	public function setTipo_evento($tipo_evento)

    {

		$this->_tipo_evento =$tipo_evento;

    }

	public function getTipo_evento()

	{

		return $this->_tipo_evento;

	}

	public function setId_organizador($id_organizador)

    {

		$this->_id_organizador =$id_organizador;

    }

	public function getId_organizador()

	{

		return $this->_id_organizador;

	}	

	public function setId_post($id_post)

    {

		$this->_id_post =$id_post;

    }

	public function getId_post()

	{

		return $this->_id_post;

	}	
	
	public function setId_usuario($id_uduario)

    {

		$this->_id_uduario =$id_uduario;

    }

	public function getId_usuario()

	{

		return $this->_id_uduario;

	}	
	

	public function set_tipo_pago($tipo_pago)

    {

		$this->_tipo_pago =$tipo_pago;

    }

	public function get_tipo_pago()

	{

		return $this->_tipo_pago;

	}	

		public function setFecha_inscripcion($fecha_inscripcion)

    {

		$this->_fecha_inscripcion =$fecha_inscripcion;

    }

	public function getFecha_inscripcion()

	{

		return $this->_fecha_inscripcion;

	}	

	public function set_Id_evento($idEvento)

    {

		$this->_id_evento =$idEvento;

    }

	public function get_Id_evento()

	{

		return $this->_id_evento;

	}


	public function __toString()

    {

        return "";

    }

	

    //Updates

	/*public function actualizaEvento()

    {		
	 $query = "UPDATE tbl_eventos set nombre_evento='$this->_nombre_evento',descripcion='$this->_descripcion',fecha='$this->_fecha',img_destacada='$this->_img_destacada',img_thumb='$this->_img_thumb',convocatoria='$this->_convocatoria',tipo_evento='$this->_tipo_evento' WHERE id_evento=$this->_id_evento";
	return $query;	
    }*/
	
	//elimina Evento
		/*public function eliminaEvento()

    {		
	 $query = "UPDATE tbl_eventos set status=0 WHERE id_evento=$this->_id_evento";
	return $query;	
    }*/
	
	


	//--INSERTS

	/*public function agregarEvento()

    {		

	 $query = "INSERT INTO tbl_eventos (nombre_evento,descripcion,fecha,img_destacada,img_thumb,convocatoria,tipo_evento,id_post,status) values ('$this->_nombre_evento','$this->_descripcion','$this->_fecha','$this->_img_destacada'

	 ,'$this->_img_thumb','$this->_convocatoria','$this->_tipo_evento','$this->_id_post',1)";
	 
	   
	 return $query;	
	
    }*/
	
	public function agregarInscripcion(){
		$query = "INSERT INTO tbl_inscripciones (id_usuario,id_evento,fecha_inscripcion,fuente_suscripcion,tipo_pago) values('$this->_id_uduario','$this->_id_evento','$this->_fecha_inscripcion',1,'$this->_tipo_pago')";
	
	return $query;
	
	}

	public function busquedaTipoEvento(){

		

		$query = "SELECT * FROM tbl_tipoEvento";

	

    	 return $query;

	}

	/*public function busquedaEventos($iduser,$buscar,$inicio,$TAMANO_PAGINA,$whereconsulta)
	{

		if($TAMANO_PAGINA==0)
		{
			//todos

			$query= "SELECT * FROM tbl_eventos WHERE status=1";			
			return $query;
			break;
		}
		if($buscar != "")
		{
			$query= "SELECT * FROM tbl_eventos WHERE nombre_evento LIKE '%$buscar%' ORDER BY  'id' limit $inicio,$TAMANO_PAGINA";

	    }elseif($inicio){
            $inicio *= 10;
			$query= "SELECT * FROM tbl_eventos WHERE status=1 $whereconsulta limit $inicio,$TAMANO_PAGINA";

	    }else{
            $query= "SELECT * FROM tbl_eventos WHERE status=1 $whereconsulta limit $inicio,$TAMANO_PAGINA";
        } //if(buscar)
		return $query;
	}*/
	
	public function busquedaEvento($idEvento){		

		$query = "SELECT * FROM tbl_eventos WHERE id_evento=$idEvento";	

    	 return $query;

	}

	//=> Obtener Nombre de Evento
	public function nombreEvento($idEvento){		

		$query = "SELECT nombre_evento FROM tbl_eventos WHERE id_evento=$idEvento";
    	return $query;

	}
	
	public function buscarInscritos($id_evento){
		$query = "SELECT * from tbl_inscripciones WHERE id_evento=$id_evento";
		return $query; 
	}
	
	public function nombre_usuario($id_usuario){
		$query = "SELECT nombre,apellido_paterno,apellido_materno FROM tbl_usuarios WHERE id_usuario = $id_usuario";
		return $query;
	}
	
	public function consultar_respuestas($idUser,$idEvento){
		$query = "SELECT * FROM tbl_respuestas WHERE id_usuario = $idUser AND id_evento = $idEvento";
		return $query;
	}
	
	
  }/**Fin de la clase Evento*/

 ?>