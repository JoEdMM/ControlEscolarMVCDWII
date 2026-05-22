<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/ControlEscolarMVCDWII/src/config/url.php";

$apikey = '22390450&22390538';
define('API_KEY', $apikey);
$headers = apache_request_headers();

$apiKeyCliente = isset($headers['X-API-KEY']) ? $headers['X-API-KEY'] : null;


if ($apiKeyCliente !== API_KEY) {
	header("Content-Type: application/json; charset=UTF-8");
	http_response_code(401);
	echo json_encode([
		"status" => "error",
		"message" => "Acceso denegado. API Key inválida o ausente en los Headers."
	]);
	exit;
}
//incluye la clase Libro y CrudLibro
require_once(BASE_PATH . '/src/model/materias/entidades/Materias.php');
require_once(BASE_PATH . '/src/model/unidades/entidades/Unidades.php');

require_once(BASE_PATH . '/src/model/materias/interfaces/I_LecturaMaterias.php');
require_once(BASE_PATH . '/src/model/materias/interfaces/I_EscrituraMaterias.php');
require_once(BASE_PATH . '/src/model/unidades/interfaces/I_LecturaUnidades.php');
require_once(BASE_PATH . '/src/model/unidades/interfaces/I_EscrituraUnidades.php');

require_once(BASE_PATH . '/src/model/materias/gestores/GestorMateriasJSON.php');
require_once(BASE_PATH . '/src/model/unidades/gestores/GestorUnidadesJSON.php');
require_once(BASE_PATH . '/src/model/materias/gestores/GestorMateriasXML.php');
require_once(BASE_PATH . '/src/model/unidades/gestores/GestorUnidadesXML.php');
require_once(BASE_PATH . '/src/model/materias/gestores/GestorMateriasCSV.php');
require_once(BASE_PATH . '/src/model/unidades/gestores/GestorUnidadesCSV.php');


// $gestorMaterias = new GestorMateriasJSON();
// $gestorUnidades = new GestorUnidadesJSON();
// $gestorMateriasXML = new GestorMateriasXML();
// $gestorUnidadesXML = new GestorUnidadesXML();
// $gestorMateriasCSV = new GestorMateriasCSV();
// $gestorUnidadesCSV = new GestorUnidadesCSV();

$materia = new Materias();
$unidad = new Unidades();

$method = $_SERVER['REQUEST_METHOD'];

$tipoDato = $_SERVER['HTTP_ACCEPT'];

$gestorMaterias = NULL;

$gestorUnidades = NULL;




switch ($tipoDato) {
	case ("application/json"):
		header("Content-Type: application/json; charset=UTF-8");
		$gestorMaterias = new GestorMateriasJSON();
		$gestorUnidades = new GestorUnidadesJSON();
		break;
	case ("application/xml"):
		header("Content-Type: application/xml; charset=UTF-8");
		$gestorMaterias = new GestorMateriasXML();
		$gestorUnidades = new GestorUnidadesXML();
		break;
	case ("application/csv"):
		header("Content-Type: text/csv; charset=UTF-8");
		$gestorMaterias = new GestorMateriasCSV();
		$gestorUnidades = new GestorUnidadesCSV();
		break;
}

switch ($method) {
	case 'GET':
		if (isset($_GET['claveMateria']) && isset($_GET['unidades'])) {
			$materia = $gestorMaterias->obtenerMateria($_GET['claveMateria']);
			$unidad = $gestorUnidades->obtenerUnidadesporClaveNum($_GET['claveMateria'], $_GET['unidades']);

			if ($materia === 'false' || $materia === null) {
				echo json_encode(["message" => "Materia No Encontrada"]);
				$materia = null;
			} else {
				echo json_encode(["message" => "Materia Encontrada"]);
			}
			echo ("\n" . $materia);

			if ($unidad === 'false' || $unidad === null) {
				echo json_encode(["message" => "Unidad No Encontrada"]);
				$unidad = null;
			} else {
				echo json_encode(["message" => "Unidad Encontrada"]);
			}
			echo ("\n" . $unidad);
			//var_dump($materia);
		} elseif (isset($_GET['claveMateria'])) {
			$materia = $gestorMaterias->obtenerMateria($_GET['claveMateria']);

			if ($materia === 'false' || $materia === null) {
				echo json_encode(["message" => "Materia No Encontrada"]);
				$materia = null;
			} else {
				echo json_encode(["message" => "Materia Encontrada"]);
			}
			echo ("\n" . $materia);

		} else {
			header("Content-Type: application/json; charset=UTF-8");

			$listaMaterias = $gestorMaterias->listaMaterias();
			echo ($listaMaterias);
		}

		break;
	case 'POST':
		$dato = file_get_contents('php://input');
		$gestorMaterias->insertarMateria($dato);
		break;
	case 'PUT':
		$dato = file_get_contents("php://input");
		$gestorMaterias->actualizarMateria($dato);
		break;
	case 'DELETE':
		if (isset($_GET['claveMateria']) && isset($_GET['unidades'])) {
			$unidad = $gestorUnidades->obtenerUnidadesporClaveNum($_GET['claveMateria'], $_GET['unidades']);
			if ($unidad === 'false' || $unidad === null) {
				echo json_encode(["message" => "Unidad Fue Eliminada o no Existe"]);
				return;
			}
			$gestorUnidades->eliminarUnidad_Id_Num($unidad);
			echo json_encode(["message" => "Unidad Eliminada"]);
		} elseif (isset($_GET['claveMateria'])) {

			$gestorMaterias->eliminarMateria($_GET['claveMateria']);
		}
		break;
}

?>