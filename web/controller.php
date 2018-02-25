<?php
/**
 * Created by PhpStorm.
 * User: Alvaro
 * Date: 21/02/2018
 * Time: 10:28
 */
require_once '../dao/DAOUsuario.php';
require_once '../entities/Usuario.php';
require_once '../dao/DAOControla.php';
require_once '../entities/Wemos.php';
require_once '../dao/DAORele.php';
require_once '../dao/DAOWemos.php';
session_start();

$op = $_REQUEST['op'];
$daoUsuario = new DAOUsuario();
$daoWemos = new DAOWemos();
$daoRele = new DAORele();
switch ($op){
	case "inicio":
		$_SESSION['isLogin']="";
		header('Location: login.php');
		break;
	case "login":
		$name = $_REQUEST['name'];
		$password = $_REQUEST['password'];

		if($usuario = $daoUsuario->login($name,$password)){

			$_SESSION['idUsuario']=$usuario->getIdUsuario();
			$_SESSION['nombreUsuario']=$usuario->getName();
			unset($_SESSION['errorLogin']);
			$_SESSION['rol']=$usuario->getRol();
			if($usuario->getRol()==1){
				header('Location:altawemos.php');
			}else{
				$listaWemos = $daoWemos->listaWemosId($_SESSION['idUsuario']);
				$_SESSION['listaWemos'] = $listaWemos;
				header('Location: mainview.php');
			}


		}else{
			$_SESSION['errorLogin']="Si";
			header('Location:login.php');
		}

		break;

	case "cerrarSesion":
		if(isset($_SESSION['idUsuario'])){
			session_destroy();
			header('Location: login.php');
		}
		break;

	case "changeState":
		$state = $_REQUEST['state'];
		$idRele = $_REQUEST['idRele'];

		if($daoRele->updateState($state,$idRele)){
			$listaWemos = $daoWemos->listaWemosId($_SESSION['idUsuario']);
			$_SESSION['listaWemos'] = $listaWemos;
			header('Location: mainview.php');
		}

		break;

	case "updateRele":
		$idRele = $_REQUEST['idRele'];
		$name = $_REQUEST['name'];;

		if($daoRele->updateNameRele($idRele,$name)){
			$listaWemos = $daoWemos->listaWemosId($_SESSION['idUsuario']);
			$_SESSION['listaWemos'] = $listaWemos;
			header('Location: mainview.php');
		}
		break;

	case "actualizar":
		$listaWemos = $daoWemos->listaWemosId($_SESSION['idUsuario']);
		$_SESSION['listaWemos'] = $listaWemos;
		header('Location: mainview.php');
		break;

	case "loadWemos":
		header('Location:loadWemos.php');
		break;
}
