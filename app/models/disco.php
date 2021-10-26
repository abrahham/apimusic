<?php
	include_once "app/libs/Database.php";
	class Disco {
		private $tabla = "discos";
		public $id;
		public $nombre;
		public $genero_id;
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
	}
