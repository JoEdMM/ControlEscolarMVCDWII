<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/ControlEscolarMVCDWII/src/config/url.php";

//incluye la clase Libro y CrudLibro
require_once(BASE_PATH . '/src/model/crudMaterias.php');
require_once(BASE_PATH . '/src/model/Materias.php');

$crud = new crudMaterias();
$materia = new Materias();


// si el elemento insertar no viene nulo llama al crud e inserta un libro
if (isset($_POST['insertar'])) {
	$materia->setClaveMateria($_POST['claveMateria']);
	$materia->setNombre($_POST['nombre']);
	$materia->setSemestre($_POST['semestre']);
	$materia->setHoras($_POST['horas']);
	$materia->setCreditos($_POST['creditos']);
	$unidades = $_POST['unidades'];
	$materia->setUnidades($unidades);

	$crud->insertar($materia);
	for ($i = 0; $i < $materia->getUnidades(); $i++) {
		// Pasamos el número actual (1, 2, 3, 4, 5)
		$numeroActual = $i + 1;
		$crud->insertarUnidad($materia->getClaveMateria(), $numeroActual);
	}
	//llama a la función insertar definida en el crud

	header('Location:' . BASE_URL . '/src/view/mostrar.php');
	// si el elemento de la vista con nombre actualizar no viene nulo, llama al crud y actualiza el libro
} elseif (isset($_POST['actualizar'])) {
	$materia->setClaveMateria($_POST['claveMateria']);
	$materia->setNombre($_POST['nombre']);
	$materia->setSemestre($_POST['semestre']);
	$materia->setHoras($_POST['horas']);
	$materia->setCreditos($_POST['creditos']);
	$crud->actualizar($materia);
	header('Location: ' . BASE_URL . '/src/view/mostrar.php');
	// para que se pueda acualizar la existencia de un mate$materia 	
} elseif ($_GET['accion'] == 'e') {
	$crud->eliminarUnidades($_GET['claveMateria']);
	$crud->eliminar($_GET['claveMateria']);
	header('Location: ' . BASE_URL . '/src/view/mostrar.php');
	// si la variable accion enviada por GET es == 'a', envía a la página actualizar.php
} elseif ($_GET['accion'] == 'a') {
	header('Location:' . BASE_URL . '/src/view/actualizar.php');
}

?>