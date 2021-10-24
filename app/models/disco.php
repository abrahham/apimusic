<?php
	class Disco {
		private $tabla = "discos";
		private $id;
		private $nombre;
		private $genero_id;
		public function __construct() {
			echo "<p>estás en el archivo de discos</p>";
		}
		public function test() {
			echo "método test ejecutado"; //borrar
		}
	}
