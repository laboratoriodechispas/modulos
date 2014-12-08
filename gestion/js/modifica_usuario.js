$(document).ready(function(){	

  ruta = document.location.origin+"/identidadatleta/v1/";
  
  
	 $("#modificar_perfil").click(function(){

	 	 $("#modificar_perfil").hide("slow");

	 	 $("#load").show("slow");

		  var error = 0; /*comienzo el error en cero */

		  /*Traigo los datos del formulario */	

		  var txtnombre=$("#nombre").val();		  

		  var txtapaterno=$("#apaterno").val();

		  var txtamaterno=$("#amaterno").val();
		  
		  var txtdia=$("#dia"). val();
		  
		  var txtmes=$("#mes"). val();
		  
		  var txtanio=$("#anio"). val();
		  
		  var txtpais=$("#paisNacimiento"). val();
					  
		  var txtmail=$("#email").val();
		  
		  var txtpass=$("#pass").val();
		  
		  var txtpass2=$("#pass2").val();
		  
		  var txttelefono=$("#telefono").val();
		  
		  var txtpass=$("#pass").val();

          var errorestxt = "";

		  var errorestxtnombre = ""; 		 

		  var errorestxtemail = "";	 

		  var errorestxtmensaje = "";
		

		    if(!validaLongitud(txtnombre, 0, 3, 255)){			
			error = 1;
			$('#nombre').css( "border", "2px solid red" );
			}else{
			$('#nombre').css( "border", "1px solid #01C601" );
			}
	
			if(!validaLongitud(txtapaterno, 0, 2, 255)){			
			error = 1;
			$('#apaterno').css( "border", "2px solid red" );
			}else{
			$('#apaterno').css( "border", "1px solid #01C601" );
			}

			if(!validaLongitud(txtamaterno, 0, 2, 255)){			
			error = 1;
			$('#amaterno').css( "border", "2px solid red" );
			}else{
			$('#amaterno').css( "border", "1px solid #01C601" );
			}
			
			if(!validaCorreo(txtmail)){			
			error = 1;
			$('#email').css( "border", "2px solid red" );
			}else{
			$('#email').css( "border", "1px solid #01C601" );
			}
			
			
		 if(error==0){	//Mostrar espere.

	   $("#frmAviso").html("Un momento...");

	   $("#frmAviso").show("slow");
           var consulta = $.post(ruta + "wp-admin/admin-ajax.php?page=agregar_eventos",$("#formulario-perfil").serialize(),    
	   function(data){    	   
	   
	   if(data.msg=="1"){	       
		          $("#frmRegistroFinal").hide("slow");
		          $("#frmAvisoExitoso").html("<center>Su solicitud ha sido enviada, revisa tu correo para terminar el proceso de solicitud.</center> ");
	   			  $("#frmAvisoExitoso").show("slow");				 		   
			}
			//error en registro
			if(data.msg=="2"){
				//hubo un error en la incersión  a la base de datos
				  $("#frmRegistroFinal").hide("slow"); 				 			  			      
		          $("#frmAviso").html("Algo no salio bien intentalo de nuevo.");
	   			  $("#frmAviso").show("slow");					   			  			   
			}  
			
		    },"json"); 

		 }else{	

		$("#load").hide("slow"); 

		$("#modificar_perfil").show("slow");

		$("#frmAviso").html('*Por favor revisa los campos ');

		$("#AvisoNombre").html(errorestxtnombre);		

		$("#AvisoMail").html(errorestxtemail);			

		$("#AvisoMensaje").html(errorestxtmensaje);

		 }

	 });/*Fin de la funcion click*/


}); /*fin de documen ready*/