<?php
session_start();
require_once("funcionesUtiles.php");
comprobarSesionCliente();

require_once("funcionesBD.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <title>Tienda: Mis pedidos</title>
</head>

<body>
    <div class="container">
        <h1>Mis pedidos</h1>

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
                $numCliente = recuperarNumCliente($_SESSION["correo"]);

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
        <a href='clientes.php' class='btn btn-primary'>Vuelta al menú de cliente</a>
    </div>

    <script src="js/bootstrap.min.js"></script>
</body>

</html>