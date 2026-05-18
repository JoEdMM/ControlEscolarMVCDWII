<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/ControlEscolarMVCDWII/src/config/url.php";
require_once BASE_PATH . "/src/model/unidades/Interfaces/I_LecturaUnidades.php";
require_once BASE_PATH . "/src/model/unidades/Interfaces/I_EscrituraUnidades.php";
require_once BASE_PATH . "/src/model/unidades/entidades/Unidades.php";
require_once BASE_PATH . "/src/config/conexion.php";

class GestorUnidadesCSV
{
	private $conexion;

	public function __construct()
	{
		$this->conexion = Db::conectar();

	}

	//Listado de todas las materias
	private function arrayCsv($miArreglo)
	{
		if (empty($miArreglo)) {
			return "";
		}

		// Abrimos un flujo en memoria para escribir el CSV temporalmente
		$stream = fopen('php://temp', 'r+');

		// 1. Insertar las cabeceras (los nombres de las columnas de la base de datos)
		$cabeceras = array_keys($miArreglo[0]);
		fputcsv($stream, $cabeceras);

		// 2. Insertar las filas de datos
		foreach ($miArreglo as $fila) {
			fputcsv($stream, $fila);
		}

		// Rebobinar el puntero al inicio del flujo para poder leerlo
		rewind($stream);

		// Guardar el contenido del flujo en una variable
		$csvString = stream_get_contents($stream);

		// Cerrar el flujo
		fclose($stream);

		return $csvString;
	}

	public function obtenerUnidadesporClaveNumCsv($claveMateria, $numUnidad)
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
				$CsvUnidad = $this->arrayCsv([$unidad]);
				return $CsvUnidad;
			}
		} catch (Throwable $e) {
			echo json_encode(["message" => "Unidad No Encontrada"]);
			return false;
		}

	}

	public function eliminarUnidad_Id_NumCsv($unidades)
	{
		// $offset = (int) $unidades - 1;
		// if ($offset < 0)
		// 	$offset = 0;
		$eliminar = $this->conexion->prepare('DELETE FROM Unidades WHERE id=:id ');
		$eliminar->bindValue('id', $unidades);

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