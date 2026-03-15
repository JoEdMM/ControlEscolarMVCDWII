//crear abjeto XMLHttpRequest
function creaObjetoAjax () { 
     var obj; //variable que recoger&aacute; el objeto
     if (window.XMLHttpRequest) { //c&oacute;digo para mayor&iacute;a de navegadores
        obj=new XMLHttpRequest();
        }
     else { //para IE 5 y IE 6
        obj=new ActiveXObject(Microsoft.XMLHTTP);
        }
     return obj; //devolvemos objeto
     }
//funci&oacute;n constructora del objeto:			 
function ObjetoAjax () {
     var nuevoajax=creaObjetoAjax()
     this.objeto=nuevoajax;
     this.pedirTexto=pedirTextoAjax;
		 this.cargaXML=cargarXML;
     this.cargaTexto=cargarTexto;
     }			
//funci&oacute;n para el m&eacute;todo objeto.pedirTexto(url,id) 		
function pedirTextoAjax(url,id) {
     var nuevoajax=this.objeto;
     var idajax=id;
     nuevoajax.open("GET",url,true);
     nuevoajax.onreadystatechange=function () {  
        if (nuevoajax.readyState==4 && nuevoajax.status==200) {
           var textoAjax=nuevoajax.responseText;
           document.getElementById(idajax).innerHTML=textoAjax;
           }
        }
     nuevoajax.send(); 
     }
/*funci&oacute;n del m&eacute;todo cargaXML: devuelve el DOM del XML	
como par&aacute;metro de la funci&oacute;n que le pasamos*/
function cargarXML(url,funcion) {
     var nuevoajax=this.objeto; 
     var funcionXML=funcion 
     nuevoajax.open("GET",url,true);
     nuevoajax.onreadystatechange=function() { 
        if (nuevoajax.readyState==4 && nuevoajax.status==200) {
           var propiedad=nuevoajax.responseXML; 
           funcionXML(propiedad);
           }
        }	
     nuevoajax.send();
     }	
//funci&oacute;n del m&eacute;todo cargaTexto: 
//devuelve el texto del archivo en el par&aacute;metro.
function cargarTexto(url,funcion) {
     var nuevoajax=this.objeto; 
     var funcionTexto=funcion 
     nuevoajax.open("GET",url,true);
     nuevoajax.onreadystatechange=function() { 
        if (nuevoajax.readyState==4 && nuevoajax.status==200) {
           var nuevoTexto=nuevoajax.responseText; 
           funcionTexto(nuevoTexto);
           }
        }	
     nuevoajax.send();
     }		 		 