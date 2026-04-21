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
		try{
			echo json_encode(["message" => "Materia Encontrada"]);
		} catch (Throwable){
			
		}
		$select->execute();

		$materia = $select->fetch(PDO::FETCH_ASSOC);

			$JsonListaMateria = json_encode($materia);
			return $JsonListaMateria;

	}
}