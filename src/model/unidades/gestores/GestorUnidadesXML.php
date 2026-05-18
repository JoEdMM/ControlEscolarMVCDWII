<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/ControlEscolarMVCDWII/src/config/url.php";
require_once BASE_PATH . "/src/model/unidades/Interfaces/I_LecturaUnidades.php";
require_once BASE_PATH . "/src/model/unidades/Interfaces/I_EscrituraUnidades.php";
require_once BASE_PATH . "/src/model/unidades/entidades/Unidades.php";
require_once BASE_PATH . "/src/config/conexion.php";

class GestorUnidadesXML implements I_LecturaUnidades, I_EscrituraUnidades
{
	private $conexion;

	public function __construct()
	{
		$this->conexion = Db::conectar();

	}

	//Listado de todas las materias
	// public function mostrarXML()
	// {
	// 	$listaMaterias = [];

	// 	$select = $this->conexion->query('SELECT * FROM materias ORDER BY CAST(claveMateria AS UNSIGNED) ASC'); //inner join para ver las existencia y Materiass


	// 	foreach ($select->fetchall(PDO::FETCH_ASSOC) as $materia) {

	// 		$listaMaterias[] = $materia;
	// 	}

	// 	$XmlListaMaterias = $this->arrayXml($listaMaterias);
	// 	//print_r($XmlListaMaterias);
	// 	return $XmlListaMaterias;
	// }

	private function arrayXml($miArreglo)
	{
		// Iniciar con un nodo raíz
		$xml = new SimpleXMLElement('<?xml version="1.0"?><root></root>');
		$this->arrayToXml($miArreglo, $xml);

		// Imprimir o guardar el XML
		return $xml->asXML();
	}

	private function arrayToXml($data, $xmlData)
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

	public function obtenerUnidadesporClaveNuM($claveMateria, $numUnidad)
	{
		$offset = (int) $numUnidad - 1;
		if ($offset < 0)
			$offset = 0;

		$selectUnidades = $this->conexion->prepare('SELECT * FROM Unidades WHERE MateriasClaveMateria=:claveMateria ORDER BY id ASC LIMIT 1 OFFSET :offset');
		$selectUnidades->bindValue('claveMateria', $claveMateria);
		$selectUnidades->bindValue(':offset', $offset, PDO::PARAM_INT);
		try {

			$selectUnidades->execute();
			$unidad = $selectUnidades->fetch(PDO::FETCH_ASSOC);

			if ($unidad === false) {
				return null;
			} else {
				$XmlUnidad = $this->arrayXml($unidad);
				return $XmlUnidad;
			}
		} catch (Throwable $e) {
			echo json_encode(["message" => "Unidad No Encontrada"]);
			return false;
		}

	}

	public function eliminarUnidad_Id_Num($unidades)
	{
		$unidadObjt = simplexml_load_string($unidades);
		$unidades = json_decode(json_encode($unidadObjt), true);
		// $offset = (int) $unidades - 1;
		// if ($offset < 0)
		// 	$offset = 0;
		$eliminar = $this->conexion->prepare('DELETE FROM Unidades WHERE id=:id ');
		$eliminar->bindValue('id', $unidades['id']);

		try {
			$eliminar->execute();
		} catch (Throwable $e) {
			// Code to handle the exception or error
			http_response_code(400);
			echo json_encode(["message" => "An error occurred: " . $e->getMessage()]);
		}
	}



}

?>