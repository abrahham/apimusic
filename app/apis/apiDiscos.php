<?php
	include_once "app/models/disco.php";
	include_once "app/libs/api.php";
	class ApiDiscos {
		private $modelo;
		public function __construct() {
			echo "hola";
			$this->modelo = new Disco();		
		}
		public function ver() {
			$arre = $this->modelo->getAll();
			echo json_encode($arre);
		}
	}
