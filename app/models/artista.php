<?php
	include_once "app/libs/Database.php";
	class Artista {
		private $tabla = "artista"; //cambiar a artistas
		public $id;
		public $nombre;
		private $db;
		public function __construct() {
			$this->db = new Database();
		}
		public function getAll() {
			$dbcon = $this->db->connectar();
			$query = "SELECT id, nombre FROM {$this->tabla}";
			$stm = $dbcon->prepare($query);
			$stm->execute();
			$arre = $stm->fetchAll(PDO::FETCH_ASSOC);
			return $arre;
		}
		public function get() {
			$dbcon = $this->db->connectar();
			$query = "SELECT id, nombre FROM {$this->tabla} WHERE id = :id LIMIT 0,1";
			$stm = $dbcon->prepare($query);
			$stm->bindParam(":id",$this->id);
			$stm->execute();
			$arre = $stm->fetch(PDO::FETCH_ASSOC);
			return $arre;
		}
		public function create() {
			$dbcon = $this->db->connectar();
			$query = "INSERT INTO {$this->tabla}(nombre) VALUES(:nombre)";
			$stm = $dbcon->prepare($query);
			$stm->bindParam(":nombre",$this->nombre);
			return $stm->execute();		
		}
		public function update() {
			$dbcon = $this->db->connectar();
			$query = "UPDATE {$this->tabla} SET nombre = :nombre WHERE id = :id";
			$stm = $dbcon->prepare($query);
			$stm->bindParam(":nombre",$this->nombre);
			$stm->bindParam(":id",$this->id);
			return $stm->execute();	
		}
		public function delete() {
			$dbcon = $this->db->connectar();
			$query = "DELETE FROM {$this->tabla} WHERE id = :id";
			$stm = $dbcon->prepare($query);
			$stm->bindParam(":id",$this->id);
			return $stm->execute();
		}
	}
