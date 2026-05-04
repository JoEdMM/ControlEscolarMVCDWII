<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/ControlEscolarMVCDWII/src/config/url.php";
require_once BASE_PATH . "/src/model/unidades/Interfaces/I_LecturaUnidades.php";
require_once BASE_PATH . "/src/model/unidades/Interfaces/I_EscrituraUnidades.php";
require_once BASE_PATH . "/src/model/unidades/entidades/Unidades.php";
require_once BASE_PATH . "/src/config/conexion.php";

class GestorUnidades implements I_LecturaUnidades, I_EscrituraUnidades
{
    private $conexion;

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

    public function obtenerUnidadesporClave($claveMateria)
    {
        $selectUnidades = $this->conexion->prepare('SELECT * FROM Unidades WHERE MateriasClaveMateria=:claveMateria');
        $selectUnidades->bindValue('claveMateria', $claveMateria);
        $selectUnidades->execute();
        return $selectUnidades->fetchAll();

    }

    public function insertarUnidad($claveMateria, $numeroUnidad)
    {
        $insert = $this->conexion->prepare('INSERT INTO Unidades (MateriasClaveMateria, Nombre) VALUE (:MateriasClaveMateria, :Nombre)');
        $insert->bindValue('MateriasClaveMateria', $claveMateria);
        $nombreConNumero = "Unidad " . $numeroUnidad;
        $insert->bindValue('Nombre', $nombreConNumero);
        $insert->execute();
    }

    public function actualizarUnidad($materia)
    {
        // Ahora $materia ya no vendrá NULL porque lo llenamos en el controlador
        $actualizar = $this->conexion->prepare('UPDATE Unidades SET nombre=:nombre WHERE id=:id');

        $actualizar->bindValue(':nombre', $materia->getUnidades());
        $actualizar->bindValue(':id', $materia->getIdUnidad()); // Filtra por la unidad específica

        $actualizar->execute();
    }

    public function eliminarUnidad($claveMateria)
    {
        $eliminar = $this->conexion->prepare('DELETE FROM Unidades WHERE MateriasClaveMateria=:claveMateria');
        $eliminar->bindValue('claveMateria', $claveMateria);
        $eliminar->execute();
    }
}

?>