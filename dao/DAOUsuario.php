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
}