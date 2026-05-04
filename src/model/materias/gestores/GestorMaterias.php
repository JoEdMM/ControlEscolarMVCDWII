<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/ControlEscolarMVCDWII/src/config/url.php";
require_once BASE_PATH . "/src/model/materias/Interfaces/I_LecturaMaterias.php";
require_once BASE_PATH . "/src/model/materias/Interfaces/I_EscrituraMaterias.php";
require_once BASE_PATH . "/src/model/materias/entidades/Materias.php";
require_once BASE_PATH . "/src/config/conexion.php";

class GestorMaterias implements I_LecturaMaterias, I_EscrituraMaterias {
    private $conexion;

    public function __construct() {
        $this->conexion = Db::conectar();
    }
    
	//Listado de todas las materias
    public function listaMaterias()
	{	
		$listaMaterias = [];
		$select = $this->conexion->query('SELECT * FROM Materias ORDER BY CAST(claveMateria AS UNSIGNED) ASC'); //inner join para ver las existencia y Materiass
		foreach ($select->fetchAll() as $materia) {

			$myMateria = new Materias();
			$myMateria->setClaveMateria($materia['claveMateria']);
			$myMateria->setNombre($materia['nombre']);
			$myMateria->setSemestre($materia['semestre']);
			$myMateria->setHoras($materia['horas']);
			$myMateria->setCreditos($materia['creditos']);

			$listaMaterias[] = $myMateria;
		}
		
		return $listaMaterias;
	}

	public function obtenerMateria($claveMateria)
	{

		$db = Db::conectar();
		// $unidades = $this->unidadxID->obtenerUnidadesporClave($claveMateria);
		// $numUnidades = count($unidades);

		$select = $db->prepare('SELECT * FROM Materias WHERE claveMateria=:claveMateria'); //inner join para capturar existencia y Materiass
		$select->bindValue('claveMateria', $claveMateria);
		$select->execute();

		$materia = $select->fetch();


		//valida que exista materia igual y manda a la pagina de error
		if ($materia == 0) {
			header('Location: error.php');
		} else {

			$myMateria = new Materias();
			$myMateria->setClaveMateria($materia['claveMateria']);
			$myMateria->setNombre($materia['nombre']);
			$myMateria->setSemestre($materia['semestre']);
			$myMateria->setHoras($materia['horas']);
			$myMateria->setCreditos($materia['creditos']);
			//$myMateria->setUnidades($numUnidades);
			return $myMateria;

		}

	}

	public function insertarMateria($materia)
	{
		// Verifica si ya existe el artículo
		$revisar = $this->conexion->prepare('SELECT claveMateria FROM Materias WHERE claveMateria = :claveMateria');
		$revisar->bindValue('claveMateria', $materia->getClaveMateria());
		$revisar->execute();

		$resultado = $revisar->fetch();

		if ($resultado) {
			// Ya existe un artículo con esa clave
			header('Location: ../view/errorinsert.php');
			exit(); // Siempre recomendable después de redirigir
		} else {
			// Insertar el nuevo artículo
			$insert = $this->conexion->prepare('INSERT INTO Materias (claveMateria, nombre, semestre, horas, creditos) VALUES (:claveMateria, :nombre, :semestre, :horas, :creditos)');

			$insert->bindValue('claveMateria', $materia->getClaveMateria());
			$insert->bindValue('nombre', $materia->getNombre());
			$insert->bindValue('semestre', $materia->getSemestre());
			$insert->bindValue('horas', $materia->getHoras());
			$insert->bindValue('creditos', $materia->getCreditos());
			$insert->execute();
		}
	}

	public function actualizarMateria($materia)
	{
		$actualizar = $this->conexion->prepare('UPDATE Materias SET claveMateria=:claveMateria, nombre=:nombre, semestre=:semestre, horas=:horas, creditos=:creditos WHERE claveMateria=:claveMateria');
		$actualizar->bindValue('claveMateria', $materia->getClaveMateria());
		$actualizar->bindValue('nombre', $materia->getNombre());
		$actualizar->bindValue('semestre', $materia->getSemestre());
		$actualizar->bindValue('horas', $materia->getHoras());
		$actualizar->bindValue('creditos', $materia->getCreditos());
		$actualizar->execute();
		
		
	}

	public function eliminarMateria($claveMateria)
	{
		$eliminar = $this->conexion->prepare('DELETE FROM Materias WHERE claveMateria=:claveMateria');
		$eliminar->bindValue('claveMateria', $claveMateria);
		$eliminar->execute();

	}



}

?>