<?php
/**
 * Created by PhpStorm.
 * User: Alvaro
 * Date: 21/02/2018
 * Time: 17:58
 */

class Rele {
	private $idRele;
	private $description;
	private $state;
	private $macWemos;
	private $name;

	/**
	 * @return mixed
	 */
	public function getIdRele() {
		return $this->idRele;
	}

	/**
	 * @param mixed $idRele
	 */
	public function setIdRele( $idRele ): void {
		$this->idRele = $idRele;
	}

	/**
	 * @return mixed
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * @param mixed $description
	 */
	public function setDescription( $description ): void {
		$this->description = $description;
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
	public function getMacWemos() {
		return $this->macWemos;
	}

	/**
	 * @param mixed $macWemos
	 */
	public function setMacWemos( $macWemos ): void {
		$this->macWemos = $macWemos;
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


}