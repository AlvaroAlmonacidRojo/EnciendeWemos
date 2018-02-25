<?php
/**
 * Created by PhpStorm.
 * User: Alvaro
 * Date: 21/02/2018
 * Time: 10:13
 */

class Conexion {
	public static function getPDO(){
		$dbhost = "localhost";
		$dbuser = "root";
		$dbpass = "";
		$dbname = "wemos";
		$dns = "mysql:host={$dbhost};dbname={$dbname}";
		try{
			$pdo=new PDO($dns, $dbuser, $dbpass,array(PDO::ATTR_PERSISTENT=>true));
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$pdo->prepare("SET NAMES 'utf8'");
			return $pdo;
		}catch(PDOException $e) {
			echo $e->getMessage();
		}finally {
			$pdo = NULL;
		}
	}
}