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
    <title>Tienda: Administrador</title>
</head>

<body>
    <div class="container">
        <h1>Acciones de administrador</h1>
        <ul class="list-group">
            <li class="list-group-item"> <a href="altaCategoria.php">Alta de categoría</a> </li>
            <li class="list-group-item"> <a href="altaProducto.php">Alta de producto</a> </li>
            <li class="list-group-item"> <a href="listadoPedidosCliente.php">Listado de pedidos de un cliente</a> </li>
            <li class="list-group-item"> <a href="cerrarSesion.php">Cerrar sesión</a> </li>
        </ul>
    </div>

    <script src="js/bootstrap.min.js"></script>
</body>

</html>