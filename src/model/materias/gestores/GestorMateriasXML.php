<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/ControlEscolarMVCDWII/src/config/url.php";
require_once BASE_PATH . "/src/model/materias/Interfaces/I_LecturaMaterias.php";
require_once BASE_PATH . "/src/model/materias/Interfaces/I_EscrituraMaterias.php";
require_once BASE_PATH . "/src/model/materias/entidades/Materias.php";
require_once BASE_PATH . "/src/config/conexion.php";

class GestorMateriasXML
{
	private $conexion;

	public function __construct()
	{
		$this->conexion = Db::conectar();

	}

	//Listado de todas las materias
	public function mostrarXML()
	{
		$listaMaterias = [];

		$select = $this->conexion->query('SELECT * FROM materias');


		foreach ($select->fetchall(PDO::FETCH_ASSOC) as $materia) {

			$listaMaterias[] = $materia;
		}

		$XmlListaMaterias = $this->arrayXml($listaMaterias);
		//print_r($XmlListaMaterias);
		return $XmlListaMaterias;
	}

	function arrayToXml($data, $xmlData)
	{
		foreach ($data as $key => $value) {
			if (is_array($value)) {
				// Si es un sub-arreglo, crea un nodo y vuelve a llamar a la función
				$subnode = $xmlData->addChild($key);
				$this->arrayToXml($value, $subnode);
			} else {
				// Si es un valor, añade el nodo hijo
				$xmlData->addChild("$key", htmlspecialchars("$value"));
			}
		}
	}

	// // --- Uso ---
// $miArreglo = [
//     'empresa' => 'Tecnología S.A.',
//     'empleado' => [
//         'nombre' => 'Juan',
//         'edad' => '30',
//         'puesto' => 'Desarrollador'
//     ]
// ];

	private function arrayXml($miArreglo)
	{
		// Iniciar con un nodo raíz
		$xml = new SimpleXMLElement('<?xml version="1.0"?><root></root>');
		$this->arrayToXml($miArreglo, $xml);

		// Imprimir o guardar el XML
		return $xml->asXML();
	}

	public function obtenerMateria($claveMateria)
	{


		$select = $this->conexion->prepare('SELECT * FROM Materias WHERE claveMateria=:claveMateria'); //inner join para capturar existencia y Materiass
		$select->bindValue('claveMateria', $claveMateria);
		try {
			// echo json_encode(["message" => "Materia Encontrada"]);
			$select->execute();

			$materia = $select->fetch(PDO::FETCH_ASSOC);

			$JsonListaMateria = json_encode($materia);
			return $JsonListaMateria;
		} catch (Throwable) {

		}
	}



	public function insertarMateria($materia)
	{
		// Insertar el nuevo artículo
		$insert = $this->conexion->prepare('INSERT INTO Materias (claveMateria, nombre, semestre, horas, creditos) VALUES (:claveMateria, :nombre, :semestre, :horas, :creditos)');

		$insert->bindValue('claveMateria', $materia['claveMateria']);
		$insert->bindValue('nombre', $materia['nombre']);
		$insert->bindValue('semestre', $materia['semestre']);
		$insert->bindValue('horas', $materia['horas']);
		$insert->bindValue('creditos', $materia['creditos']);
		try {
			$insert->execute();
			echo json_encode(["message" => "Materia creada"]);
		} catch (Throwable $e) {
			// Code to handle the exception or error
			http_response_code(400);
			echo json_encode(["message" => "An error occurred: " . $e->getMessage()]);
		}
	}

	public function actualizarMateria($materia)
	{
		$actualizar = $this->conexion->prepare('UPDATE Materias SET claveMateria=:claveMateria, nombre=:nombre, semestre=:semestre, horas=:horas, creditos=:creditos WHERE claveMateria=:claveMateria');
		$actualizar->bindValue('claveMateria', $materia['claveMateria']);
		$actualizar->bindValue('nombre', $materia['nombre']);
		$actualizar->bindValue('semestre', $materia['semestre']);
		$actualizar->bindValue('horas', $materia['horas']);
		$actualizar->bindValue('creditos', $materia['creditos']);

		try {
			$actualizar->execute();
			echo json_encode(["message" => "Materia actualizada"]);
		} catch (Throwable $e) {
			// Code to handle the exception or error
			http_response_code(400);
			echo json_encode(["message" => "An error occurred: " . $e->getMessage()]);
		}
	}


	public function eliminarMateria($claveMateria)
	{
		$eliminar = $this->conexion->prepare('DELETE FROM Materias WHERE claveMateria=:claveMateria');
		$eliminar->bindValue('claveMateria', $claveMateria);

		try {
			$eliminar->execute();
			echo json_encode(["message" => "Materia eliminada"]);
		} catch (Throwable $e) {
			// Code to handle the exception or error
			http_response_code(400);
			echo json_encode(["message" => "An error occurred: " . $e->getMessage()]);
		}
	}



}

?>