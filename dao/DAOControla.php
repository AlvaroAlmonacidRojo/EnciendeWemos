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

	public function addControla($idUser,$macWemos){
		$conn = Conexion::getPDO();
		$ordenSql = "INSERT INTO controla (idUser,macWemos) VALUES (:idUser,:macWemos)";
		$statement=$conn->prepare($ordenSql);
		$statement->bindParam ( ':idUser',$idUser, PDO::PARAM_INT);
		$statement->bindParam ( ':macWemos',$macWemos, PDO::PARAM_STR);

		try{
			$statement->execute();
			if($statement->rowCount()>0){
				return true;
			}else{
				return false;
			}

		}catch (PDOException $e){
			echo $statement->errorInfo();
		}finally{
			$statement=NULL;
			$conn=NULL;
		}
	}
}