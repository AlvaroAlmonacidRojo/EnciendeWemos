<?php
/**
 * Created by PhpStorm.
 * User: Alvaro
 * Date: 21/02/2018
 * Time: 11:16
 */
require_once '../entities/Wemos.php';
require_once '../entities/Rele.php';
require_once '../dao/DAORele.php';
session_start();
if(isset($_SESSION['idUsuario'])){
    if($_SESSION['rol']==0){


if(isset($_SESSION['listaWemos'])) {
	$listaWemos = $_SESSION['listaWemos'];
}
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

	<div class="container">
        <br>
        <a href="controller.php?op=actualizar" class="btn btn-primary">Mostrar Actualizado</a>
        <button class="btn btn-info" data-toggle="modal" data-target="#exampleModalCenter">Añadir Wemos</button>

        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Nuevo Wemos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="controller.php?op=addWemos" method="POST">
                            <div class="form-group">
                            <label>Nombre</label>
                                <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" required placeholder="Nombre">
                                <small id="emailHelp" class="form-text text-muted">Este nombre es único (email)</small>
                            </div>
                            <div class="form-group">
                                <label>MAC</label>
                                <input type="text" class="form-control" id="mac" name="mac" aria-describedby="emailHelp" required placeholder="1C:1B:0D:61:1C:AE">

                            </div>
                            <label><strong>Rele 1</strong></label>
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" class="form-control" id="nameRele1" name="nameRele1" aria-describedby="emailHelp" required placeholder="Luz Patio">

                            </div>
                            <div class="form-group">
                                <label>Descripcion</label>
                                <textarea type="text" class="form-control" id="descripcionRele1" name="descripcionRele1" required></textarea>

                            </div>
                            <label><strong>Rele 2</strong></label>
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" class="form-control" id="nameRele2" name="nameRele2" aria-describedby="emailHelp" required placeholder="Luz Patio">

                            </div>
                            <div class="form-group">
                                <label>Descripcion</label>
                                <textarea type="text" class="form-control" id="descripcionRele2" name="descripcionRele2" required></textarea>

                            </div>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Registrar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>


	<div class="row" id="sectionWemos">
	<?php
	foreach ($listaWemos as $wemos) {
    if($wemos->getState()==1){
	    if($wemos->getValidado()==1){
		    $validado = "Validado";
        }else{
		    $validado = "No validado";
        }

        if($wemos->getState()==1){
	        $stateWemos = "Encendido";
	        $classWemos = "classEncendido";
        }else{
	        $stateWemos = "Apagado";
	        $classWemos = "classApagado";
        }
	?>

		<div class="col-md-12 wemos text-center">
            <h3 class="<?php echo $classWemos;?>"><?php echo $stateWemos;?></h3>
		<h2><?php echo $wemos->getName(); ?>(<?php echo $validado; ?>)</h2><br>


		<?php
		foreach ($wemos->getListaReles() as $rele){
			echo "<h4>".$rele->getName()."</h4>";

			if($rele->getState()==1){
				$state = "Encendido";
				$clase = "danger";
				$classRele = "classEncendido";
				$accion="Apagar";
				$stateValor = 0;
			}else{
				$state = "Apagado";
				$clase = "success";
				$accion = "Encender";
				$classRele = "classApagado";
				$stateValor = 1;
			}
			?>
            <p>Estado <small class="<?php echo $classRele;?>">(<?php echo $state;?>)</small></p>
			<form action="controller.php?op=changeState" method="POST">
				<input type="hidden" value="<?php echo $stateValor;?>" name="state">
				<input type="hidden" value="<?php echo $rele->getIdRele();?>" name="idRele">
            <?php
            if($validado == "No validado"){?>
                <button type="submit" class="btn btn-<?php echo $clase; ?>" disabled><?php echo $accion; ?></button>
            <?php
            }else{
                ?>
                <button type="submit" class="btn btn-<?php echo $clase; ?>"><?php echo $accion; ?></button>
                <?php
            }
			?>
			</form>


		<?php
		}}
		?>
		</div>


<?php
}
?>
	</div>
<br>
        <h2 class="text-center">Modificar Reles</h2>
		<?php
		foreach ($listaWemos as $wemos) {

		?>
        <div class="dropdown">


                <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" >
	                <?php echo $wemos->getName(); ?>
                </button>


                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <div class="dropdown-item">
                        <br>
	                    <?php
	                    foreach ($wemos->getListaReles() as $rele){
	                    ?>
                        <form action="controller.php?op=updateRele" method="POST">
                            <input type="hidden" name="idRele" value="<?php echo $rele->getIdRele();?>">
                            <input type="text" name="name" value="<?php echo $rele->getName();?>">
                            <button class="btn btn-success">Modificar</button>
                        </form>
                            <br>
		                    <?php
	                    }
	                    ?>
                    </div>

                </div>


        </div>
            <br>
			<?php
		}
		?>
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