<?php
/**
 * Created by PhpStorm.
 * User: Alvaro
 * Date: 21/02/2018
 * Time: 17:18
 */

class Wemos {
	private $mac;
	private $name;
	private $state;
	private $lastMessage;
	private $validado;
	private $listaReles = array();

	/**
	 * @return mixed
	 */
	public function getMac() {
		return $this->mac;
	}

	/**
	 * @param mixed $mac
	 */
	public function setMac( $mac ): void {
		$this->mac = $mac;
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
	public function getState() {
		return $this->state;
	}

	/**
	 * @param mixed $state
	 */
	public function setState( $state ): void {
		$this->state = $state;
	}

	/**
	 * @return mixed
	 */
	public function getListaReles() {
		return $this->listaReles;
	}

	/**
	 * @param mixed $listaReles
	 */
	public function setListaReles( $listaReles ): void {
		$this->listaReles = $listaReles;
	}

	/**
	 * @return mixed
	 */
	public function getLastMessage() {
		return $this->lastMessage;
	}

	/**
	 * @param mixed $lastMessage
	 */
	public function setLastMessage( $lastMessage ): void {
		$this->lastMessage = $lastMessage;
	}

	/**
	 * @return mixed
	 */
	public function getValidado() {
		return $this->validado;
	}

	/**
	 * @param mixed $validado
	 */
	public function setValidado( $validado ): void {
		$this->validado = $validado;
	}



}