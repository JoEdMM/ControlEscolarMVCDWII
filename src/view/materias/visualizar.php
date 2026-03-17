<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/ControlEscolarMVCDWII/src/config/url.php"; 
require_once BASE_PATH ."/src/model/materias/obtenerMaterias.php";
require_once BASE_PATH . "/src/model/Materias.php";
	$obtenerMaterias= new obtenerMaterias();
	$materia= new Materias();
	//busca el libro utilizando el id, que es enviado por GET desde la vista mostrar.php
	$materia=$obtenerMaterias->obtenerMaterias($_GET['claveMateria']);

// $unidades=$crud->obtenerUnidades($_GET['claveMateria']);
// $unid = count($unidades);
?>
<html>
<head>
	<title>Actualizar Libro</title>
</head>

<style>
	 h2{
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

	td input{
        border: 1px solid white;
		background-color: #C8C8C8;
		border-radius: 5px;

    }

	.cambiocolor{
		background-color: #A1B7E1;
		border-radius: 10px;

	}

	input[type=submit]{
        background-color: #4471C4;
        color: white;
        padding: 5px 10px;
		border: 1px solid white;
		border-radius: 10px;

    }

	button{
		background-color: #4471C4;
        color: white;
        padding: 5px 20px;
		border: 1px solid white;
		border-radius: 10px;
	}

	button:hover{
		background-color: #C5C5C5;
        color: white;
	}

	a[href="mostrar.php"]{	
		margin-left: 10%;
	}

</style>
<body>

	<h2 align = "center">Visualizar Artículos</h2>
	<br>
	<form action='admin_materia.php' method='post'>
	<table>
		<tr>
			<input type='hidden' name='claveMateria' value='<?= $materia->getClaveMateria()?>'>
			<td class="cambiocolor">Clave materia:</td>
			<td><input type='text' name='claveMateria' value='<?= $materia->getClaveMateria()?>'readonly></td>
		</tr>
		<tr>
			<td class="cambiocolor">Nombre:</td>
			<td><input type='text' name='nombre' value='<?= $materia->getnombre()?>'readonly></td>
		</tr>
		<tr>
			<td class="cambiocolor">Semestre:</td>
			<td><input type='text' name='semestre' size="1" value='<?= $materia->getsemestre()?>'readonly ></td>
		</tr>
		<tr>
			<td class="cambiocolor">Horas:</td>
			<td><input type='text' name='horas' size="1" value='<?= $materia->gethoras()?>'readonly></td>
		</tr>
		<tr>
			<td class="cambiocolor">Creditos:</td>
			<td><input type='text' name='creditos' size="1" value='<?= $materia->getcreditos()?>'readonly></td>
		</tr>
		<tr>
		<input type='hidden' name='actualizar' value='actualizar'>
	</table>
	<!--input type='submit' value='Guardar'>-->
	<br>
	<a href="mostrar.php">
        <button type="button">Regresar</button>
    </a>
</form>
</body>
</html>
