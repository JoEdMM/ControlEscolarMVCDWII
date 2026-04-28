<?php
//incluye la clase Libro y CrudLibro
	require_once $_SERVER['DOCUMENT_ROOT'] . "/ControlEscolarMVCDWII/src/config/url.php"; 

?>

<html>
<head>
	<title> Alta materias</title>
</head>
<header>
	<h2 align = "center">Alta Artículos</h2>
	<link rel="stylesheet" href="<?=BASE_URL?>/bootstrap/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="<?=BASE_URL?>/css/style.css"/>
</header>


<form action='<?=BASE_URL?>/src/controller/admin_materia.php' method='post'>
	<table>
		<tr>
			<td class="cambiocolor">Clave materia:</td>
			<td> <input type='text' name='claveMateria'></td>
		</tr>
		<tr> 
			<td class="cambiocolor">Nombre:</td>
			<td><input type='text' name='nombre' ></td>
		</tr>
		<tr>
			<td class="cambiocolor">Semestre:</td>
			<td><input type='number' name='semestre' min="0" max="12"></td>
		</tr>
		<tr>
			<td class="cambiocolor">Horas:</td>
			<td><input type='text' name='horas' size=4></td>
		</tr>
		<tr>	
			<td class="cambiocolor">Creditos:</td>
			<td><input type='text' name='creditos' size=4></td>
		</tr>
		<input type='hidden' name='insertar' value='insertar'>
	</table>
	<br>
<div>
	<input type='submit' value='Guardar'>
	&nbsp;&nbsp;&nbsp;
	<a href="mostrar.php">
        <button type="button">Cancelar</button>
    </a>
</div>
</form>

</html>
