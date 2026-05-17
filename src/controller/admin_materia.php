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
require_once(BASE_PATH . '/src/model/materias/listaMaterias_XML.php');

$insertMateria = new insertMaterias();
$actualizarMateria = new actualizarMateria();
$eliminarMateria = new eliminarMateria();
$eliminarUnidad = new eliminarUnidad();
$insertUnidad = new insertUnidades();
$crud = new listaMaterias();
$obtenerMaterias = new obtenerMaterias();
$materia = new Materias();
$curd_xml = new listaMaterias_XML();


$method = $_SERVER['REQUEST_METHOD'];

$tipoDato = $_SERVER['HTTP_ACCEPT'];



switch ($method) {
	case 'GET':
		switch ($tipoDato) {
			case ("application/json"):
				header("Content-Type: application/json; charset=UTF-8");
				if (isset($_GET['claveMateria'])) {
					$materia = $obtenerMaterias->obtenerMaterias($_GET['claveMateria']);
					echo ($materia);
					//var_dump($materia);
				} else {
					header("Content-Type: application/json; charset=UTF-8");

					$listaMaterias = $crud->listaMaterias();
					echo($listaMaterias);
				}
				break;
			case ("application/xml"):
				header("Content-Type: application/xml; charset=UTF-8");
				$listaMaterias = $curd_xml->mostrarXML();
				break;
			case ("application/csv"):

				break;

		}

		break;

	case 'POST':
		$dato = json_decode(file_get_contents('php://input'), true);
		$insertMateria->insertarMaterias($dato);
		break;


	case 'PUT':
		$dato = json_decode(file_get_contents("php://input"), true);
		$actualizarMateria->actualizarMateria($dato);
		break;

	case 'DELETE':
		$dato = json_decode(file_get_contents('php://input'), true);
		$eliminarMateria->eliminarMateria($dato);
		break;
	case 'patch':
		break;
}
// si el elemento insertar no viene nulo llama al crud e inserta un libro

?>