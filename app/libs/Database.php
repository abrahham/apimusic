<?php
	class Database {
		private $host;
		private $dbname;
		private $usr;
		private $contr;
		private $con;
		public function __construct() {
			$this->host = .env("host");
			$this->dbname = .env("dbname");
			$this->usr = .env("usr");
			$this->contr = .env("contr");
		}		
		public function connectar() {
			$this->con = null;
			try {
				$this->con = new PDO(
					"mysql:host={$this->host};dbname={$this->dbname};",$this->usr,$this->contr
				);
				$this->con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			} catch(PDOException $e) {
				echo $e->getMessage();
			}
			return $this->con;
		}
	}
