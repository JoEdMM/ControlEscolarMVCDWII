<?php
require_once(BASE_PATH . '/src/config/conexion.php');
require_once(BASE_PATH . '/src/model/Unidades.php');
class obtenerUnidadesId{

	public $conexion;
    public function __construct()
	{
		$this->conexion = Db::conectar();
	}

    public function obtenerUnidadesporClave($claveMateria){
		$selectUnidades = $this->conexion->prepare('SELECT * FROM Unidades WHERE MateriasClaveMateria=:claveMateria');
		$selectUnidades->bindValue('claveMateria', $claveMateria);
		$selectUnidades->execute();
		return $selectUnidades->fetchAll();

	}
}