<?php
require_once(BASE_PATH . '/src/config/conexion.php');
require_once(BASE_PATH . '/src/model/Unidades.php');
class obtenerUnidades{

	public $conexion;
    public function __construct()
	{
		$this->conexion = Db::conectar();
	}

    public function obtenerUnidades($claveMateria)
	{
		$sql = "SELECT * FROM Unidades WHERE MateriasClaveMateria = :claveMateria";
		$stmt = $this->conexion->prepare($sql);
		$stmt->execute([':claveMateria' => $claveMateria]);
		return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];

	}
}