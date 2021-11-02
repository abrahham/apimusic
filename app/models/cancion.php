<?php
	include_once "app/libs/Database.php";
	class Cancion {
		private $tabla = "cancion";//cambiar a canciones
		public $id;
		public $nombre;
		public $duracion;
		public $disco_id;
		public $disco_nombre;
		private $db;
		public function __construct() {
			$this->db = new Database();	
		}
		public function create() {
			$dbcon = $this->db->connectar();
			$query = "INSERT INTO {$this->tabla}(nombre,artista_id,disco_id) VALUES (:nombre,:artista,:disco)";
			$stm = $dbcon->prepare($query);
			$stm->bindParam(":nombre",$this->nombre);
			$stm->bindParam(":artista",$this->artista_id);
			$stm->bindParam(":disco",$this->disco_id);
			return $stm->execute();
		}
		public function update() {
			$dbcon = $this->db->connectar();
			$query = "UPDATE {$this->tabla} SET nombre = :nombre, artista_id = :artista, disco_id = :disco WHERE id = :id";
			$stm = $dbcon->prepare($query);
			$stm->bindParam(":nombre",$this->nombre);
			$stm->bindParam(":artista", $this->artista_id);
			$stm->bindParam(":disco", $this->disco_id);
			$stm->bindParam(":id", $this->id);
			return $stm->execute();
		}
		public function delete() {
			$dbcon = $this->db->connectar();
			$query = "DELETE FROM {$this->tabla} WHERE id = :id";
			$stm = $dbcon->prepare($query);
			$stm->bindParam(":id", $this->id);
			return $stm->execute();
		}
		public function get() {
			$dbcon = $this->db->connectar();
			$query = "SELECT id, nombre, artista_id, (SELECT nombre FROM disco WHERE id = ta.artista_id) AS anombre,"
				."disco_id, (SELECT nombre FROM artista WHERE id = ta.artista_id) AS dnombre FROM {$this->tabla} AS ta"
				." WHERE id = :id LIMIT 0,1";
			$stm = $dbcon->prepare($query);
			$stm->bindParam(":id",$this->id);
			$stm->execute();
			$arre = $stm->fetch(PDO::FETCH_ASSOC);
			return array(
				"id" => $arre["id"], "nombre" => $arre["nombre"],
				"disco" => array("id" => $arre["disco_id"], "nombre" => $arre["dnombre"]),
				"artista" => array("id" => $arre["artista_id"], "nombre" => $arre["anombre"])	
			);
		}
		public function getAll() {
			$dbcon = $this->db->connectar();
			$query = "SELECT id, nombre, disco_id, (SELECT nombre FROM disco WHERE id = ta.disco_id) AS dnombre,"
				."artista_id, (SELECT nombre FROM artista WHERE id = ta.artista_id) AS anombre FROM {$this->tabla} AS ta";
			$stm = $dbcon->prepare($query);
			$stm->execute();
			$arre = [];
			while($data = $stm->fetch(PDO::FETCH_ASSOC)) {
				array_push($arre,array(
					"id" => $data["id"], "nombre" => $data["nombre"],
					"disco" => array("id" => $data["disco_id"], "nombre" => $data["dnombre"]),
					"artista" => array("id" => $data["artista_id"], "nombre" => $data["anombre"])	
				));
			}
			return $arre;
		}
	}	
