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
	<div class="row" id="sectionWemos">
	<?php
	foreach ($listaWemos as $wemos) {

	?>

		<div class="col-md-12 wemos text-center">
		<h2><?php echo $wemos->getName(); ?></h2><br>


		<?php
		foreach ($wemos->getListaReles() as $rele){
			echo "<h4>".$rele->getName()."</h4>";

			if($rele->getState()==1){
				$state = "Encendido";
				$clase = "danger";
				$accion="Apagar";
				$stateValor = 0;
			}else{
				$state = "Apagado";
				$clase = "success";
				$accion = "Encender";
				$stateValor = 1;
			}
			?>
			<p>Estado (<?php echo $state;?>)</p>
			<form action="controller.php?op=changeState" method="POST">
				<input type="hidden" value="<?php echo $stateValor;?>" name="state">
				<input type="hidden" value="<?php echo $rele->getIdRele();?>" name="idRele">
			<button type="submit" class="btn btn-<?php echo $clase; ?>"><?php echo $accion; ?></button>
			</form>


		<?php
		}
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