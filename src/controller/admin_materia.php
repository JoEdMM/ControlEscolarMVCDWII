<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/ControlEscolarMVCDWII/src/config/url.php";

//incluye la clase Libro y CrudLibro
require_once(BASE_PATH . '/src/model/materias/insertMaterias.php');
require_once(BASE_PATH . '/src/model/materias/listaMaterias.php');
require_once(BASE_PATH . '/src/model/materias/actualizarMateria.php');
require_once(BASE_PATH . '/src/model/materias/eliminarMateria.php');
require_once(BASE_PATH . '/src/model/unidades/eliminarUnidad.php');
require_once(BASE_PATH . '/src/model/unidades/insertUnidades.php');
require_once(BASE_PATH . '/src/model/unidades/obtenerUnidades_Id_Num.php');
require_once(BASE_PATH . '/src/model/unidades/eliminarMateria_Id_Num.php');
require_once(BASE_PATH . '/src/model/materias/obtenerMaterias.php');
require_once(BASE_PATH . '/src/model/Materias.php');
require_once(BASE_PATH . '/src/model/materias/listaMaterias_XML.php');

$insertMateria = new insertMaterias();
$actualizarMateria = new actualizarMateria();
$obtenerUnidades_Id_Num = new obtenerUnidades_Id_Num();
$eliminarMateria = new eliminarMateria();
$eliminarUnidad = new eliminarUnidad();
$eliminarMateria_Id_Num = new eliminarMateria_Id_Num();
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
				if (isset($_GET['claveMateria']) && isset($_GET['unidades'])) {
					$materia = $obtenerMaterias->obtenerMaterias($_GET['claveMateria']);
					$unidad = $obtenerUnidades_Id_Num->obtenerUnidadesporClaveNum($_GET['claveMateria'], $_GET['unidades']);

					if ($materia === 'false') {
						echo json_encode(["message" => "Materia No Encontrada"]);
						$materia = null;
					} else {
						echo json_encode(["message" => "Materia Encontrada"]);
					}

					echo ($materia);

					if ($unidad === 'false') {
						echo json_encode(["message" => "Unidad No Encontrada"]);
						$unidad = null;
					} else {
						echo json_encode(["message" => "Unidad Encontrada"]);
					}

					echo ($unidad);
					//var_dump($materia);
				} elseif (isset($_GET['claveMateria'])) {
					$materia = $obtenerMaterias->obtenerMaterias($_GET['claveMateria']);

					if ($materia === 'false') {
						echo json_encode(["message" => "Materia No Encontrada"]);
						$materia = null;
					} else {
						echo json_encode(["message" => "Materia Encontrada"]);
					}
					echo ($materia);

				} else {
					header("Content-Type: application/json; charset=UTF-8");

					$listaMaterias = $crud->listaMaterias();
					echo ($listaMaterias);
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
		switch ($tipoDato) {
			case ("application/json"):
				header("Content-Type: application/json; charset=UTF-8");
				//$dato = json_decode(file_get_contents("php://input"), true);

				if (isset($_GET['claveMateria']) && isset($_GET['unidades'])) {
					$unidad = $obtenerUnidades_Id_Num->obtenerUnidadesporClaveNum($_GET['claveMateria'], $_GET['unidades']);
					$unidades = json_decode($unidad, true);

					if ($unidad === 'false') {
						echo json_encode(["message" => "Unidad Fue Eliminada o no Existe"]);
						return;
					}


					$eliminarMateria_Id_Num->eliminarMateria_Id_Num($unidades['id']);
					echo json_encode(["message" => "Unidad Eliminada"]);
					//$materia = $obtenerMaterias->obtenerMaterias($_GET['claveMateria']);
				} elseif (isset($_GET['claveMateria'])) {
					$eliminarMateria->eliminarMateria($_GET['claveMateria']);
				}
		}
		break;
}
// si el elemento insertar no viene nulo llama al crud e inserta un libro

?>