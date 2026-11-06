<?php
session_cache_limiter();
session_start();

require_once("funcionesUtiles.php");
comprobarSesionCliente();

extract($_GET); // $codprod, $precio, $nombre, $categoria

// Comprobar si existe la variable cesta
if (!isset($_SESSION["cesta"])) {
    $_SESSION["cesta"] = array();
}

// ¿Se ha pulsado borrar?
if (isset($borrar)) {
    unset($_SESSION["cesta"][$borrar]);
} else {
    // ¿Estaba ya el producto en la cesta?
    if (array_key_exists($codprod, $_SESSION["cesta"]))
        $_SESSION["cesta"][$codprod]["unidades"]++;
    else {
        $_SESSION["cesta"][$codprod]["precio"] = $precio;
        $_SESSION["cesta"][$codprod]["nombre"] = $nombre;
        $_SESSION["cesta"][$codprod]["categoria"] = $categoria;
        $_SESSION["cesta"][$codprod]["unidades"] = 1;
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <title>Tienda: Cesta</title>
</head>

<body>
    <div class="container">
        <h1>Cesta</h1>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Producto</th>
                    <th>Categoría</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Total línea</th>
                    <th>Borrar</th>
                </tr>
            </thead>
            <tbody>

                <?php

                $total = 0;

                foreach ($_SESSION["cesta"] as $articulo => $info) {
                    $cadena = "<tr><td><img width='70' heigth='70' src='imagenes/" . $articulo . "'/></td>";
                    $cadena .= "<td>" . $info["nombre"] . "</td>";
                    $cadena .= "<td>" . $info["categoria"] . "</td>";
                    $cadena .= "<td>" . $info["unidades"] . "</td>";
                    $cadena .= "<td>" . number_format($info["precio"], 2, ',', '.') . "</td>";
                    $cadena .= "<td>" . number_format($info["precio"] * $info["unidades"], 2, ',', '.') . "</td>";
                    $cadena .= "<td><a href=cesta.php?borrar=" . $articulo . "><img width='30' heigth='30' src='imagenes/cuboBasura.png'></a></td></tr>";

                    echo $cadena;

                    $total = $total + $info["unidades"] * $info["precio"];
                }

                echo "<tr><td colspan='6' class='text-end fw-bold'>TOTAL EN LA CESTA</td><td>" . number_format($total, 2, ',', '.') . "</td></tr>";

                ?>

            </tbody>
        </table>

        <a href='comprar.php' class='btn btn-primary'>Seguir comprando</a>
        <a href='anularCompra.php' class='btn btn-primary ms-2'>Anular compra</a>
        <a href='confirmarPedido.php' class='btn btn-primary ms-2'>Confirmar pedido</a>

    </div>

    <script src="js/bootstrap.min.js"></script>
</body>

</html>