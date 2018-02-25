<?php
/**
 * Created by PhpStorm.
 * User: Alvaro
 * Date: 21/02/2018
 * Time: 17:58
 */
require_once '../conexion/Conexion.php';
require_once '../entities/Rele.php';
class DAORele {

	public function listaReles($macWemos){
			$conn = Conexion::getPDO();
			$ordenSql = "SELECT * FROM rele WHERE macWemos= '$macWemos'";
			$statement=$conn->prepare($ordenSql);
			$listaReles=array();
			try {
				$statement->execute();
				while ($fila = $statement->fetch (PDO::FETCH_ASSOC)) {
					$rele = new Rele();
					$rele->setIdRele($fila['idRele']);
					$rele->setDescription($fila['description']);
					$rele->setState($fila['state']);
					$rele->setMacWemos($fila['macWemos']);
					$rele->setName($fila['name']);
					$listaReles[]=$rele;
				}
			} catch ( PDOException $e ) {
				throw ($e);
				echo $statement->errorInfo();
			}
			finally{
				$statement=NULL;
				$conn=NULL;
			}
			return $listaReles;

	}

	public function updateState($state,$idRele){
		$conn = Conexion::getPDO();
		$ordenSql = "UPDATE rele SET state = $state WHERE idRele=$idRele";
		$statement=$conn->prepare($ordenSql);
		try {
			$statement->execute();
			if($statement->rowCount()>0) {
				return true;
			}else{
				return false;
			}
		} catch ( PDOException $e ) {
			throw ($e);
			echo $statement->errorInfo();
		}
		finally{
			$statement=NULL;
			$conn=NULL;
		}

	}

	public function updateNameRele($idRele,$name){
		$conn = Conexion::getPDO();
		$ordenSql = "UPDATE rele SET name = '$name' WHERE idRele=$idRele";
		$statement=$conn->prepare($ordenSql);
		try {
			$statement->execute();
			if($statement->rowCount()>0) {
				return true;
			}else{
				return false;
			}
		} catch ( PDOException $e ) {
			throw ($e);
			echo $statement->errorInfo();
		}
		finally{
			$statement=NULL;
			$conn=NULL;
		}

	}
}