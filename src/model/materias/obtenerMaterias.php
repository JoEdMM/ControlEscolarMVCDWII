<?php
require_once(BASE_PATH . '/src/config/conexion.php');
require_once(BASE_PATH . '/src/model/Materias.php');
require_once(BASE_PATH . '/src/model/unidades/obtenerUnidades_Id.php');
class obtenerMaterias{

	public $conexion;
	private $unidadxID;
    public function __construct()
	{
		$this->conexion = Db::conectar();
		
		$this->unidadxID = new obtenerUnidadesId();
	}

    public function obtenerMaterias($claveMateria)
	{

		$db = Db::conectar();
		$unidades = $this->unidadxID->obtenerUnidadesporClave($claveMateria);
		$numUnidades = count($unidades);

		$select = $db->prepare('SELECT * FROM Materias WHERE claveMateria=:claveMateria'); //inner join para capturar existencia y Materiass
		$select->bindValue('claveMateria', $claveMateria);
		$select->execute();

		$materia = $select->fetch();


		//valida que exista materia igual y manda a la pagina de error
		if ($materia == 0) {
			header('Location: error.php');
		} else {

			$myMateria = new Materias();
			$myMateria->setClaveMateria($materia['claveMateria']);
			$myMateria->setNombre($materia['nombre']);
			$myMateria->setSemestre($materia['semestre']);
			$myMateria->setHoras($materia['horas']);
			$myMateria->setCreditos($materia['creditos']);
			//$myMateria->setUnidades($numUnidades);
			return $myMateria;

		}

		// $selectUnidades = $db->prepare('SELECT * FROM Unidades WHERE MateriasClaveMateria=:claveMateria');
		// $selectUnidades->bindValue('claveMateria', $claveMateria);
		// $selectUnidades->execute();
	}
}