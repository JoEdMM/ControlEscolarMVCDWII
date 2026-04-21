<?php
require_once(BASE_PATH . '/src/config/conexion.php');
require_once(BASE_PATH . '/src/model/Materias.php');
class insertMaterias
{

	public $conexion;
	public function __construct()
	{
		$this->conexion = Db::conectar();
	}

	public function insertarMaterias($materia)
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


		/*
		   if ($insert->execute()) {
		   echo json_encode(["message" => "Materia creada"]);
	   } else {
		   echo json_encode(["error" => $conn->error]);
	   }
		   */

	}
}
