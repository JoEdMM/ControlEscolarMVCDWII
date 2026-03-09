docObjeto= new ObjetoAjax(); //instanciar objeto
docObjeto.cargaXML("ejemplo4.xml",recogeDatos); //m&eacute;todo para XML-DOM
function recogeDatos(xmlDoc) { //El par&aacute;metro contiene el DOM del XML
       //elemento de la p&aacute;gina donde insertar el archivo.
	 respuesta=document.getElementById("contenido");
			 //A partir del DOM obtenemos los distintos nodos del archivo:
			 //extraemos el contenido de la primera etiqueta "nombre" del XML
       miClave=xmlDoc.getElementsByTagName("CveArt")[0].childNodes[0].nodeValue;
       //escribimos el resultado en la p&aacute;gina
       respuesta.innerHTML="<p>Clave :"+miClave+"</p>";
       //hacemos lo mismo para el resto de etiquetas.
       miDescripcion=xmlDoc.getElementsByTagName("Descripcion")[0].childNodes[0].nodeValue;
       respuesta.innerHTML+="<p>Descripcion :"+miDescripcion+"</p>";
       miPrecio=xmlDoc.getElementsByTagName("Precio")[0].childNodes[0].nodeValue;
       respuesta.innerHTML+="<p>Precio :"+miPrecio+"</p>";
       miIva=xmlDoc.getElementsByTagName("IVA")[0].childNodes[0].nodeValue;
       respuesta.innerHTML+="<p>IVA :"+miIva+"</p>";
       miIva=xmlDoc.getElementsByTagName("Descripcion")[0].childNodes[0].nodeValue;
       respuesta.innerHTML+="<p>Descripcion:"+miDescripcion+"</p>";
    }

    function enviar(Clave) {
   //Recoger datos del formulario:
   val CveArt = Clave;
   reemail=document.datos.miemail.value; //Email escrito por el usuario
   recontra1=document.datos.micontra1.value; //Contrase&ntilde;a primera
   recontra2=document.datos.micontra2.value; //Contrase&ntilde;a segunda
   //Escribir la url para enviar los datos anteriores:
   ruta="SolicitaXML.php" //ruta del archivo
   envio1="cveart="+CveArt; //datos email
   
   url=ruta+"?"+envio1; //url para enviar
   ajax1=new ObjetoAjax; //instanciar objeto ObjetoAjax;
   docObjeto.cargaXML(url,recogeDatos);
  // ajax1.pedirTexto(url,"comp"); //m&eacute;todo que devuelve texto en un id.
   }