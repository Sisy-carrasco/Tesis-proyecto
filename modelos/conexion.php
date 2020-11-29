<?php

class Conexion{
	static public function conectar(){
//conexion con mysql
		//$link = new PDO("mysql:host=localhost;dbname=pos","root","");



		$link = new PDO("pgsql:host=localhost;port=5432;dbname=BDColegioComprensionLect", 'postgres', '123456');

		$link->exec("set names utf8");

		return $link;
	}

}