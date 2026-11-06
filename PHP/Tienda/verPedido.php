<?php
session_start();
require_once("funcionesUtiles.php");
comprobarSesionClienteOAdmin();

require_once("funcionesBD.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <title>Tienda: Ver pedido</title>
</head>

<body>
    <div class="container">
        <h1>Ver pedido</h1>
        <?php
        $pedido = $_GET["pedido"];
        $fecha = $_GET["fecha"];

        echo "<h4>Número de pedido: $pedido   Fecha: $fecha</h4>";
        ?>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Número de línea</th>
                    <th>Imagen</th>
                    <th>Producto</th>
                    <th>Categoría</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>

                <?php
                // Recuperamos las líneas del pedido
                $conexion = obtenerConexion();

                $sql = "SELECT l.NUM_LINEA, pr.CodProd, pr.Nombre, l.PRECIO, l.CANTIDAD, c.Nombre AS CATEGORIA
                FROM lineas AS l, productos AS pr, categoria AS c 
                WHERE l.COD_PRODUCTO = pr.CodProd AND pr.CodCat = c.CodCat AND l.NUM_PEDIDO = $pedido;";

                $total = 0;

                $resultado = mysqli_query($conexion, $sql);
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    $salida = "<tr>";
                    $salida .= "<td>" . $fila['NUM_LINEA'] . "</td>";
                    $salida .= "<td><img width='70' heigth='70' src='imagenes/" . $fila['CodProd'] . "'/></td>";
                    $salida .= "<td>" . $fila['Nombre'] . "</td>";
                    $salida .= "<td>" . $fila['CATEGORIA'] . "</td>";
                    $salida .= "<td>" . $fila['CANTIDAD'] . "</td>";
                    $salida .= "<td>" . number_format($fila['PRECIO'], 2, ',', '.') . "</td>";
                    $salida .= "</tr>";

                    echo $salida;

                    $total = $total + $fila['CANTIDAD'] * $fila['PRECIO'];
                }

                echo "<tr><td colspan='5' class='text-end fw-bold'>TOTAL</td><td>" . number_format($total, 2, ',', '.') . "</td></tr>";

                ?>

            </tbody>
        </table>

        <?php
        if ($_SESSION["conectado"] == "cliente") {
            echo "<a href='misPedidos.php' class='btn btn-primary'>Vuelta a mis pedidos</a>";
            echo "<a href='clientes.php' class='btn btn-primary ms-2'>Vuelta al menú de cliente</a>";
        } else {
            echo "<a href='listadoPedidosCliente.php' class='btn btn-primary'>Listado de pedidos de un cliente</a>";
            echo "<a href='admin.php' class='btn btn-primary ms-2'>Vuelta al menú de administrador</a>";
        }
        ?>

    </div>

    <script src="js/bootstrap.min.js"></script>
</body>

</html>