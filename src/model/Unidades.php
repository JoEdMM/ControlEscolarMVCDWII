<?php
	class Unidades{
		private $unidades;
		private $idUnidad;


		function __construct(){}

		public function getUnidades(){
		return $this->unidades;
		}

		public function setUnidades($unidades){
			$this->unidades = $unidades;
		}

		public function getIdUnidad(){
		return $this->idUnidad;
		}

		public function setIdUnidad($idUnidad){
			$this->idUnidad = $idUnidad;
		}
	}
?>
