<?php
/**
 * Created by PhpStorm.
 * User: Alvaro
 * Date: 21/02/2018
 * Time: 10:16
 */

require_once '../conexion/Conexion.php';
require_once '../entities/Usuario.php';

class DAOUsuario {

	public function getUsuario($name){
		$conn = Conexion::getPDO();
		$ordenSql = "SELECT usuario WHERE name=:name";
		$statement=$conn->prepare($ordenSql);
		$statement->bindParam ( ':name',$name, PDO::PARAM_STR);
		$usuario = NULL;
		try {
			$statement->execute();
			if($fila = $statement->fetch (PDO::FETCH_ASSOC)) {
				$usuario = new Usuario();
				$usuario->setIdUsuario($fila['idUsuario']);
				$usuario->setName($fila['name']);
				$usuario->setPassword($fila['password']);
				$usuario->setRol($fila['rol']);
			}
		} catch ( PDOException $e ) {
			echo $statement->errorInfo();
		}
		finally{
			$statement=NULL;
			$conn=NULL;
		}
		return $usuario;
	}

	public function login($name,$password){
		$conn = Conexion::getPDO();
		$ordenSql = "SELECT * FROM usuario WHERE name=:name AND password=:password";
		$statement=$conn->prepare($ordenSql);
		$statement->bindParam ( ':name',$name, PDO::PARAM_STR);
		$statement->bindParam ( ':password',$password, PDO::PARAM_STR);
		$usuario = null;
		try {
			$statement->execute();
			if($fila = $statement->fetch (PDO::FETCH_ASSOC)) {
				$usuario = new Usuario();
				$usuario->setRol($fila['rol']);
				$usuario->setPassword($fila['password']);
				$usuario->setIdUsuario($fila['idUsuario']);
				$usuario->setName($fila['name']);

				return $usuario;
			}
		} catch ( PDOException $e ) {
			throw ($e);
			echo $statement->errorInfo();
		}
		finally{
			$statement=NULL;
			$conn=NULL;
		}

		return $usuario;
	}

	public function insertUser($user){

		$conn = Conexion::getPDO();
		$ordenSql = "INSERT INTO usuario (name,password,rol) VALUES (:name,:password,:rol)";
		$statement=$conn->prepare($ordenSql);
		$statement->bindParam ( ':name',$user->getName(), PDO::PARAM_STR);
		$statement->bindParam ( ':password',$user->getPassword(), PDO::PARAM_STR);
		$statement->bindParam(':rol',$user->getRol(),PDO::PARAM_INT);

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

	public function listaUsuario(){
		$conn = Conexion::getPDO();
		$ordenSql = "SELECT * FROM usuario ORDER BY name";
		$statement=$conn->prepare($ordenSql);
		$listaUsuarios=array();
		try {
			$statement->execute();
			while ($fila = $statement->fetch (PDO::FETCH_ASSOC)) {
				$usuario = new Usuario();
				$usuario->setRol($fila['rol']);
				$usuario->setPassword($fila['password']);
				$usuario->setName($fila['name']);
				$usuario->setIdUsuario($fila['idUsuario']);
				$listaUsuarios[]=$usuario;

			}
		} catch ( PDOException $e ) {
			echo $statement->errorInfo();
		}
		finally{
			$statement=NULL;
			$conn=NULL;
		}
		return $listaUsuarios;
	}
}