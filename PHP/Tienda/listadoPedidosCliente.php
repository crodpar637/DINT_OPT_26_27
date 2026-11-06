<?php
session_start();
require_once("funcionesUtiles.php");
comprobarSesionAdmin();

require_once("funcionesBD.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <title>Tienda: Pedidos de un cliente</title>
</head>

<body>
    <div class="container">
        <form name="frmPedidosCliente" id="frmPedidosCliente" action="verPedidosCliente.php" method="POST">
            <legend>Ver pedidos de un cliente</legend>
            <div class="col-md-6 mb-3">
                <label for="lstClientes" class="form-label">Clientes</label>
                <select name="lstClientes" id="lstClientes" class="form-select">
                    <?php
                    $conexion = obtenerConexion();

                    $array_opciones = obtenerArrayOpciones('clientes', 'NUM_CLIENTE', 'Nombre');

                    foreach ($array_opciones as $indice => $valor) {
                        echo "<option value='" . $indice . "'>" . $valor . "</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Aceptar</button>
        </form>
    </div>

    <script src="js/bootstrap.min.js"></script>
</body>

</html>