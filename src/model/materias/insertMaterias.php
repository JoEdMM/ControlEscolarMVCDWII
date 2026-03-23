<?php
require_once(BASE_PATH . '/src/config/conexion.php');
require_once(BASE_PATH . '/src/model/Materias.php');
class insertMaterias{

	public $conexion;
    public function __construct()
	{
		$this->conexion = Db::conectar();
	}

    public function insertarMaterias($materia)
	{
			// Insertar el nuevo artículo
			$insert = $this->conexion->prepare('INSERT INTO Materias (claveMateria, nombre, semestre, horas, creditos) VALUES (:claveMateria, :nombre, :semestre, :horas, :creditos)');

			$insert->bindValue('claveMateria', $materia->getClaveMateria());
			$insert->bindValue('nombre', $materia->getNombre());
			$insert->bindValue('semestre', $materia->getSemestre());
			$insert->bindValue('horas', $materia->getHoras());
			$insert->bindValue('creditos', $materia->getCreditos());
			$insert->execute();
	}
}