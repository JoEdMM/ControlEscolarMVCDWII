<?php
	class Materias{
		private $claveMateria;
		private $nombre;
		private $semestre;
		private $horas;
		private $creditos;
		private $unidades;

		function __construct(){}

		public function getClaveMateria(){
		return $this->claveMateria;
		}

		public function setClaveMateria($claveMateria){
			$this->claveMateria = $claveMateria;
		}


		public function getNombre(){
		return $this->nombre;
		}

		public function setNombre($nombre){
			$this->nombre = $nombre;
		}

		public function getSemestre(){
		return $this->semestre;
		}

		public function setSemestre($semestre){
			$this->semestre = $semestre;
		}
		public function getHoras(){
		return $this->horas;
		}

		public function setHoras($horas){
			$this->horas = $horas;
		}

		public function getCreditos(){
		return $this->creditos;
		}
		public function setCreditos($creditos){
			$this->creditos = $creditos;
		}

		public function getUnidades(){
		return $this->unidades;
		}

		public function setUnidades($unidades){
			$this->unidades = $unidades;
		}
	}
?>
