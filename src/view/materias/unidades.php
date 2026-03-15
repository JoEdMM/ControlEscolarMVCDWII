<?php
//incluye la clase Libro y CrudLibro
require_once $_SERVER['DOCUMENT_ROOT'] . "/ControlEscolarMVCDWII/src/config/url.php"; 
require_once BASE_PATH ."/src/model/crudMaterias.php";
require_once BASE_PATH . "/src/model/Materias.php";
$crud=new crudMaterias();
$materia= new Materias();
//obtiene todos los libros con el método mostrar de la clase crud
$unidades=$crud->obtenerUnidades($_GET['claveMateria']);
$listaMaterias=$crud->mostrar();
?>

<html>
<head>
	<title>Mostrar Reporte de Materias</title>
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

	table{
		border-collapse: collapse;
		border: 1px solid white;
	}

	/*CAMBIO DE COLOR ENTRE TABLAS*/
	table tr:nth-child(odd) {
        background-color: #E9EBF5; 
    }

    table tr:nth-child(even) {
        background-color: #CFD4EA; 
    }

	.cambiocolor {
		background-color: #4471C4;
		color: white;
		font: 15px Arial;
		padding: 5px 15px;

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
</style>
<body>
	<h2 align = "center">Reporte del Catálogo de Materias</h2>

	<table border=1 align="center">
		<head>
			<td align="center" class="cambiocolor">Clave Materia</td>
			<td align="center" class="cambiocolor">Nombre</td>
		</head>
		<body>
			
			<?php foreach ($unidades as $unid) {?>
			<tr>
				<td align="center"><?= $unid['MateriasClaveMateria'] ?></td>
                <td align="center"><?= $unid['Nombre'] ?></td> 
			</tr>
			<?php }?>
		</body>
	</table>
	<br><br>
	<div align="center">
		<a href="mostrar.php">
        	<button type="button">Regresar</button>
    	</a>
	</div>
</body>
</html>
