ruta =document.location.origin+"/identidadatleta/v1/";


var nodos=new Array();
var cont=0;

function AddRow()
{


var nodos=new Array();
var cont=0;



  theSel = document.getElementById("listaAsignado[]");  
  newText = document.getElementById("nombre_asignado").value; 
  newValue = newText;
    	
  if (theSel.length == 0) {
    var newOpt1 = new Option(newText, newValue);
    theSel.options[0] = newOpt1;
    theSel.selectedIndex = 0;
  } else if (theSel.selectedIndex != -1) {
    var selText = new Array();
    var selValues = new Array();
    var selIsSel = new Array();
    var newCount = -1;
    var newSelected = -1;
    var i;
    for(i=0; i<theSel.length; i++)
    {
      newCount++;
      if (newCount == theSel.selectedIndex) {
        selText[newCount] = newText;
        selValues[newCount] = newValue;
        selIsSel[newCount] = false;
        newCount++;
        newSelected = newCount;
      }
      selText[newCount] = theSel.options[i].text;
      selValues[newCount] = theSel.options[i].value;
      selIsSel[newCount] = theSel.options[i].selected;
    }
    for(i=0; i<=newCount; i++)
    {
      var newOpt = new Option(selText[i], selValues[i]);
      theSel.options[i] = newOpt;
      theSel.options[i].selected = selIsSel[i];
    }
  }
  

 cont++;
 //seleccionar todos
  for (var i=0; i<theSel.options.length; i++) {
  theSel.options[i].selected = true;
  }

}
function DelRow()
{	

  theSel = document.getElementById("listaAsignado[]");  

  var selIndex = theSel.selectedIndex;
  if (selIndex != -1) {
    for(i=theSel.length-1; i>=0; i--)
    {
      if(theSel.options[i].selected)
      {
        theSel.options[i] = null;
      }
    }
    if (theSel.length > 0) {
      theSel.selectedIndex = selIndex == 0 ? 0 : selIndex - 1;
    }
  }
  
  //seleccionar todos
    for (var i=0; i<theSel.options.length; i++) {
  theSel.options[i].selected = true;
  }
  
}


/* Busqueda de administradores por suggeest list */
 function lookup(inputString,suggestionbox,suggestionboxlist,url) { 
        if((inputString.length == 0) || (!isNaN(inputString))) { 
            // Hide the suggestion box. 
            $(suggestionbox).hide(); 
        } else {        //alert(inputString); 
            url_action = "admin-ajax.php";
		    $.post( url_action ,  { action:url,buscar:inputString} ,function(data){				
		          if(data.length >0) {         
                    $(suggestionbox).show(); 
                    $(suggestionboxlist).html(data); 					
                } 
 			});				
			$(suggestionbox).show();
        } 
    } // lookup 
     
    function fill(thisValue,thisValueHidden,fillboxlist,fillboxlistHidden,suggestionbox) {  
        $(fillboxlist).val(thisValue); 
		$(fillboxlistHidden).val(thisValueHidden); 
        setTimeout("$('"+suggestionbox+"').hide();", 200); 		
    } 
    function fillList(thisValue,thisValueHidden,fillboxlist,fillboxlistHidden,suggestionbox) {  
        $(fillboxlist).val(thisValue); 
        setTimeout("$('"+suggestionbox+"').hide();", 200); 		
    } 
	
	
	//Busquedaa por ajax  , y regresa un html!
	function busqueda_usuario(valor){
	   var jqxhr = $.post(ruta+"wp-admin/admin-ajax.php","action=caja_busca_usuarios&accion=buscaUsuarios&busqueda="+valor,   	   
	   function(data){ 
		          $("#frmBusqueda").html(data);	
	   });   
	}
	function busqueda_cliente_orden(valor,orden){
	   var jqxhr = $.post(ruta+"wp-admin/admin-ajax.php","action=caja_busca_evento&accion=buscaEventos&orden="+orden+"&busqueda="+valor,   	   
	   function(data){ 		
		          $("#frmBusqueda").html(data);	
	   });   
	}
	function paginacion(valor,pagina){
	   var jqxhr = $.post(ruta+"wp-admin/admin-ajax.php","action=caja_busca_evento&accion=buscaEventos&busqueda="+valor+"&paginacion="+pagina,   	   
	   function(data){ 		
		          $("#frmBusqueda").html(data);	
	   });   
	}
	

