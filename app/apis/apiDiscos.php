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
		public function agregar() {
			$this->encabezados("POST",true);
			$data = json_decode(file_get_contents("php://input"), true);
			$this->modelo->nombre = $data["nombre"];
			$this->modelo->artista_id = $data["artistaId"];
			$res = $this->modelo->create();
			echo json_encode(($res)
					? array("mensaje" => "Se ha agregado el disco.") 
					: array("mensaje" => "Ha habido problemas al intentar agregar el disco dado.")
			);
		}
		public function cambiar() {
			$this->encabezados("PUT",true);
			$data = json_decode(file_get_contents("php://input"), true);
			$this->modelo->id = $data["id"];			
			$this->modelo->nombre = $data["nombre"];
			$this->modelo->artista_id = $data["artistaId"];
			$res = $this->modelo->update();
			echo json_encode(($res)
					? array("mensaje" => "Se ha modificado el disco.") 
					: array("mensaje" => "Ha habido problemas al intentar modificar el disco dado.")
			);
		}
		public function eliminar($id) {
			$this->encabezados("DELETE",true);
			$this->modelo->id = $id;
			$res = $this->modelo->delete();
			echo json_encode(($res)
					? array("mensaje" => "Se ha eliminado el disco.") 
					: array("mensaje" => "Ha habido problemas al intentar eliminar el disco dado.")
			);
		}
	}
