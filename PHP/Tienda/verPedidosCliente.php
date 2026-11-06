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
        <h1>Pedidos de un cliente</h1>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Número de pedido</th>
                    <th>Número de cliente</th>
                    <th>Fecha</th>
                    <th>Detalles del pedido</th>
                </tr>
            </thead>
            <tbody>

                <?php
                // Primero recuperamos el número del cliente
                $numCliente = $_POST["lstClientes"];

                // Ahora podemos recuperar los pedidos
                $conexion = obtenerConexion();
                $sql = "SELECT * FROM pedidos WHERE CLIENTE = $numCliente";

                $resultado = mysqli_query($conexion, $sql);
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    $salida = "<tr>";
                    $salida .= "<td>" . $fila['NUM_PEDIDO'] . "</td>";
                    $salida .= "<td>" . $fila['CLIENTE'] . "</td>";
                    $salida .= "<td>" . $fila['FECHA'] . "</td>";
                    $salida .= "<td><a href='verPedido.php?pedido=" . $fila['NUM_PEDIDO'] . "&fecha=" . $fila['FECHA'] . "'>Ver</a></td>";
                    $salida .= "</tr>";

                    echo $salida;
                }

                ?>

            </tbody>
        </table>
        <a href='admin.php' class='btn btn-primary'>Vuelta al menú de administrador</a>
    </div>

    <script src="js/bootstrap.min.js"></script>
</body>

</html>