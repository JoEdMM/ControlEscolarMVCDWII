<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/ControlEscolarMVCDWII/src/config/url.php";
require_once BASE_PATH . "/src/model/unidades/obtenerUnidades.php";
require_once BASE_PATH . "/src/model/materias/obtenerMaterias.php";
require_once BASE_PATH . "/src/model/Materias.php";
$obtenerUnidades = new obtenerUnidades();
$obtenerMaterias = new obtenerMaterias();
$materia = new Materias();
//busca el libro utilizando el id, que es enviado por GET desde la vista mostrar.php
$unidades = $obtenerUnidades->obtenerUnidades($_GET['claveMateria']);


// $unidades=$crud->obtenerUnidades($_GET['claveMateria']);
// $unid = count($unidades);
?>
<html>

<head>
	<title>Modificación Unidades</title>
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
	<h2 align="center">Modificación Unidades</h2>
	<form action='<?= BASE_URL ?>/src/controller/admin_materia.php' method='post'>

		<table>
			<?php foreach ($unidades as $unid) { ?>
				<tr>
					<td class="cambiocolor">Unidades:</td>
					<td>
						<!-- Añadimos [] al name para crear un arreglo -->
						<input type='text' name='unidades[]' value='<?= $unid['Nombre'] ?>'>

						<!-- Cambiamos el value por el ID real y el name a arreglo -->
						<input type='hidden' name='ids[]' value='<?= $unid['id'] ?>'>
					</td>
				</tr>
			<?php } ?>
			<!-- <tr>
			
		</tr> -->
			<tr>
				<input type='hidden' name='actualizarUnidad' value='actualizarUnidad'>
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
			</div>
		</div>

	</form>
</body>

</html>