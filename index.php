<?php
	require "vendor/autoload.php";
	include_once 'app/app.php';
	$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
	$dotenv->load();
	$app = new App();
