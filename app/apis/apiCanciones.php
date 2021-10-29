<?php
	include_once "app/models/cancion.php";
	include_once "app/libs/api.php";
	class ApiCanciones extends Api {
		private $modelo;
		public function __construct() {
			$this->modelo = new Cancion();
		}
		public function agregar() {
			$data = json_decode(file_get_contents("php://input"),true);
			$this->modelo->nombre = $data["nombre"];
			$this->modelo->artista_id = $data["artistaId"];
			$this->modelo->disco_id = $data["discoId"];
			$res = $this->modelo->create();
			$this->encabezados("POST",true);
			echo json_encode(($res)
				? array("mensaje" => "Se ha agregado la canción.")
				: array("mensaje" => "Ha habido problemas al tratar de registrar la canción.")
			);
		}
		public function mostrar() {
			$arre = $this->modelo->getAll();
			$this->encabezados("GET",false);
			echo json_encode($arre);
		}
	}
