<?php

class insertMaterias{
    public function insertarMaterias($materia)
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
}