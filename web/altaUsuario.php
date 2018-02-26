<?php
/**
 * Created by PhpStorm.
 * User: Alvaro
 * Date: 21/02/2018
 * Time: 11:16
 */
require_once '../entities/Wemos.php';
require_once '../entities/Rele.php';
require_once '../entities/Usuario.php';
require_once '../dao/DAORele.php';
session_start();
if(isset($_SESSION['idUsuario'])){
if($_SESSION['rol']==1){


if(isset($_SESSION['listaAllWemos'])) {
	$listaWemos = $_SESSION['listaAllWemos'];
}

$listaUsuario = $_SESSION['listaUsuario'];
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Encendido/Apagado</title>
</head>
<body>
<div class="container-fluid">
    <nav>
        <a href="controller.php?op=cerrarSesion">Cerrar Sesion</a>
    </nav>
    <br>
    <div class="container"> <a href="controller.php?op=actualizarAdmin" class="btn btn-primary">Mostrar Actualizado</a></div>
    <div class="row">

        <div class="col-md-6">
        <form action="controller.php?op=altaUsuario" method="POST" class="formulario">
            <div class="form-group">

                <label>Nombre</label>
                <input type="email" class="form-control" id="name" name="name" aria-describedby="emailHelp" required placeholder="Nombre">
                <small id="emailHelp" class="form-text text-muted">Este nombre es único (es un email)</small>
            </div>
            <div class="form-group">
                <label>Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required placeholder="Contraseña">
            </div>
            <div class="form-group">
                <label>Rol</label><br>
                <input type="radio" name="rol" value="1" required><label>Admin</label><br>
                <input type="radio" name="rol" value="0"><label>User</label>
            </div>


            <button type="submit" class="btn btn-success">Registrar</button>
            <button type="reset" class="btn btn-danger">Cancel</button>
            <br><br>


        </form>
        </div>
<br>
        <div class="col-md-4">
        <table class="table table-responsive">
            <thead>
            <tr>
            <th>
                Nombre
            </th>
            <th>
                Rol
            </th>
            </tr>
            </thead>

            <?php
            foreach ($listaUsuario as $usuario){
                if($usuario->getRol()==1){
                    $rol = "Administrador";
                }else{
	                $rol = "Usuario";
                }
            ?>
            <tbody>
            <tr>
                <td><?php echo $usuario->getName(); ?></td>
                <td><?php echo $rol; ?></td>
            </tr>
            </tbody>
            <?php
            }
            ?>
        </table><br>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
        <table class="table table-responsive">
            <thead>
            <tr>
                <th>Nombre Wemos</th>
                <th>Mac Wemos</th>
                <th>Validar</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($listaWemos as $wemo) {
	            ?>
                <tr>
                    <td><?php echo $wemo->getName();?></td>
                    <td><?php echo $wemo->getMac();?></td>
                    <?php
                    if($wemo->getValidado()=="0") {
	                    ?>
                        <td>
                            <form action="controller.php?op=validar" method="POST">
                                <input type="hidden" name="mac" value="<?php echo $wemo->getMac();?>">
                                <button class="btn btn-success">Validar</button>
                            </form>
                        </td>
	                    <?php
                    }else {
	                    ?>
                        <td>Validado</td>
	                    <?php
                    }
                    ?>
                </tr>
	            <?php
            }
            ?>
            </tbody>
        </table>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
	<?php
}else{
	header('Location: login.php');
}
}else{
	header('Location: login.php');
}
?>