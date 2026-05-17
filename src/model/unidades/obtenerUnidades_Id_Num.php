<?php
require_once(BASE_PATH . '/src/config/conexion.php');
require_once(BASE_PATH . '/src/model/Materias.php');
class obtenerUnidades_Id_Num
{

	public $conexion;
	public function __construct()
	{
		$this->conexion = Db::conectar();
	}

	public function obtenerUnidadesporClaveNum($claveMateria, $numUnidad)
	{
		$offset = (int) $numUnidad - 1;
		if ($offset < 0)
			$offset = 0;

		$selectUnidades = $this->conexion->prepare('SELECT * FROM Unidades WHERE MateriasClaveMateria=:claveMateria ORDER BY id ASC LIMIT 1 OFFSET :offset');
		$selectUnidades->bindValue('claveMateria', $claveMateria);
		$selectUnidades->bindValue(':offset', $offset, PDO::PARAM_INT);
		try {
			
			$selectUnidades->execute();
			$unidad = $selectUnidades->fetch(PDO::FETCH_ASSOC);

			$JsonListaUnidad = json_encode($unidad);
			return $JsonListaUnidad;
		} catch (Throwable $e) {
			echo json_encode(["message" => "Unidad No Encontrada"]);
			return false;
		}



	}
}