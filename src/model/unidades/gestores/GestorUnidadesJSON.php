<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/ControlEscolarMVCDWII/src/config/url.php";
require_once BASE_PATH . "/src/model/unidades/Interfaces/I_LecturaUnidades.php";
require_once BASE_PATH . "/src/model/unidades/Interfaces/I_EscrituraUnidades.php";
require_once BASE_PATH . "/src/model/unidades/entidades/Unidades.php";
require_once BASE_PATH . "/src/config/conexion.php";

class GestorUnidadesJSON implements I_LecturaUnidades, I_EscrituraUnidades
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

    public function eliminarUnidad_Id_Num($unidades)
	{
		// $offset = (int) $unidades - 1;
		// if ($offset < 0)
		// 	$offset = 0;
		$eliminar = $this->conexion->prepare('DELETE FROM Unidades WHERE id=:id ');
		$eliminar->bindValue('id', $unidades);

		try {
			$eliminar->execute();
		} catch (Throwable $e) {
			// Code to handle the exception or error
			http_response_code(400);
			echo json_encode(["message" => "An error occurred: " . $e->getMessage()]);
		}
	}
}

?>