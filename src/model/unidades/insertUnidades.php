<?php
require_once(BASE_PATH . '/src/config/conexion.php');
require_once(BASE_PATH . '/src/model/Materias.php');
class insertUnidades{

	public $conexion;
    public function __construct()
	{
		$this->conexion = Db::conectar();
	}

    public function insertarUnidad($claveMateria, $numeroUnidad)
	{
		$insert = $this->conexion->prepare('INSERT INTO Unidades (MateriasClaveMateria, Nombre) VALUE (:MateriasClaveMateria, :Nombre)');
		$insert->bindValue('MateriasClaveMateria', $claveMateria);
		$nombreConNumero = "Unidad " . $numeroUnidad;
		$insert->bindValue('Nombre', $nombreConNumero);
		$insert->execute();
	}
}