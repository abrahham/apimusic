<?php
	include_once "app/libs/Database.php";
	class Disco {
		private $tabla = "discos";
		public $id;
		public $nombre;
		public $artista_id;
		private $db;
		public function __construct() {
			$this->db = new Database();
		}		
		public function getAll() {
			$dbcon = $this->db->connectar();
			$query = "SELECT id,nombre FROM disco";
			$stm = $dbcon->prepare($query);	
			$stm->execute();
			$arre = $stm->fetchAll(PDO::FETCH_ASSOC);
			return $arre;
		}
		public function get() {
			$dbcon = $this->db->connectar();
			$query = "SELECT id, nombre FROM disco WHERE id = :id LIMIT 0,1";
			$stm = $dbcon->prepare($query);
			$stm->bindParam(":id",$this->id);
			$stm->execute();		
			$arre = $stm->fetch(PDO::FETCH_ASSOC);
			return $arre;
		}
		public function create() {
			$dbcon = $this->db->connectar();
			$query = "INSERT INTO disco(nombre,artista_id) VALUES(:nombre,:artista)";
			$stm = $dbcon->prepare($query);
			$stm->bindParam(":nombre",$this->nombre);
			$stm->bindParam(":artista",$this->artista_id);
			return $stm->execute();
			
		}
		public function update() {
			$dbcon = $this->db->connectar();
			$query = "UPDATE disco SET nombre = :nombre, artista_id = :artista WHERE id = :id";
			$stm = $dbcon->prepare($query);
			$stm->bindParam(":nombre",$this->nombre);
			$stm->bindParam(":artista",$this->artista_id);
			$stm->bindParam(":id",$this->id);
			return $stm->execute();
			
		}
	}
