<?php
require_once(BASE_PATH . '/src/config/conexion.php');
require_once(BASE_PATH . '/src/model/Materias.php');

class obtenerMaterias{

	public $conexion;
	private $unidadxID;
    public function __construct()
	{
		$this->conexion = Db::conectar();
		
		
	}

    public function obtenerMaterias($claveMateria)
	{

		$db = Db::conectar();
		$select = $db->prepare('SELECT * FROM Materias WHERE claveMateria=:claveMateria'); //inner join para capturar existencia y Materiass
		$select->bindValue('claveMateria', $claveMateria);
		$select->execute();

		$materia = $select->fetch();


		//valida que exista materia igual y manda a la pagina de error

			$myMateria = new Materias();
			$myMateria->setClaveMateria($materia['claveMateria']);
			$myMateria->setNombre($materia['nombre']);
			$myMateria->setSemestre($materia['semestre']);
			$myMateria->setHoras($materia['horas']);
			$myMateria->setCreditos($materia['creditos']);
	
			return $myMateria;


	}
}