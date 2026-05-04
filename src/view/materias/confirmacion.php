<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/ControlEscolarMVCDWII/src/config/url.php"; 
require_once BASE_PATH ."/src/model/materias/gestores/GestorMaterias.php";
require_once BASE_PATH . "/src/model/materias/entidades/Materias.php";
	$gestorMaterias= new GestorMaterias();
	$materia= new Materias();
	//busca el libro utilizando el id, que es enviado por GET desde la vista mostrar.php
	$materia=$gestorMaterias->obtenerMateria($_GET['claveMateria']);

// $unidades=$crud->obtenerUnidades($_GET['claveMateria']);
// $unid = count($unidades);
?>
<html>
<head>
	<title>Confirmar eliminación</title>
</head>

<style>


	div{
		background-color: #325391;
		color: white;
		width: 400px;
		height: 200px;
		margin: 20px auto;
		border-radius: 30px;
		backdrop-filter: blur(10px);
	}

	h2{
		color: white;
		font: bold 20px Arial;
		padding: 5px 10px;
		padding-top: 3em;
		float: center;
		border-radius: 10px;
	}

	button{
		background-color: #A7A7A7;
        color: white;
        padding: 5px 30px;
		border: 1px solid #A7A7A7;
		border-radius: 10px;
	}

	button:hover{
		background-color: #C5C5C5;
        color: white;
	}

</style>

<body>
<div>
	<h2 align="center">¿Estás seguro de borrar esta materia?</h2>

	<form action="<?=BASE_URL?>/src/controller/admin_materia.php" method="get" align="center">
		<input type="hidden" name="claveMateria" value="<?php echo $materia->getClaveMateria(); ?>">
		<input type="hidden" name="accion" value="e">
		<button type="submit">Sí</button>

        <a href="mostrar.php">
        <button type="button">No</button></a>
	</form>

</div>
</body>
</html>
