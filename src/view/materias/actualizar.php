<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/ControlEscolarMVCDWII/src/config/url.php";
require_once BASE_PATH . "/src/model/materias/gestores/GestorMaterias.php";
require_once BASE_PATH . "/src/model/materias/entidades/Materias.php";
$gestorMaterias = new GestorMaterias();
$materia = new Materias();
//busca el libro utilizando el id, que es enviado por GET desde la vista mostrar.php
$materia = $gestorMaterias->obtenerMateria($_GET['claveMateria']);

// $unidades=$crud->obtenerUnidades($_GET['claveMateria']);
// $unid = count($unidades);
?>
<html>

<head>
	<title>Modificación Artículos</title>
	<link rel="stylesheet" href="<?= BASE_URL ?>/bootstrap/css/bootstrap.min.css" />
</head>

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
		border: 1px solid #A1B7E1;
		border-radius: 5px;

	}

	.cambiocolor {
		background-color: #A1B7E1;
		border-radius: 10px;
		border: 2px solid white;


	}

	.noeditar {
		background-color: #C8C8C8;
		border-radius: 5px;
	}

	input[type=submit] {
		background-color: #4471C4;
		color: white;
		padding: 5px 20px;
		border: 1px solid white;
		border-radius: 10px;

	}

	input[type=submit]:hover {
		background-color: #C5C5C5;
		color: white;
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

	div {
		padding-left: 5em;
	}
</style>

<body>
	<h2 align="center">Modificación Artículos</h2>
	<form action='<?= BASE_URL ?>/src/controller/admin_materia.php' method='post'>
		<table>
			<tr>
				<input type='hidden' name='claveMateria' value='<?php echo $materia->getClaveMateria() ?>'>
				<td class="cambiocolor">Clave materia:</td>
				<td><input class="noeditar" type='text' name='claveMateria'
						value='<?php echo $materia->getClaveMateria() ?>' readonly></td>
			</tr>
			<tr>
				<td class="cambiocolor">Nombre:</td>
				<td><input type='text' name='nombre' value='<?php echo $materia->getnombre() ?>'></td>
			</tr>
			<tr>
				<td class="cambiocolor">Semestre:</td>
				<td><input type='number' name='semestre' min="0" max="100"
						value='<?php echo $materia->getSemestre() ?>'>
				</td>
			</tr>
			<tr>
				<td class="cambiocolor">Horas:</td>
				<td><input type='number' name='horas' min="0" max="18" value='<?php echo $materia->getHoras() ?>'></td>
			</tr>
			<tr>
				<td class="cambiocolor">Creditos:</td>
				<td><input type='text' name='creditos' size="1" value='<?php echo $materia->getCreditos() ?>'></td>
			</tr>
		
			<tr>
				<input type='hidden' name='actualizar' value='actualizar'>
		</table>
		<div class="container-fluid py-5">
			<div class="row align-items-center text-center gap-5">
				<div class="col-12 col-md-1">
					<input type='submit' value='Guardar'>
				</div>
				<div class="col-12 col-md-1">
					<a href="mostrar.php">
						<button type="button">Volver</button>
					</a>
				</div>
				<div class="col-12 col-md-1">
					<a href="actualizarUnidades.php?claveMateria=<?= $materia->getClaveMateria() ?>&accion=uu">
						<button type="button" class="px-4 text-nowrap">Editar Unidades</button>
					</a>
				</div>
			</div>
		</div>
		
	</form>
</body>

</html>