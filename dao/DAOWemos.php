<?php
/**
 * Created by PhpStorm.
 * User: Alvaro
 * Date: 22/02/2018
 * Time: 17:49
 */
require_once '../conexion/Conexion.php';
require_once '../entities/Wemos.php';
require_once '../entities/Rele.php';
require_once 'DAORele.php';
require_once 'DAOControla.php';
class DAOWemos {

	public function listaWemosId($idUser){
		$conn = Conexion::getPDO();
		$ordenSql = "SELECT mac,name ,state,lastMessage,validado FROM wemos w, controla c WHERE w.mac = c.macWemos AND c.idUser = $idUser";
		$statement=$conn->prepare($ordenSql);
		$listaWemos=array();
		try {
			$statement->execute();
			while ($fila = $statement->fetch (PDO::FETCH_ASSOC)) {
				$wemos = new Wemos();
				$wemos->setName($fila['name']);
				$wemos->setMac($fila['mac']);
				$wemos->setState($fila['state']);
				$wemos->setLastMessage($fila['lastMessage']);
				$wemos->setValidado($fila['validado']);
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
				$wemos->setLastMessage($fila['lastMessage']);
				$wemos->setValidado($fila['validado']);
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

	public function addWemos($wemos,$idUser,$rele1,$rele2){

		$conn = Conexion::getPDO();
		$ordenSql = "INSERT INTO wemos (mac,name,state,validado) VALUES (:mac,:name,0,0)";
		$statement=$conn->prepare($ordenSql);
		$statement->bindParam ( ':mac',$wemos->getMac(), PDO::PARAM_STR);
		$statement->bindParam ( ':name',$wemos->getName(), PDO::PARAM_STR);


		try{
			$statement->execute();
			if($statement->rowCount()>0){
				$daoRele = new DAORele();
				if($daoRele->addRele($rele1) && $daoRele->addRele($rele2)){
					$daoControla = new DAOControla();
					if($daoControla->addControla($idUser,$wemos->getMac())){
						return true;
					}
				}
			}else{
				return false;
			}

		}catch (PDOException $e){
			throw ($e);
			echo $statement->errorInfo();
		}finally{
			$statement=NULL;
			$conn=NULL;
		}
	}

	public function validarWemos($mac){

		$valido = 1;
		$conn = Conexion::getPDO();
		$ordenSql = "UPDATE wemos SET validado = :validado WHERE mac = '$mac'";
		$statement=$conn->prepare($ordenSql);
		$statement->bindParam ( ':validado',$valido, PDO::PARAM_INT);

		try{
			$statement->execute();
			if($statement->rowCount()>0){
				return true;
			}else{
				return false;
			}

		}catch (PDOException $e){
			throw ($e);
			echo $statement->errorInfo();
		}finally{
			$statement=NULL;
			$conn=NULL;
		}
	}
}