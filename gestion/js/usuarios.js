$(document).ready(function () {
                    


    ruta = document.location.origin+"/identidadatleta/v1/";


    $("#btnEnviarEvento").click(function () {
        registra_eventos_javascript();
    }); //fin de la función click


    /*Actualiza*/
    $("#btnActualizaEvento").click(function () { 
        actualiza_eventos_javascript();
    }); //fin de la función click


    function registra_eventos_javascript()

    {

        /*Copiar contenido del div editor to enriquecido*/
        $("#enriquecido").val(CKEDITOR.instances.editor1.getData());
        $("#btnEnviarEvento").hide("slow");
        var error = 0;
        var txtTitulo = $("#titulo").val();
        //variables error
        var errorTitulo = "";


        if (!validaLongitud(txtTitulo, 0, 1, 255))

        {

            error = 1;

            errorTitulo = "El Título no puede ser vacio.";

        }



        if (error == 0) {



            //Mostrar espere.

            $("#btnEnviarEvento").hide("slow");
            var envio = $.post(ruta + "wp-admin/admin-ajax.php?page=agregar_eventos", $("#frmAddEvento").serialize(),
                function (data) {

                    //equipo agregado con exito

                    if (data.msg == "1")

                    {



                    }



                    if (data.msg == "0")

                    {

                        $("#btnEnviarEvento").show("slow");

                        $("#frmAvisoError").html("No se agrego el evento, vuelve intentarlo");

                        $("#frmAvisoError").show("slow");



                    }

                }, "json");



        } else {



            $("#btnEnviarEvento").show("slow");



            $("#AvisoTitulo").html(errorTitulo);




        }




    }


    function actualiza_eventos_javascript()

    {

        /*Copiar contenido del div editor to enriquecido*/
        $("#enriquecido").val(CKEDITOR.instances.editor1.getData());
        $("#btnActualizaEvento").hide("slow");
        var error = 0;
        var txtTitulo = $("#titulo").val();
        //variables erroru
        var errorTitulo = "";

        if (!validaLongitud(txtTitulo, 0, 1, 255))

        {

            error = 1;

            errorTitulo = "El Título no puede ser vacio.";

        }



        if (error == 0) {



            //Mostrar espere.

            $("#btnActualizaEvento").hide("slow");
            var envio = $.post(ruta + "wp-admin/admin-ajax.php?page=agregar_eventos", $("#frmUpdateEvento").serialize(),
                function (data) {
                    //equipo agregado con exito
                    
                    if (data.msg == "1")

                    {
                    	$("#btnActualizaEvento").show("slow");
                    	$("#frmAvisoError").html("El evento se actualizo correctamente");

                    }



                    if (data.msg == "0")

                    {

                        $("#btnActualizaEvento").show("slow");
                        $("#frmAvisoError").html("No se agrego el evento, vuelve intentarlo");
                        $("#frmAvisoError").show("slow");



                    }

                }, "json");



        } else {



            $("#btnActualizaEvento").show("slow");
            $("#AvisoTitulo").html(errorTitulo);

        }



    }

      function registra_eventos_javascript()

    {

        /*Copiar contenido del div editor to enriquecido*/
        $("#enriquecido").val(CKEDITOR.instances.editor1.getData());
        $("#btnEnviarEvento").hide("slow");
        var error = 0;
        var txtTitulo = $("#titulo").val();
        //variables error
        var errorTitulo = "";


        if (!validaLongitud(txtTitulo, 0, 1, 255))

        {

            error = 1;

            errorTitulo = "El Título no puede ser vacio.";

        }



        if (error == 0) {



            //Mostrar espere.

            $("#btnEnviarEvento").hide("slow");
            var envio = $.post(ruta + "wp-admin/admin-ajax.php?page=agregar_eventos", $("#frmAddEvento").serialize(),
                function (data) {

                    //equipo agregado con exito

                    if (data.msg == "1")
                    {



                    }
                    if (data.msg == "0")

                    {

                        $("#btnEnviarEvento").show("slow");

                        $("#frmAvisoError").html("No se agrego el evento, vuelve intentarlo");

                        $("#frmAvisoError").show("slow");



                    }

                }, "json");



        } else {



            $("#btnEnviarEvento").show("slow");
            $("#AvisoTitulo").html(errorTitulo);




        }




    }

    function guardar_preguntas_javascript(){
        //declaracion
        var error = 0;
        var preguntas = $("#preguntas").val();
        var errorTitulo = "";

        if(preguntas==""){
            errorTitulo = "Este evento no tiene preguntas ahora";
        }
        //interaccion
        $("#btnGuardarPreguntas").hide("slow");

        if (error == 0) {
            var envio = $.post(ruta + "wp-admin/admin-ajax.php?page=agregar_eventos", $("#frmPreguntas").serialize(),
                function (data) {
                    //equipo agregado con exito
                    if (data.msg == "1")
                    {
                        $("#btnGuardarPreguntas").show("slow");
                        $("#frmAviso").html("Las preguntas se guardaron correctamente. \n"+errorTitulo);
                    }

                    if (data.msg == "0")

                    {

                        $("#btnGuardarPreguntas").show("slow");
                        $("#frmAviso").html("Hubo un error al agregar preguntas. Intentalo de Nuevo.");
                        
                    }

                }, "json");

        }else{
            $("#btnGuardarPreguntas").show("slow");
            $("#frmAviso").html("Hubo un error al agregar preguntas. Intentalo de Nuevo.");
        }
    }

});

