<?php
session_start();
require_once("funcionesUtiles.php");
comprobarSesionAdmin();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <title>Tienda: Alta categoría</title>
</head>

<body>
    <div class="container">
        <form name="frmAltaCategoria" id="frmAltaCategoria" action="procesoAltaCategoria.php" method="POST">
            <legend>Alta de categoría</legend>
            <div class="col-md-6 mb-3">
                <label for="txtNombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="txtNombre" name="txtNombre" placeholder="Introduzca el nombre de la categoría" maxlength="45" size="50"/>
            </div>
            <div class="col-md-6 mb-3">
                <label for="txtDescripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="txtDescripcion" name="txtDescripcion" maxlength="200" rows="4" placeholder="Introduzca una descripción"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Aceptar</button>
        </form>
    </div>

    <script src="js/bootstrap.min.js"></script>
</body>

</html>