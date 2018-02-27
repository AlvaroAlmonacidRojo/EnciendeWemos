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
				$_SESSION['listaUsuario']=$daoUsuario->listaUsuario();
				$_SESSION['listaAllWemos']=$daoWemos->listaWemos();
				header('Location:altaUsuario.php');
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

	case "actualizarAdmin":
		$_SESSION['listaAllWemos'] = $daoWemos->listaWemos();
		header('Location: altaUsuario.php');
		break;


	case "altaUsuario":
		$name = $_REQUEST['name'];
		$password = $_REQUEST['password'];
		$rol = intval($_REQUEST['rol']);

		$user = new Usuario();
		$user->setName($name);
		$user->setPassword($password);
		$user->setRol($rol);

		if($daoUsuario->insertUser($user)){
			$_SESSION['usuarioAdd']="El usuario se ha añadido correctamente";
			$_SESSION['listaUsuario']=$daoUsuario->listaUsuario();
			header('Location: altaUsuario.php');
		}
		break;


	case "addWemos":
		$name = $_REQUEST['name'];
		$mac = $_REQUEST['mac'];
		$nameRele1 = $_REQUEST['nameRele1'];
		$descripcionRele1 = $_REQUEST['descripcionRele1'];
		$nameRele2 = $_REQUEST['nameRele2'];
		$descripcionRele2 = $_REQUEST['descripcionRele2'];

		$wemo = new Wemos();
		$wemo->setName($name);
		$wemo->setMac($mac);

		$rele1 = new Rele();
		$rele1->setName($nameRele1);
		$rele1->setDescription($descripcionRele1);
		$rele1->setMacWemos($mac);

		$rele2 = new Rele();
		$rele2->setName($nameRele2);
		$rele2->setDescription($descripcionRele2);
		$rele2->setMacWemos($mac);

		if($daoWemos->addWemos($wemo,$_SESSION['idUsuario'],$rele1,$rele2)){
			$listaWemos = $daoWemos->listaWemosId($_SESSION['idUsuario']);
			$_SESSION['listaWemos'] = $listaWemos;
			header('Location: mainview.php');
		}else{

		}

		break;

	case "validar":
		$mac= $_REQUEST['mac'];

		if($daoWemos->validarWemos($mac)){
			$_SESSION['listaAllWemos']=$daoWemos->listaWemos();
			header('Location: altaUsuario.php');
		}
		break;
}
