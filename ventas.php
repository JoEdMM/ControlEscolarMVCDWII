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
	<title>Ventas de Artículos</title>
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
<a href="index.php">
        <button type="button">Regresar</button>
    </a>

	<h2 align = "center">Ventas de Artículos</h2>
	<br>
	<table border=1 align="center">
		<head>
			<td align="center" class="cambiocolor">Clave</td> 
			<td align="center" class="cambiocolor">Descripción</td>
			<td align="center" class="cambiocolor">Descuento</td>
			<td	align="center" class="cambiocolor">IVA</td>
			<td align="center" class="cambiocolor">Precio</td>
			<td align="center" class="cambiocolor">Existencias</td>
	
		</head>
		<body>
			<?php foreach ($listaArticulos as $articulo) {?>
			<tr>
				<td align="center"><?php echo $articulo->getCveArticulo() ?></td>
				<td align="center"><?php echo $articulo->getDescripcion() ?></td>
				<td align="center"><?php 
				$porcentajedescuento = $articulo->getDescuento().'%';
				echo $porcentajedescuento; ?></td>
				<td align="center"><?php 
				$porcentajeiva = $articulo->getIva().'%';
				echo $porcentajeiva; ?></td>

				<td align="center"><?php echo $articulo->getPrecio() ?></td>
				<td align="center"><?php echo $articulo->getExistencia() ?></td>
			</tr>
			<?php }?>
		</body> 
	</table>
	<br><br>

</body>
</html>
