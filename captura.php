<?php
//incluye la clase Libro y CrudLibro
	require_once('crudArticulos.php');
	require_once('Articulos.php');
	$crud= new crudArticulos();
	$articulo= new Articulos();
	//busca el libro utilizando el id, que es enviado por GET desde la vista mostrar.php
	$articulo=$crud->obtenerArticulo($_GET['cveArticulo']);
?>
<html>
<head>
	<title>Actualizar Libro</title>
</head>

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
		margin-bottom: 2em;
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

	.cambiocoloreditable{
        border: 2px solid #A1B7E1;
		border-radius: 5px;
		background-color: white;

    }
	input[type=submit]{
        background-color: #4471C4;
        color: white;
        padding: 5px 30px;
		border: 1px solid white;
		border-radius: 10px;
	
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

	a[href="localizar.php"]{	
		margin-left: 10%;
	}
	
	input[type=submit]:hover{
		background-color: #C5C5C5;
        color: white;
	}

	div{
		padding-left: 5em;
	}

</style>
<body>

	<h2 align = "center">Captura de Existencias</h2>
	<form action='admin_articulo.php' method='post'>
	<table>
		<tr>
			<input type='hidden' name='cveArticulo' value='<?php echo $articulo->getCveArticulo()?>'>
			<td class="cambiocolor">Clave Articulo:</td>
			<td><input type='text' name='cveArticulo' value='<?php echo $articulo->getCveArticulo()?>'readonly></td>
		</tr>
		<tr>
			<td class="cambiocolor">Descripcion:</td>
			<td><input type='text' name='descripcion' value='<?php echo $articulo->getDescripcion()?>'readonly></td>
		</tr>
		<tr>
			<td class="cambiocolor">En Sistema:</td>
			<td><input type='text' name='existencia' size="1" value='<?php echo $articulo->getExistencia()?>'readonly ></td>
		</tr>
		<tr>
			<td class="cambiocolor">Existencia Actual:</td>
			<td><input class="cambiocoloreditable" type='number' name='existencia' min="0" max="10000" value=''></td>
		</tr>
		<tr>
		<input type='hidden' name='actualizarexistencia' value='actualizarexistencia'>
	</table><br><br>
<div>
	<input type='submit' value='Guardar'>
	<a href="localizar.php">
        <button type="button">Cancelar</button>
    </a>
</div>
</form>
</body>
</html>
