<?php
/**
 * Created by PhpStorm.
 * User: Alvaro
 * Date: 21/02/2018
 * Time: 17:14
 */
require_once '../conexion/Conexion.php';
require_once '../entities/Wemos.php';
class DAOControla {

	public function getMacs($idUser){
		$conn = Conexion::getPDO();
		$ordenSql = "SELECT mac,name ,state FROM wemos w, controla c WHERE w.mac = c.macWemos AND c.idUser = $idUser";
		$statement=$conn->prepare($ordenSql);
		$listaMacs=array();
		try {
			$statement->execute();
			while ($fila = $statement->fetch (PDO::FETCH_ASSOC)) {
				$wemos = new Wemos();
				$wemos->setName($fila['name']);
				$wemos->setMac($fila['mac']);
				$wemos->setState($fila['state']);
				$listaMacs[]=$wemos;
			}
		} catch ( PDOException $e ) {
			echo $statement->errorInfo();
		}
		finally{
			$statement=NULL;
			$conn=NULL;
		}
		return $listaMacs;
	}
}