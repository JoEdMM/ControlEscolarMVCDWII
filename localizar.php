<?php
//incluye la clase Libro y CrudLibro
require_once('crudArticulos.php');
require_once('Articulos.php');
$crud=new crudArticulos();
$articulo= new Articulos();
//obtiene todos los libros con el método mostrar de la clase crud
$listaArticulos=$crud->mostrar();
?>
<html>
<head>
	<title> Alta Articulos</title>
</head>
<header>

	<h2 align = "center">Manejo de Existencias</h2>
</header>

<style>
	 h2{
		background-color: #F3823C;
		color: white;
		font: bold 30px Arial;
		padding: 5px 3em;
		width: 400px;
		float: center;
		margin: 20px auto;
		border-radius: 10px;
	}

    h3{
        font: 2em Arial;
        padding-bottom: 1em;
    }

    td {
        padding: 5px 10px;
		font: 1em Arial;

    }

	td input{
        border: 1px solid #A1B7E1;
		border-radius: 5px;

    }

	.cambiocolor{
		background-color: #A1B7E1;
		border-radius: 10px;

	}

	input[type=submit]{
        background-color: #4471C4;
        color: white;
        padding: 5px 20px;
		border: 1px solid white;
		border-radius: 10px;
    }

	input[type=submit]:hover{
		background-color: #C5C5C5;
        color: white;
	}

	button{
		background-color: #4471C4;
        color: white;
        padding: 5px 30px;
		border: 1px solid white;
		border-radius: 10px;
	}

	button:hover{
		background-color: #C5C5C5;
        color: white;
	}

	a[href="existencias.php"]{
		padding-left: 5em;
		padding-right: 5em;
	}



</style>
<body>

	<form action="captura.php" method="get">
    <h3 align="center"> Teclee la clave del artículo a capturar</h3>
	<table align="center">
		<tr>
			<td class="cambiocolor">Clave Articulo:</td>
			<td> <input type='text' name='cveArticulo'></td>
        </tr>
	</table>
	<br><br><br><br>
<div align="center">
	<input type="submit" value="Buscar">
	<a href="existencias.php">
        <button type="button">Cancelar</button>
    </a>
	<a href="reporte.php">
        <button type="button">Reporte</button>
    </a>
</div>
</form>

</html>