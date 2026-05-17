<?php
require_once(BASE_PATH . '/src/config/conexion.php');
require_once(BASE_PATH . '/src/model/Materias.php');
class eliminarMateria
{

	public $conexion;
	public function __construct()
	{
		$this->conexion = Db::conectar();
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