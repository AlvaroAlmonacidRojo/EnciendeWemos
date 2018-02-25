<?php
/**
 * Created by PhpStorm.
 * User: Alvaro
 * Date: 25/02/2018
 * Time: 9:53
 */
require_once '../entities/Rele.php';
require_once '../entities/Wemos.php';
require_once '../dao/DAOWemos.php';
require_once '../dao/DAORele.php';
session_start();
if(isset($_SESSION['listaWemos'])) {
	$listaWemos = $_SESSION['listaWemos'];
}
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