<?php
/**
 * Created by PhpStorm.
 * User: Alvaro
 * Date: 22/02/2018
 * Time: 17:49
 */
require_once '../conexion/Conexion.php';
require_once '../entities/Wemos.php';
require_once 'DAORele.php';
class DAOWemos {

	public function listaWemosId($idUser){
		$conn = Conexion::getPDO();
		$ordenSql = "SELECT mac,name ,state FROM wemos w, controla c WHERE w.mac = c.macWemos AND c.idUser = $idUser";
		$statement=$conn->prepare($ordenSql);
		$listaWemos=array();
		try {
			$statement->execute();
			while ($fila = $statement->fetch (PDO::FETCH_ASSOC)) {
				$wemos = new Wemos();
				$wemos->setName($fila['name']);
				$wemos->setMac($fila['mac']);
				$wemos->setState($fila['state']);
				$listaWemos[]=$wemos;
				$daoRele = new DAORele();
				foreach ($listaWemos as $key=>$wemos){
					$listaWemos[$key]->setListaReles($daoRele->listaReles($wemos->getMac()));
				}
			}
		} catch ( PDOException $e ) {
			echo $statement->errorInfo();
		}
		finally{
			$statement=NULL;
			$conn=NULL;
		}
		return $listaWemos;
	}

	public function listaWemos(){
		$conn = Conexion::getPDO();
		$ordenSql = "SELECT * FROM wemos";
		$statement=$conn->prepare($ordenSql);
		$listaWemos=array();
		try {
			$statement->execute();
			while ($fila = $statement->fetch (PDO::FETCH_ASSOC)) {
				$wemos = new Wemos();
				$wemos->setName($fila['name']);
				$wemos->setMac($fila['mac']);
				$wemos->setState($fila['state']);
				$listaWemos[]=$wemos;
				$daoRele = new DAORele();
				foreach ($listaWemos as $key=>$wemos){
					$listaWemos[$key]->setListaReles($daoRele->listaReles($wemos->getMac()));
				}
			}
		} catch ( PDOException $e ) {
			echo $statement->errorInfo();
		}
		finally{
			$statement=NULL;
			$conn=NULL;
		}
		return $listaWemos;
	}
}