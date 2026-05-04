<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/ControlEscolarMVCDWII/src/config/url.php";

//incluye la clase Libro y CrudLibro
require_once(BASE_PATH . '/src/model/materias/entidades/Materias.php');
require_once(BASE_PATH . '/src/model/unidades/entidades/Unidades.php'); 
require_once(BASE_PATH . '/src/model/materias/gestores/GestorMaterias.php');
require_once(BASE_PATH . '/src/model/unidades/gestores/GestorUnidades.php');

$gestorMaterias = new GestorMaterias();
$gestorUnidades = new GestorUnidades();

$materia = new Materias();
$unidad = new Unidades();

// si el elemento insertar no viene nulo llama al crud e inserta un libro
if (isset($_POST['insertar'])) {
	$materia->setClaveMateria($_POST['claveMateria']);
	$materia->setNombre($_POST['nombre']);
	$materia->setSemestre($_POST['semestre']);
	$materia->setHoras($_POST['horas']);
	$materia->setCreditos($_POST['creditos']);
	$unidades = $_POST['unidades'];
	$unidad->setUnidades($unidades);

	$gestorMaterias->insertarMateria($materia);
	for ($i = 0; $i < $unidad->getUnidades(); $i++) {
		// Pasamos el número actual (1, 2, 3, 4, 5)
		$numeroActual = $i + 1;
		$gestorUnidades->insertarUnidad($materia->getClaveMateria(), $numeroActual);
	}
	//llama a la función insertar definida en el crud

	header('Location:' . BASE_URL . '/src/view/Materias/mostrar.php');
	// si el elemento de la vista con nombre actualizar no viene nulo, llama al crud y actualiza el libro
} elseif (isset($_POST['actualizar'])) {
	$materia->setClaveMateria($_POST['claveMateria']);
	$materia->setNombre($_POST['nombre']);
	$materia->setSemestre($_POST['semestre']);
	$materia->setHoras($_POST['horas']);
	$materia->setCreditos($_POST['creditos']);
	$gestorMaterias->actualizarMateria($materia);
	header('Location: ' . BASE_URL . '/src/view/Materias/mostrar.php');
	// para que se pueda acualizar la existencia de un mate$materia 	
}elseif (isset($_POST['actualizarUnidad'])) {
    $nombres = $_POST['unidades']; // Es un arreglo (unidades[])
    $ids = $_POST['ids'];           // Es un arreglo (ids[])
    //$clave = $_POST['claveMateria'];

    // Recorremos cada unidad enviada desde el formulario
    foreach ($nombres as $index => $nombreUnidad) {

        //$materiaTemp->setClaveMateria($clave);
        $unidad->setUnidades($nombreUnidad); 
        $unidad->setIdUnidad($ids[$index]); // Necesitas saber qué ID específico actualizar

        // Llamas al modelo por cada unidad
        $gestorUnidades->actualizarUnidad($unidad);
		header('Location: ' . BASE_URL . '/src/view/Materias/mostrar.php');
    }
} elseif ($_GET['accion'] == 'e') {
	$gestorUnidades->eliminarUnidad($_GET['claveMateria']);
	$gestorMaterias->eliminarMateria($_GET['claveMateria']);
	header('Location: ' . BASE_URL . '/src/view/Materias/mostrar.php');
	// si la variable accion enviada por GET es == 'a', envía a la página actualizar.php
} elseif ($_GET['accion'] == 'a') {
	header('Location:' . BASE_URL . '/src/view/Materias/actualizar.php');
} elseif ($_GET['accion'] == 'uu') {
	header('Location:' . BASE_URL . '/src/view/Materias/actualizarUnidades.php');
}

?>