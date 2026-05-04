<?php
require_once(BASE_PATH . '/src/config/conexion.php');
require_once BASE_PATH . "/src/model/materias/entidades/Materias.php";
class actualizarMateria{

	public $conexion;
    public function __construct()
	{
		$this->conexion = Db::conectar();
	}

   public function actualizarMateria($materia)
	{
		$actualizar = $this->conexion->prepare('UPDATE Materias SET claveMateria=:claveMateria, nombre=:nombre, semestre=:semestre, horas=:horas, creditos=:creditos WHERE claveMateria=:claveMateria');
		$actualizar->bindValue('claveMateria', $materia->getClaveMateria());
		$actualizar->bindValue('nombre', $materia->getNombre());
		$actualizar->bindValue('semestre', $materia->getSemestre());
		$actualizar->bindValue('horas', $materia->getHoras());
		$actualizar->bindValue('creditos', $materia->getCreditos());
		$actualizar->execute();
		
		
	}
}