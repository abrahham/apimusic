<?php
	include_once "app/models/artista.php";
	include_once "app/libs/api.php";
	class ApiArtistas extends Api {
		private $modelo;
		public function __construct() {
			$this->modelo = new Artista();
		}
		public function mostrar() {
			$arre = $this->modelo->getAll();
			$this->encabezados("GET",false);
			echo json_encode($arre);		
		}
		public function ver($id) {
			$this->modelo->id = $id;
			$arre = $this->modelo->get();
			$this->encabezados("GET",false);
			echo json_encode($arre);
		}
		public function agregar() {
		
		}
	}
