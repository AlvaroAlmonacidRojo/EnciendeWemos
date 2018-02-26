<?php
/**
 * Created by PhpStorm.
 * User: Alvaro
 * Date: 26/02/2018
 * Time: 16:15
 */
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
<div class="row">



		<div class="col-md-3"></div>
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

	        <input type="hidden" name="rol" value="0" required>




            <button type="submit" class="btn btn-success">Registrar</button>
            <button type="reset" class="btn btn-danger">Cancel</button>
            <br><br>


        </form>
        </div>
</div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>