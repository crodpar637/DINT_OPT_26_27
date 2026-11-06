<?php
session_start();
require_once("funcionesUtiles.php");
comprobarSesionCliente();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <title>Tienda: Clientes</title>
</head>

<body>
    <div class="container">
        <h1>Acciones de cliente</h1>
        <ul class="list-group">
            <li class="list-group-item"> <a href="comprar.php">Comprar</a> </li>
            <li class="list-group-item"> <a href="misPedidos.php">Mis pedidos</a> </li>
            <li class="list-group-item"> <a href="cerrarSesion.php">Cerrar sesión</a> </li>
        </ul>
    </div>

    <script src="js/bootstrap.min.js"></script>
</body>

</html>