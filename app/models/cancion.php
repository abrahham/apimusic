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
		public function getAll() {
			$dbcon = $this->db->connectar();
			$query = "SELECT id,nombre,artista_id,disco_id FROM {$this->tabla}";
			$stm = $dbcon->prepare($query);
			$stm->execute();
			$arre = $stm->fetchAll(PDO::FETCH_ASSOC);
			return $arre;
		}
	}
