<?php
	class App {
		private $url;
		private $api;
		private $metodo;
		private $param;
		private $seccionesValidas = ["discos","artistas","canciones"];
		public function __construct() {
			$params = $this->dividirURL($_GET["url"]);		
			include_once "apis/api{$params['seccion']}.php";
			$this->api = "Api{$params['seccion']}";
			$this->api = new $this->api();
			$this->metodo = $params["metodo"];
			//$this->api->{$this->metodo}();			
			if($this->metodo == "ver") {
				$this->param = $params["parametro"];
				$this->api->{$this->metodo}($this->param);
			} else $this->api->{$this->metodo}();
		}
		public function dividirURL($url) {
			$url =  isset($_GET['url']) ? $_GET['url'] : "artistas";
			$url = strtolower(trim($url));
			$params = explode("/",$url);
			if(count($params) > 0) {
				$arreURL = array();
				if(isset($params[0]) && in_array($params[0],$this->seccionesValidas))
					$arreURL["seccion"] = ucfirst($params[0]);
				if(isset($params[1]))
					$arreURL["metodo"] = $params[1];
				if(isset($params[2]))
					$arreURL["parametro"] = $params[2];
				return $arreURL;
			} else return array("seccion" => "artistas", "metodo" => "ver");
		}
	}