$(document).ready(function(){	

	$("#cargando_busqueda").fadeOut("slow");
	//triggers de busquedas

	$(document).ajaxStart(function() {
		console.log("okk");
	   $("#cargando_busqueda").fadeIn("slow");
	});
	$(document).ajaxStop(function() {
	   $("#cargando_busqueda").fadeOut("slow");
	});
	//Busqueda de administrador con jequeyy
	$("#buscar_usuario").keyup(function() {	
		busqueda_usuario($(this).val());		
	});

	

//script step form
   //$("#frmAddClientes").formToWizard();         
   

   function imgcorrect(selector){  	
	   $(selector).css('background-image', 'url(../wp-content/plugins/sistemasicisa/images/alertok.png)');
	   $(selector).css('background-repeat', 'no-repeat');
	   $(selector).css('background-position', '130px 6px');  
   }

   function imgfail(selector){
       $(selector).css('background-image', 'url(../wp-content/plugins/sistemasicisa/images/alertfail.png)');
	   $(selector).css('background-repeat', 'no-repeat');
 	   $(selector).css('background-position', '130px 6px');	
   }
   $("#btnRegistrarClientes").click(function(){			
		registraClientes_javascript();
   } );
   $("#btnModificarClientes").click(function(){			
		modificaClientes_javascript();
   } );

function registraClientes_javascript(){
	
	
	   var mensajeError="";
	   var error = 0;
	   /*Envia formulario */
	   var txtNombre = $("#nombre").val();
	   var txtApelidopaterno = $("#apellidopaterno").val();
	   var txtApellidomaterno = $("#apellidomaterno").val();
	   var txtEmail = $("#email").val(); 
	   var txtEmailto = $("#emailto").val(); 
	   var txtTelefonoprimario =  $("#casa").val(); 
	   var txtTelefonosecundario=  $("#oficina").val(); 
	   var txtIdUserSicisa =  $("#idusersicisa").val(); 


   					/**VALIDA INFORMACION **/	
					if(!validaCorreo(txtEmail)){							
						imgfail("#email");
						error = 1;
					}	else{		
						imgcorrect("#email");		
					}

					if(!validaCorreo(txtEmailto)){							
						imgfail("#emailto");
						error = 1;
					}	else{		
						imgcorrect("#emailto");		
					}
					if(!validaLongitud(txtNombre, 0, 1, 255)){
						imgfail("#nombre");
						error = 1;
					}else{
						imgcorrect("#nombre");		
					}
					if(txtEmailto!=txtEmail){	
					    imgfail("#email");						
						imgfail("#emailto");
						error = 1;
					}	else{
					    imgcorrect("#email");		
						imgcorrect("#emailto");		
					
                     }
					
					

					
	//Si no hay error en la validacion de datos, enviamos los datos via correo 
	if(error==0){

	//Mostrar espere.
	   $("#frmAviso").html("Un momento...");
	   $("#frmAviso").show("slow");
	   
	   var jqxhr = $.post(ruta+"wp-admin/admin-ajax.php?page=clientes",$("#frmAddClientes").serialize(),   
	   
	   function(data){    	   
			//empresa agregada con exito
		if(data.msg=="1"){	
		          $("#frmAddClientes").hide("slow");
		          $("#frmAviso").html("El cliente se agrego con éxito!");
	   			  $("#frmAviso").show("slow");			   
			}
			//error en registro
			if(data.msg=="0"){
				//No se encontro socio aguila			      
		          $("#frmAviso").html("Error en el registro de la base de datos.");
	   			  $("#frmAviso").show("slow");					   			  			   
			}
			
	
	   },"json");   

	}else{			
				
		$("#frmAviso").html('*Por favor revisa los campos!'); 		 					  		 

     }
	 
}

function modificaClientes_javascript(){
	
	   var mensajeError="";
	   var error = 0;
	   /*Envia formulario */
	   var txtNombre = $("#nombre").val();
	   var txtApelidopaterno = $("#apellidopaterno").val();
	   var txtApellidomaterno = $("#apellidomaterno").val();
	   var txtEmail = $("#email").val(); 
	   var txtEmailto = $("#emailto").val(); 
	   var txtTelefonoprimario =  $("#casa").val(); 
	   var txtTelefonosecundario=  $("#oficina").val(); 
	   var txtIdUserSicisa =  $("#idusersicisa").val(); 


   					/**VALIDA INFORMACION **/	
					if(!validaCorreo(txtEmail)){							
						imgfail("#email");
						error = 1;
					}	else{		
						imgcorrect("#email");		
					}

					if(!validaCorreo(txtEmailto)){							
						imgfail("#emailto");
						error = 1;
					}	else{		
						imgcorrect("#emailto");		
					}
					if(!validaLongitud(txtNombre, 0, 1, 255)){
						imgfail("#nombre");
						error = 1;
					}else{
						imgcorrect("#nombre");		
					}
					if(txtEmailto!=txtEmail){	
					    imgfail("#email");						
						imgfail("#emailto");
						error = 1;
					}	else{
					    imgcorrect("#email");		
						imgcorrect("#emailto");		
					
                     }
					
					

					
	//Si no hay error en la validacion de datos, enviamos los datos via correo 
	if(error==0){

	//Mostrar espere.
	   $("#frmAviso").html("Un momento...");
	   $("#frmAviso").show("slow");
	   
	   var jqxhr = $.post(ruta+"wp-admin/admin-ajax.php?page=clientes",$("#frmAddClientes").serialize(),   
	   
	   function(data){    	   
			//cliente  modificadi con exito
		if(data.msg=="1"){	
		          $("#frmAddClientes").hide("slow");
		          $("#frmAviso").html("El cliente se modifico con éxito!");
	   			  $("#frmAviso").show("slow");			   
			}
			//error en registro
			if(data.msg=="0"){
				//No se encontro socio aguila			      
		          $("#frmAviso").html("Error en el registro de la base de datos.");
	   			  $("#frmAviso").show("slow");					   			  			   
			}
		
	
	   },"json");   

	}else{			
				
		$("#frmAviso").html('*Por favor revisa los campos!'); 		 					  		 

     }
	 
}

	
		
});
