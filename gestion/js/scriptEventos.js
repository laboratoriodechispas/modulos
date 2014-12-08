
		var editor, html = '';

		function createEditor() {
			if ( editor )
				return;

			// Create a new editor inside the <div id="editor">, setting its value to html
			var config = {
				startupMode:'source'
			};
			editor = CKEDITOR.appendTo( 'editor', config, html );
		}

		function removeEditor() {
			if ( !editor )
				return;

			// Retrieve the editor contents. In an Ajax application, this data would be
			// sent to the server or used in any other way.
			//document.getElementById( 'editorcontents' ).innerHTML = html = editor.getData();
			document.getElementById( 'contents' ).style.display = '';

			// Destroy the editor.
			editor.destroy();
			editor = null;
		}
		
		
		//calendario

$(function() { 
	$.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        weekHeader: 'Sm',
        dateFormat: 'yy-mm-dd',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
		   $.datepicker.setDefaults($.datepicker.regional["es"]);        
           $( "#fecha" ).datepicker(); 		     
        });


       //sube archivos 
	   
	   function uploadDestacadaAjax(id,ruta){		   
			
			
			document.getElementById('botonDestacada').style.visibility='hidden'; // hide
			  
			var inputFileImage = document.getElementById(id);			
			var file = inputFileImage.files[0];		

			var data = new FormData();			
			data.append('archivo',file);
			
			
			var url = ruta+"upload.php";
			
			$.ajax({
			
			url:url,
			
			type:'POST',
			
			contentType:false,
			
			data:data,
			
			dataType: "json",
			
			processData:false,
			
			cache:false,
						
			success    : function(dato) {
            //console.error(JSON.stringify(response));

            if(dato.msg!=""){            	
            	 $('#NombreImagenDestacada').val(dato.archivo);
            	 $('#imgDestacada').html("Imagén almacenada<strong>"+dato.archivo+"</strong>");
            	 document.getElementById('botonDestacada').style.visibility='visible'; // show
               }              
            },
            error      : function() {
            //console.error("error");
            document.getElementById('botonDestacada').style.visibility='visible'; // show
            alert(dato.msg);
                            
               }
		});
		
	}	
		 function uploadThumbnailAjax(id,ruta){
		   
			document.getElementById('botonThumbnail').style.visibility='hidden'; // hide
			
			var inputFileImage = document.getElementById(id);
			
			var file = inputFileImage.files[0];
			
			var data = new FormData();
			
			data.append('archivo',file);
			
			var url = ruta+"uploadThumbnail.php";
			
			$.ajax({
			
			url:url,
			
			type:'POST',
			
			contentType:false,
			
			data:data,
			dataType: "json",
			
			processData:false,
			
			cache:false,
						
			success    : function(dato) {
            //console.error(JSON.stringify(response));

            if(dato.msg!=""){            	
            	 $('#NombreImagenThumbnail').val(dato.archivo);
            	 $('#imgThumbnail').html("Imagén almacenada<strong>"+dato.archivo+"</strong>");
            	 document.getElementById('botonThumbnail').style.visibility='visible'; // show
               }              
            },
            error      : function() {
            //console.error("error");
            document.getElementById('botonThumbnail').style.visibility='visible'; // show
            alert(dato.msg);
                            
               }
		});
			
	}


	/*Actualizacion de imagenes */

       //sube archivos 
	   
	   function actualizaDestacadaAjax(id,ruta){		   
			
			
			document.getElementById('botonDestacada').style.visibility='hidden'; // hide
			  
			var inputFileImage = document.getElementById(id);
			
			var file = inputFileImage.files[0];			
			var data = new FormData();
			
			data.append('archivo',file);
			data.append('OldNombreImagenDestacada',$("#OldNombreImagenDestacada").val());

			var url = ruta+"actualizaDestacadaAjax.php";
			
			$.ajax({
			
			url:url,
			
			type:'POST',
			
			contentType:false,
			
			data:data,
			
			dataType: "json",
			
			processData:false,
			
			cache:false,
						
			success    : function(dato) {
            //console.error(JSON.stringify(response));

            if(dato.msg!=""){            	
            	 $('#NombreImagenDestacada').val(dato.nombreArchivo);
            	 $('#imgDestacada').html("Imagén almacenada<strong>"+dato.nombreArchivo+"</strong>");
            	 $('#imgDestacadaSrc').attr('src', dato.archivo);
            	 document.getElementById('botonDestacada').style.visibility='visible'; // show
               }              
            },
            error      : function() {
            //console.error("error");
            document.getElementById('botonDestacada').style.visibility='visible'; // show
            alert(dato.msg);
                            
               }
		});
		
	}	
		 function actualizaThumbnailAjax(id,ruta){
		   
			document.getElementById('botonThumbnail').style.visibility='hidden'; // hide
			 $('#imgThumbSrc').attr('src', document.location.origin+"/identidadatleta/v1/wp-content/plugins/gestion-identidad-atleta/images/loading-img.gif");

			var inputFileImage = document.getElementById(id);
			
			var file = inputFileImage.files[0];
			
			var data = new FormData();
			
			data.append('archivo',file);
			
			data.append('OldNombreImagenThumbnail',$("#OldNombreImagenDestacada").val());
   
			var url = ruta+"actualizaThumbnailAjax.php";
			
			$.ajax({
			
			url:url,
			
			type:'POST',
			
			contentType:false,
			
			data:data,
			dataType: "json",
			
			processData:false,
			
			cache:false,
						
			success    : function(dato) {
            //console.error(JSON.stringify(response));

            if(dato.msg!=""){            	
            	 $('#NombreImagenThumbnail').val(dato.nombreArchivo);
            	 $('#imgThumbnail').html("Imagén almacenada<strong>"+dato.nombreArchivo+"</strong>");
            	 $('#imgThumbSrc').attr('src', dato.archivo);
            	 document.getElementById('botonThumbnail').style.visibility='visible'; // show
               }              
            },
            error      : function() {
            //console.error("error");
            document.getElementById('botonThumbnail').style.visibility='visible'; // show
            alert(dato.msg);
                            
               }
		});
			
	}