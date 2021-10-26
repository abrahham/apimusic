<?php
	include_once "app/models/disco.php";
	include_once "app/libs/api.php";
	class ApiDiscos extends Api{
		private $modelo;
		public function __construct() {
			$this->modelo = new Disco();		
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
	}
