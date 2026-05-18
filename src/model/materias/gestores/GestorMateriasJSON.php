<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/ControlEscolarMVCDWII/src/config/url.php";
require_once BASE_PATH . "/src/model/materias/Interfaces/I_LecturaMaterias.php";
require_once BASE_PATH . "/src/model/materias/Interfaces/I_EscrituraMaterias.php";
require_once BASE_PATH . "/src/model/materias/entidades/Materias.php";
require_once BASE_PATH . "/src/config/conexion.php";

class GestorMateriasJSON implements I_LecturaMaterias, I_EscrituraMaterias
{
	private $conexion;

	public function __construct()
	{
		$this->conexion = Db::conectar();

	}

	//Listado de todas las materias
	public function listaMaterias()
	{
		$listaMaterias = [];
		$select = $this->conexion->query('SELECT * FROM Materias ORDER BY CAST(claveMateria AS UNSIGNED) ASC'); //inner join para ver las existencia y Materiass
		foreach ($select->fetchAll(PDO::FETCH_ASSOC) as $materia) {
			$listaMaterias[] = $materia;
		}

		$JsonListaMaterias = json_encode($listaMaterias);

		return $JsonListaMaterias;
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
			echo json_encode(["message" => "Materia ya creada: " . $e->getMessage()]);
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