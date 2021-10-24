<?php
	class Api {
		public function encabezados($metodo,$esModificacion) {
			header("Access-Control-Allow-Origin: *");
			header("Content-Type: application/json");
			if($esModificacion) {
				header("Access-Control-Allow-Methods: {$metodo}");
				header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods,"
					."Authorization,X-Requested-Width");
			}
		}
	}
