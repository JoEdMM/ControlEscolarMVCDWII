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
	
	<style>
	h2 {
		background-color: #F3823C;
		color: white;
		font: bold 20px Arial;
		padding: 5px 10px;
		width: 400px;
		float: center;
		margin: 20px auto;
		border-radius: 10px;
	}

	td {
		padding: 5px 10px;
		font: 1em Arial;

	}

	td input {
		border: 1px solid white;
		background-color: #C8C8C8;
		border-radius: 5px;

	}

	.cambiocolor {
		background-color: #A1B7E1;
		border-radius: 10px;
		border: 2px solid white;

	}

	input[type=submit] {
		background-color: #4471C4;
		color: white;
		padding: 5px 10px;
		border: 1px solid white;
		border-radius: 10px;

	}

	button {
		background-color: #4471C4;
		color: white;
		padding: 5px 20px;
		border: 1px solid white;
		border-radius: 10px;
	}

	button:hover {
		background-color: #C5C5C5;
		color: white;
	}


</style>
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
		<tr>	
			<td class="cambiocolor">Unidades:</td>
			<td><input type='number' name='unidades'  min="0" max="12"></td>
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
