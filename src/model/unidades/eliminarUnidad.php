<?php
require_once(BASE_PATH . '/src/config/conexion.php');
require_once(BASE_PATH . '/src/model/Unidades.php');
class eliminarUnidad{

	public $conexion;
    public function __construct()
	{
		$this->conexion = Db::conectar();
	}

   public function eliminarUnidad($claveMateria){
		$eliminar = $this->conexion->prepare('DELETE FROM Unidades WHERE MateriasClaveMateria=:claveMateria');
		$eliminar->bindValue('claveMateria', $claveMateria);
		$eliminar->execute();
	}
}