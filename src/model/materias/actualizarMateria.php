<?php
require_once(BASE_PATH . '/src/config/conexion.php');
require_once(BASE_PATH . '/src/model/Materias.php');
class actualizarMateria
{

	public $conexion;
	public function __construct()
	{
		$this->conexion = Db::conectar();
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

}