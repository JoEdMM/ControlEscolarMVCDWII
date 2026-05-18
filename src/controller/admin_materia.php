<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/ControlEscolarMVCDWII/src/config/url.php";

//incluye la clase Libro y CrudLibro
require_once(BASE_PATH . '/src/model/materias/entidades/Materias.php');
require_once(BASE_PATH . '/src/model/unidades/entidades/Unidades.php');
require_once(BASE_PATH . '/src/model/materias/gestores/GestorMateriasJSON.php');
require_once(BASE_PATH . '/src/model/unidades/gestores/GestorUnidadesJSON.php');
require_once(BASE_PATH . '/src/model/materias/gestores/GestorMateriasXML.php');
require_once(BASE_PATH . '/src/model/unidades/gestores/GestorUnidadesXML.php');
require_once(BASE_PATH . '/src/model/materias/gestores/GestorMateriasCSV.php');
require_once(BASE_PATH . '/src/model/unidades/gestores/GestorUnidadesCSV.php');


$gestorMaterias = new GestorMateriasJSON();
$gestorUnidades = new GestorUnidadesJSON();
$gestorMateriasXML = new GestorMateriasXML();
$gestorUnidadesXML = new GestorUnidadesXML();
$gestorMateriasCSV = new GestorMateriasCSV();
$gestorUnidadesCSV = new GestorUnidadesCSV();

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
				if (isset($_GET['claveMateria']) && isset($_GET['unidades'])) {
					$materia = $gestorMateriasXML->obtenerMateriaXML($_GET['claveMateria']);
					$unidad = $gestorUnidadesXML->obtenerUnidadesporClaveNumXML($_GET['claveMateria'], $_GET['unidades']);

					if ($materia === null) {
						echo json_encode(["message" => "Materia No Encontrada"]);
						$materia = null;
					} else {
						echo json_encode(["message" => "Materia Encontrada"]);
					}

					echo ($materia);

					if ($unidad === null) {
						echo json_encode(["message" => "Unidad No Encontrada"]);
						$unidad = null;
					} else {
						echo json_encode(["message" => "Unidad Encontrada"]);
					}

					echo ($unidad);
					//var_dump($materia);
				} elseif (isset($_GET['claveMateria'])) {
					$materia = $gestorMateriasXML->obtenerMateriaXML($_GET['claveMateria']);
					if ($materia === null) {
						echo json_encode(["message" => "Materia No Encontrada"]);
						$materia = null;
					} else {
						echo json_encode(["message" => "Materia Encontrada"]);
					}
					echo ($materia);

				} else {
					$listaMaterias = $gestorMateriasXML->mostrarXML();
					echo ($listaMaterias);
				}
				break;



			case ("application/csv"):
				header("Content-Type: text/csv; charset=UTF-8");
				if (isset($_GET['claveMateria']) && isset($_GET['unidades'])) {
					$materia = $gestorMateriasCSV->obtenerMateriaCsv($_GET['claveMateria']);
					$unidad = $gestorUnidadesCSV->obtenerUnidadesporClaveNumCsv($_GET['claveMateria'], $_GET['unidades']);

					if ($materia === null) {
						echo json_encode(["message" => "Materia No Encontrada"]);
						$materia = null;
					} else {
						echo json_encode(["message" => "Materia Encontrada"]);
					}

					echo ("\n" . $materia);

					if ($unidad === null) {
						echo json_encode(["message" => "Unidad No Encontrada"]);
						$unidad = null;
					} else {
						echo json_encode(["message" => "Unidad Encontrada"]);
					}

					echo ("\n" . $unidad);
					//var_dump($materia);
				} elseif (isset($_GET['claveMateria'])) {
					$materia = $gestorMateriasCSV->obtenerMateriaCsv($_GET['claveMateria']);
					if ($materia === null) {
						echo json_encode(["message" => "Materia No Encontrada"]);
						$materia = null;
					} else {
						echo json_encode(["message" => "Materia Encontrada"]);
					}
					echo ("\n" . $materia);

				} else {
					$listaMaterias = $gestorMateriasCSV->mostrarCSV();
					echo ($listaMaterias);
				}
				break;

		}

		break;

	case 'POST':
		switch ($tipoDato) {
			case ("application/json"):
				header("Content-Type: application/json; charset=UTF-8");
				$dato = json_decode(file_get_contents('php://input'), true);
				$gestorMaterias->insertarMateria($dato);
				break;
			case ("application/xml"):
				header("Content-Type: application/xml; charset=UTF-8");
				$dato = file_get_contents('php://input');
				$materiaObjt = simplexml_load_string($dato);
				$materias = json_decode(json_encode($materiaObjt), true);
				$gestorMateriasXML->insertarMateriaXML($materias);
				break;
			case ("application/csv"):
				header("Content-Type: text/csv; charset=UTF-8");
				$dato = file_get_contents('php://input');
				$lineas = explode("\n", trim($dato));
				$cabeceras = str_getcsv($lineas[0]);
				$valores = str_getcsv($lineas[1]);
				$materia = array_combine($cabeceras, $valores);
				$gestorMateriasCSV->insertarMateriaCSV($materia);
				break;
		}
		break;

	case 'PUT':
		switch ($tipoDato) {
			case ("application/json"):
				header("Content-Type: application/json; charset=UTF-8");
				$dato = json_decode(file_get_contents("php://input"), true);
				$gestorMaterias->actualizarMateria($dato);
				break;
			case ("application/xml"):
				header("Content-Type: application/xml; charset=UTF-8");
				$dato = file_get_contents('php://input');
				$materiaObjt = simplexml_load_string($dato);
				$materias = json_decode(json_encode($materiaObjt), true);
				$gestorMateriasXML->actualizarMateriaXML($materias);
				break;
			case ("application/csv"):
				header("Content-Type: text/csv; charset=UTF-8");
				$dato = file_get_contents('php://input');
				$lineas = explode("\n", trim($dato));
				$cabeceras = str_getcsv($lineas[0]);
				$valores = str_getcsv($lineas[1]);
				$materia = array_combine($cabeceras, $valores);
				$gestorMateriasCSV->actualizarMateriaCSV($materia);
		}
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
				break;
			case ("application/xml"):
				header("Content-Type: application/xml; charset=UTF-8");
				//$dato = json_decode(file_get_contents("php://input"), true);
				if (isset($_GET['claveMateria']) && isset($_GET['unidades'])) {
					$unidad = $gestorUnidadesXML->obtenerUnidadesporClaveNumXML($_GET['claveMateria'], $_GET['unidades']);


					if ($unidad === null) {
						echo json_encode(["message" => "Unidad Fue Eliminada o no Existe"]);
						return;
					}
					$unidadObjt = simplexml_load_string($unidad);
					$unidades = json_decode(json_encode($unidadObjt), true);
					$gestorUnidadesXML->eliminarUnidad_Id_NumXML($unidades['id']);
					echo json_encode(["message" => "Unidad Eliminada"]);
					//$materia = $obtenerMaterias->obtenerMaterias($_GET['claveMateria']);
				} elseif (isset($_GET['claveMateria'])) {
					$gestorMaterias->eliminarMateria($_GET['claveMateria']);
				}
				break;
			case ("application/csv"):
				header("Content-Type: application/csv; charset=UTF-8");
				//$dato = json_decode(file_get_contents("php://input"), true);
				if (isset($_GET['claveMateria']) && isset($_GET['unidades'])) {
					$unidad = $gestorUnidadesCSV->obtenerUnidadesporClaveNumCsv($_GET['claveMateria'], $_GET['unidades']);



					if ($unidad === null) {
						echo json_encode(["message" => "Unidad Fue Eliminada o no Existe"]);
						return;
					}

					$lineas = explode("\n", trim($unidad));

					$cabeceras = str_getcsv($lineas[0]);

					$valores = str_getcsv($lineas[1]);

					$unidades = array_combine($cabeceras, $valores);

					$gestorUnidadesCSV->eliminarUnidad_Id_NumCsv($unidades['id']);
					echo json_encode(["message" => "Unidad Eliminada"]);
					//$materia = $obtenerMaterias->obtenerMaterias($_GET['claveMateria']);
				} elseif (isset($_GET['claveMateria'])) {
					$gestorMaterias->eliminarMateria($_GET['claveMateria']);
				}
				break;
		}
		break;
}

?>