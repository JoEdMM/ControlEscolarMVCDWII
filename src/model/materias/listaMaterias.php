<?php
// incluye la clase Db
require_once(BASE_PATH . '/src/config/conexion.php');
require_once(BASE_PATH . '/src/model/Materias.php');
require_once(BASE_PATH . '/src/model/unidades/obtenerUnidades_Id.php');


class listaMaterias
{
	public $conexion;
	private $unidadxID;
    public function __construct()
	{
		$this->conexion = Db::conectar();
		
		$this->unidadxID = new obtenerUnidadesId();
	}

	
	// Read
	public function listaMaterias()
	{
		
		$listaMaterias = [];
		$select = $this->conexion->query('SELECT * FROM Materias ORDER BY CAST(claveMateria AS UNSIGNED) ASC'); //inner join para ver las existencia y Materiass
		foreach ($select->fetchAll() as $materia) {

			$myMateria = new Materias();
			$myMateria->setClaveMateria($materia['claveMateria']);
			$myMateria->setNombre($materia['nombre']);
			$myMateria->setSemestre($materia['semestre']);
			$myMateria->setHoras($materia['horas']);
			$myMateria->setCreditos($materia['creditos']);
			$claveMateria = $materia['claveMateria'];
			$unidades = $this->unidadxID->obtenerUnidadesporClave($claveMateria);
			$numUnidades = count($unidades);
			$myMateria->setUnidades($numUnidades);
			//$myMateria->setUnidades($numUnidades);
			//$myMateria->setExistencia($materia['existencia']);
			$listaMaterias[] = $myMateria;
		}
		
		return $listaMaterias;


	}

}
?>