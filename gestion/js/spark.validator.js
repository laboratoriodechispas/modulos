function validaCorreo(valor)
{
	var reg=/(^[a-zA-Z0-9._-]{1,30})@([a-zA-Z0-9.-]{1,30}$)/;
	if(reg.test(valor)) return true;
	else return false;
}


function validaLongitud(valor, permiteVacio, minimo, maximo)
{
	

	if(valor=="phone:" || valor=="mail:" || valor =="name:" || valor == "last-name:"){
		return false;
	}
		
	var cantCar=valor.length;
	
	if(valor=="")
	{
		if(permiteVacio) return true;
		else return false;
	}
	else
	{
		if(cantCar>=minimo && cantCar<=maximo) return true;
		else return false;
	}
	
}

/*
* Valida numeros
*/
function validaNumero(valor,permiteVacio,minimo,maximo){

	if(valor=="")
	{
		if(permiteVacio) return true;
		else return false;
	}
	else
	{
			
		if(valor>=minimo && valor<=maximo) return true;
		else return false;
		
	}


}




function soloNumeros(e, decimal) {

	var key;
	var keychar;
	
	if (window.event) {
	   key = window.event.keyCode;
	}
	else if (e) {
	   key = e.which;
	}
	else {
	   return true;
	}
	keychar = String.fromCharCode(key);
	
	if ((key==null) || (key==0) || (key==8) ||  (key==9) || (key==13) || (key==27) ) {
	   return true;
	}
	else if ((("0123456789").indexOf(keychar) > -1)) {
	   return true;
	}
	else if (decimal && (keychar == ".")) { 
	  return true;
	}
	else
	   return false;
	}



/*
* Convierte a formato moneda un texto
*/function convierteMoneda(num) {
	num = num.toString().replace(/\$|\,/g,'');
	if(isNaN(num))
	num = "0";
	sign = (num == (num = Math.abs(num)));
	num = Math.floor(num*100+0.50000000001);
	cents = num%100;
	num = Math.floor(num/100).toString();
	if(cents<10)
	cents = "0" + cents;
	for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
	num = num.substring(0,num.length-(4*i+3))+','+
	num.substring(num.length-(4*i+3));
	return (((sign)?'':'-') + '$' + num + '.' + cents);
}
/*
* Funcion para verificar que sea moneda. $10.00
*/
  function validaMoneda(amount) {
    var regex = /^[1-9]\d*(?:\.\d{0,2})?$/;
    return regex.test(amount);
  }
/*
* Funcion para verificar fecha
*/
  function validaFecha(fecha) {
    var regex = /^\d{4}\-\d{1,2}\-\d{1,2}$/;;
    return regex.test(fecha);
  } 



function numbersonly(e, decimal) {
var key;
var keychar;

if (window.event) {
   key = window.event.keyCode;
}
else if (e) {
   key = e.which;
}
else {
   return true;
}
keychar = String.fromCharCode(key);

if ((key==null) || (key==0) || (key==8) ||  (key==9) || (key==13) || (key==27) ) {
   return true;
}
else if ((("0123456789").indexOf(keychar) > -1)) {
   return true;
}
else if (decimal && (keychar == ".")) { 
  return true;
}
else
   return false;
}
