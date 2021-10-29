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
			$data = json_decode(file_get_contents("php://input"),true);
			$this->modelo->nombre = $data["nombre"];
			$res = $this->modelo->create();
			$this->encabezados("POST",true);
			echo json_encode(($res)
				? array("mensaje" => "Se ha agregado el artista dado.")
				: array("mensaje" => "Ha habido problemas al tratar de registrar el artista dado.")
			);
		}
		public function cambiar() {
			$data = json_decode(file_get_contents("php://input"),true);
			$this->modelo->id = $data["id"];
			$this->modelo->nombre = $data["nombre"];
			$res = $this->modelo->update();
			$this->encabezados("PUT",true);
			echo json_encode(($res)
				? array("mensaje" => "Se ha modificado el artista dado.")
				: array("mensaje" => "Ha habido problemas al tratar de modificar el artista dado.")
			);
		}
		public function eliminar($id) {
			$this->modelo->id = $id;
			$res = $this->modelo->delete();
			$this->encabezados("DELETE",true);
			$res = $this->modelo->delete();
			echo json_encode(($res)
				? array("mensaje" => "Se ha eliminado el artista dado.")
				: array("mensaje" => "Ha habido problemas al tratar de eliminar el artista dado.")
			);
		}
	}
