<?php
// incluye la clase Db
require_once(BASE_PATH . '/src/config/conexion.php');
require_once(BASE_PATH . '/src/model/Materias.php');


class CrudMaterias
{
	// constructor de la clase
	public function __construct()
	{
	}

	// Create
	public function insertar($materia)
	{
		$db = Db::conectar();

		// Verifica si ya existe el artículo
		$revisar = $db->prepare('SELECT claveMateria FROM Materias WHERE claveMateria = :claveMateria');
		$revisar->bindValue('claveMateria', $materia->getClaveMateria());
		$revisar->execute();

		$resultado = $revisar->fetch();

		if ($resultado) {
			// Ya existe un artículo con esa clave
			header('Location: ../view/errorinsert.php');
			exit(); // Siempre recomendable después de redirigir
		} else {
			// Insertar el nuevo artículo
			$insert = $db->prepare('INSERT INTO Materias (claveMateria, nombre, semestre, horas, creditos) VALUES (:claveMateria, :nombre, :semestre, :horas, :creditos)');

			$insert->bindValue('claveMateria', $materia->getClaveMateria());
			$insert->bindValue('nombre', $materia->getNombre());
			$insert->bindValue('semestre', $materia->getSemestre());
			$insert->bindValue('horas', $materia->getHoras());
			$insert->bindValue('creditos', $materia->getCreditos());
			$insert->execute();
		}
	}

	public function insertarUnidad($claveMateria, $numeroUnidad)
	{
		$db = Db::conectar();
		$insert = $db->prepare('INSERT INTO Unidades (MateriasClaveMateria, Nombre) VALUE (:MateriasClaveMateria, :Nombre)');
		$insert->bindValue('MateriasClaveMateria', $claveMateria);
		$nombreConNumero = "Unidad " . $numeroUnidad;
		$insert->bindValue('Nombre', $nombreConNumero);
		$insert->execute();
	}

	public function obtenerUnidades($claveMateria)
	{
		$db = Db::conectar();
		$sql = "SELECT * FROM Unidades WHERE MateriasClaveMateria = :claveMateria";
		$stmt = $db->prepare($sql);
		$stmt->execute([':claveMateria' => $claveMateria]);
		return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];

	}

	public function obtenerNumUnidades()
	{
		$db = Db::conectar();

	}
	// Read
	public function mostrar()
	{
		$db = Db::conectar();
		
		$listaMaterias = [];
		$select = $db->query('SELECT * FROM Materias ORDER BY CAST(claveMateria AS UNSIGNED) ASC'); //inner join para ver las existencia y Materiass
		foreach ($select->fetchAll() as $materia) {

			$myMateria = new Materias();
			$myMateria->setClaveMateria($materia['claveMateria']);
			$myMateria->setNombre($materia['nombre']);
			$myMateria->setSemestre($materia['semestre']);
			$myMateria->setHoras($materia['horas']);
			$myMateria->setCreditos($materia['creditos']);
			$claveMateria = $materia['claveMateria'];
			$unidades = $this->obtenerUnidadesporClave($claveMateria);
			$numUnidades = count($unidades);
			$myMateria->setUnidades($numUnidades);
			//$myMateria->setUnidades($numUnidades);
			//$myMateria->setExistencia($materia['existencia']);
			$listaMaterias[] = $myMateria;
		}
		
		return $listaMaterias;


	}

	// Delate
	public function eliminar($claveMateria)
	{
		$db = Db::conectar();
		$eliminar = $db->prepare('DELETE FROM Materias WHERE claveMateria=:claveMateria');
		$eliminar->bindValue('claveMateria', $claveMateria);
		$eliminar->execute();

	}

	public function obtenerUnidadesporClave($claveMateria){
		$db = Db::conectar();
		$selectUnidades = $db->prepare('SELECT * FROM Unidades WHERE MateriasClaveMateria=:claveMateria');
		$selectUnidades->bindValue('claveMateria', $claveMateria);
		$selectUnidades->execute();
		return $selectUnidades->fetchAll();

	}
	// Search
	public function obtenerMateria($claveMateria)
	{

		$db = Db::conectar();
		$unidades = $this->obtenerUnidadesporClave($claveMateria);
		$numUnidades = count($unidades);

		$select = $db->prepare('SELECT * FROM Materias WHERE claveMateria=:claveMateria'); //inner join para capturar existencia y Materiass
		$select->bindValue('claveMateria', $claveMateria);
		$select->execute();

		$materia = $select->fetch();


		//valida que exista materia igual y manda a la pagina de error
		if (!$materia && $numUnidades == 0) {
			header('Location: error.php');
		} else {

			$myMateria = new Materias();
			$myMateria->setClaveMateria($materia['claveMateria']);
			$myMateria->setNombre($materia['nombre']);
			$myMateria->setSemestre($materia['semestre']);
			$myMateria->setHoras($materia['horas']);
			$myMateria->setCreditos($materia['creditos']);
			$myMateria->setUnidades($numUnidades);
			return $myMateria;

		}

		$selectUnidades = $db->prepare('SELECT * FROM Unidades WHERE MateriasClaveMateria=:claveMateria');
		$selectUnidades->bindValue('claveMateria', $claveMateria);
		$selectUnidades->execute();
	}

	// Update
	public function actualizar($materia)
	{
		$db = Db::conectar();
		$actualizar = $db->prepare('UPDATE Materias SET claveMateria=:claveMateria, nombre=:nombre, semestre=:semestre, horas=:horas, creditos=:creditos WHERE claveMateria=:claveMateria');
		$actualizar->bindValue('claveMateria', $materia->getClaveMateria());
		$actualizar->bindValue('nombre', $materia->getNombre());
		$actualizar->bindValue('semestre', $materia->getSemestre());
		$actualizar->bindValue('horas', $materia->getHoras());
		$actualizar->bindValue('creditos', $materia->getCreditos());
		$actualizar->execute();
		
		$actualizarUnidad = $db->prepare('UPDATE Unidades SET MateriasClaveMateria=:claveMateria, Nombre=:nombre WHERE MateriasClaveMateria=:claveMateria');
		
	}

	// funciòn para actualizar existencia
	public function actualizarexistencia($materia)
	{
		$db = Db::conectar();
		$actualizarExistencia = $db->prepare('UPDATE Existencias SET claveMateria=:claveMateria, existencia=:existencia WHERE claveMateria=:claveMateria');
		$actualizarExistencia->bindValue('claveMateria', $materia->getClaveMateria());
		$actualizarExistencia->bindValue('existencia', $materia->getExistencia());
		$actualizarExistencia->execute();
	}

	public function eliminarUnidades($claveMateria){
		$db = Db::conectar();
		$eliminar = $db->prepare('DELETE FROM Unidades WHERE MateriasClaveMateria=:claveMateria');
		$eliminar->bindValue('claveMateria', $claveMateria);
		$eliminar->execute();
	}
}
?>