<?php
require_once(BASE_PATH . '/src/config/conexion.php');
require_once(BASE_PATH . '/src/model/materias/entidades/Materias.php');
class eliminarMateria{

	public $conexion;
    public function __construct()
	{
		$this->conexion = Db::conectar();
	}

   public function eliminarMateria($claveMateria)
	{
		$eliminar = $this->conexion->prepare('DELETE FROM Materias WHERE claveMateria=:claveMateria');
		$eliminar->bindValue('claveMateria', $claveMateria);
		$eliminar->execute();

	}
}