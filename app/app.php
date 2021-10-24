<?php
	class App {
		private $url;
		private $seccion;
		private $metodo;
		private $seccionesValidas = ["discos","artistas","canciones"];
		private $rModelos = array(
			"discos" => "disco", "artistas" => "artista",
			"canciones" => "cancion"
		);
		public function __construct() {
			$url =  isset($_GET['url']) ? $_GET['url'] : "artistas";
			$url = strtolower(trim($url));
			$params = explode("/",$url);
			if(in_array($params[0],$this->seccionesValidas)) {			
				$this->seccion = $params[0];
				$this->seccion = ucfirst($this->seccion);
				include_once "apis/api{$this->seccion}.php";
				$this->seccion = $this->rModelos[$params[0]];
				include_once "models/{$this->seccion}.php";
				$this->seccion = new $this->seccion();
			}
			if(isset($params[1])) {
				$this->metodo = $params[1];
				$this->seccion->{$this->metodo}();
			}
			//url
			echo "<br>Url:<br>";
			var_dump($url);
		}
	}
