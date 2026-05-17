<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/ControlEscolarMVCDWII/src/config/url.php";

//incluye la clase Libro y CrudLibro
require_once(BASE_PATH . '/src/model/materias/entidades/Materias.php');
require_once(BASE_PATH . '/src/model/unidades/entidades/Unidades.php'); 
require_once(BASE_PATH . '/src/model/materias/gestores/GestorMateriasJSON.php');
require_once(BASE_PATH . '/src/model/unidades/gestores/GestorUnidadesJSON.php');

$gestorMaterias = new GestorMateriasJSON();
$gestorUnidades = new GestorUnidadesJSON();

$materia = new Materias();
$unidad = new Unidades();

$method = $_SERVER['REQUEST_METHOD'];

$tipoDato = $_SERVER['HTTP_ACCEPT'];



switch ($method) {
	case 'GET':
		switch ($tipoDato) {
			case ("application/json"):
				header("Content-Type: application/json; charset=UTF-8");
				if (isset($_GET['claveMateria']) && isset($_GET['unidades'])) {
					$materia = $gestorMaterias->obtenerMateria($_GET['claveMateria']);
					$unidad = $gestorUnidades->obtenerUnidadesporClaveNum($_GET['claveMateria'], $_GET['unidades']);

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
					$materia = $gestorMaterias->obtenerMateria($_GET['claveMateria']);

					if ($materia === 'false') {
						echo json_encode(["message" => "Materia No Encontrada"]);
						$materia = null;
					} else {
						echo json_encode(["message" => "Materia Encontrada"]);
					}
					echo ($materia);

				} else {
					header("Content-Type: application/json; charset=UTF-8");

					$listaMaterias = $gestorMaterias->listaMaterias();
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
		$gestorMaterias->insertarMateria($dato);
		break;


	case 'PUT':
		$dato = json_decode(file_get_contents("php://input"), true);
		$gestorMaterias->actualizarMateria($dato);
		break;

	case 'DELETE':
		switch ($tipoDato) {
			case ("application/json"):
				header("Content-Type: application/json; charset=UTF-8");
				//$dato = json_decode(file_get_contents("php://input"), true);

				if (isset($_GET['claveMateria']) && isset($_GET['unidades'])) {
					$unidad = $gestorUnidades->obtenerUnidadesporClaveNum($_GET['claveMateria'], $_GET['unidades']);
					$unidades = json_decode($unidad, true);

					if ($unidad === 'false') {
						echo json_encode(["message" => "Unidad Fue Eliminada o no Existe"]);
						return;
					}


					$gestorUnidades->eliminarUnidad_Id_Num($unidades['id']);
					echo json_encode(["message" => "Unidad Eliminada"]);
					//$materia = $obtenerMaterias->obtenerMaterias($_GET['claveMateria']);
				} elseif (isset($_GET['claveMateria'])) {
					$gestorMaterias->eliminarMateria($_GET['claveMateria']);
				}
		}
		break;
}

?>