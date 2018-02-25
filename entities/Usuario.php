<?php
/**
 * Created by PhpStorm.
 * User: Alvaro
 * Date: 21/02/2018
 * Time: 10:14
 */

class Usuario {

	private $idUsuario;
	private $name;
	private $password;
	private $rol;

	/**
	 * @return mixed
	 */
	public function getIdUsuario() {
		return $this->idUsuario;
	}

	/**
	 * @param mixed $idUsuario
	 */
	public function setIdUsuario( $idUsuario ): void {
		$this->idUsuario = $idUsuario;
	}

	/**
	 * @return mixed
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param mixed $name
	 */
	public function setName( $name ): void {
		$this->name = $name;
	}

	/**
	 * @return mixed
	 */
	public function getPassword() {
		return $this->password;
	}

	/**
	 * @param mixed $password
	 */
	public function setPassword( $password ): void {
		$this->password = $password;
	}

	/**
	 * @return mixed
	 */
	public function getRol() {
		return $this->rol;
	}

	/**
	 * @param mixed $rol
	 */
	public function setRol( $rol ): void {
		$this->rol = $rol;
	}


}