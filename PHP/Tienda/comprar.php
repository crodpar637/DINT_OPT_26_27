<?php
session_cache_limiter();
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
    <title>Tienda: Comprar</title>
</head>

<body>
    <div class="container">
        <h1>Comprar</h1>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Producto</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th>Añadir</th>
                </tr>
            </thead>
            <tbody>

                <?php

                $conexion = obtenerConexion();

                // Ahora recuperamos los productos

                $sql = "SELECT p.CodProd AS codprod, p.Nombre AS nombre, p.precio, c.Nombre as categoria FROM productos AS p, categoria AS c WHERE p.CodCat = c.CodCat AND Stock > 0;";

                $resultado = mysqli_query($conexion, $sql);
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    $salida = "<tr>";
                    $salida .= "<td><img width='70' heigth='70' src='imagenes/" . $fila['codprod'] . "'/></td>";
                    $salida .= "<td>" . $fila['nombre'] . "</td>";
                    $salida .= "<td>" . $fila['categoria'] . "</td>";
                    $salida .= "<td>" . number_format($fila['precio'], 2, ',', '.') . "</td>";
                    $salida .= "<td><a href='cesta.php?codprod=" . $fila['codprod'] . "&nombre=" . $fila['nombre'] . "&precio=" . $fila['precio'] . "&categoria=" . $fila['categoria'] . "' class='btn btn-success'>Añadir al carrito</a></td>";
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