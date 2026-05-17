<?php
require_once(BASE_PATH . '/src/config/conexion.php');
require_once(BASE_PATH . '/src/model/Materias.php');
class eliminarMateria_Id_Num
{

	public $conexion;
	public function __construct()
	{
		$this->conexion = Db::conectar();
	}

	public function eliminarMateria_Id_Num($unidades)
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