<?php
require_once(BASE_PATH . '/src/config/conexion.php');
require_once(BASE_PATH . '/src/model/Unidades.php');
class actualizarUnidad{

	public $conexion;
    public function __construct()
	{
		$this->conexion = Db::conectar();
	}

   public function actualizarUnidad($materia)
{
    // Ahora $materia ya no vendrá NULL porque lo llenamos en el controlador
    $actualizar = $this->conexion->prepare('UPDATE Unidades SET nombre=:nombre WHERE id=:id');
    
    $actualizar->bindValue(':nombre', $materia->getUnidades());
    $actualizar->bindValue(':id', $materia->getIdUnidad()); // Filtra por la unidad específica
    
    $actualizar->execute();
}
}