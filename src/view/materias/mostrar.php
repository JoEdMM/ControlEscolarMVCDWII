<?php
//incluye la clase Libro y CrudLibro
require_once $_SERVER['DOCUMENT_ROOT'] . "/ControlEscolarMVCDWII/src/config/url.php";
require_once BASE_PATH . "/src/model/materias/listaMaterias.php";
require_once BASE_PATH . "/src/model/Materias.php";

$listaMaterias = new listaMaterias();
$materia = new Materias();
//obtiene todos los libros con el método mostrar de la clase crud
$arrayMaterias = $listaMaterias->listaMaterias();
?>

<html>

<head>
	<title>Mostrar Catálogo de Artículos</title>
	<link rel="stylesheet" href="<?= BASE_URL ?>/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?= BASE_URL ?>/css/style.css" />
</head>


<body>

	<header>
		<h1 align="center" class="p-2 h2 fw-bold">Catálogo de Materias</h1>
	</header>
	<br>
	<table border=1 align="center">

		<head>
			<td align="center" class="cambiocolor">Clave Materia</td>
			<td align="center" class="cambiocolor">Nombre</td>
			<td align="center" class="cambiocolor">Semestre</td>
			<td align="center" class="cambiocolor">Horas</td>
			<td align="center" class="cambiocolor">Creditos</td>
			<td align="center" class="cambiocolor">Visualiza</td>
			<td align="center" class="cambiocolor">Edita</td>
			<td align="center" class="cambiocolor">Borra</td>
		</head>

		<body>
			<?php foreach ($arrayMaterias as $materia) { ?>
				<tr>
					<td align="center"><?= $materia->getClaveMateria() ?></td>
					<td align="center"><?= $materia->getNombre() ?></td>
					<td align="center"><?= $materia->getSemestre() ?></td>
					<td align="center"><?= $materia->getHoras() ?></td>

					<td align="center"><?= $materia->getCreditos() ?></td>
					<!-- implementación de imagenes-->
					<td align="center"><a href="visualizar.php?claveMateria=<?= $materia->getClaveMateria() ?>">
							<img src="<?= BASE_URL ?>/imagenes/visualiza.jpg" alt="Visualizar" width="24" height="24"></a>
					</td>
					<td align="center"><a href="actualizar.php?claveMateria=<?= $materia->getClaveMateria() ?>&accion=a">
							<img src="<?= BASE_URL ?>/imagenes/edita.jpg" alt="Editar" width="24" height="24"></a> </td>
					<td align="center"><a href="borrar.php?claveMateria=<?= $materia->getClaveMateria() ?>&accion=e">
							<img src="<?= BASE_URL ?>/imagenes/borra.jpg" alt="Borrar" width="24" height="24"></a> </td>
				</tr>
			<?php } ?>
		</body>
	</table>
	<div class="container py-5">
		<div class="row align-items-center justify-content-center text-center gap-5">
			<div class="col-12 col-md-3">
				<a href="ingresar.php" class="">
					<button type="button">Nuevo</button>
				</a>
			</div>
			<div class="col-12 col-md-3">

				<a href="imprimir.php" class="">
					<button type="button">Imprime</button>
				</a>
			</div>
		</div>
	</div>


</body>

</html>