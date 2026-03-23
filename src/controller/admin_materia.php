<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/ControlEscolarMVCDWII/src/config/url.php";

//incluye la clase Libro y CrudLibro
require_once(BASE_PATH . '/src/model/materias/insertMaterias.php');
require_once(BASE_PATH . '/src/model/materias/listaMaterias.php');
require_once(BASE_PATH . '/src/model/materias/actualizarMateria.php');
require_once(BASE_PATH . '/src/model/materias/eliminarMateria.php');
require_once(BASE_PATH . '/src/model/unidades/eliminarUnidad.php');
require_once(BASE_PATH . '/src/model/unidades/insertUnidades.php');
require_once(BASE_PATH . '/src/model/materias/obtenerMaterias.php');
require_once(BASE_PATH . '/src/model/Materias.php');

$insertMateria = new insertMaterias();
$actualizarMateria = new actualizarMateria();
$eliminarMateria = new eliminarMateria();
$eliminarUnidad = new eliminarUnidad();
$insertUnidad = new insertUnidades();
$crud = new listaMaterias();
$obtenerMaterias = new obtenerMaterias();
$materia = new Materias();

$method = $_SERVER['REQUEST_METHOD'];


switch ($method){
	case 'GET':

		if(isset($_GET['claveMateria'])){
			$materia = $obtenerMaterias->obtenerMaterias($_GET['claveMateria']);
			var_dump($materia);
		}
		else{
			echo $crud->listaMaterias();
		}

	case 'POST':
		$dato = json_decode(file_get_contents('php://input'));
		$listaMaterias = $insertMateria->insertarMaterias($dato);
		break;

	case 'DELETE':
		break;
	
	case 'UPDATE':
		break;
	case 'patch':
		break;
}
// si el elemento insertar no viene nulo llama al crud e inserta un libro

?>