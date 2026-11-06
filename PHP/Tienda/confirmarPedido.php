<?php
session_cache_limiter();
session_start();

require_once("funcionesUtiles.php");
comprobarSesionCliente();
require_once("funcionesBD.php");

////// INSERTAR PEDIDO

// Primero recuperamos el número del cliente
$numCliente = recuperarNumCliente($_SESSION["correo"]);

// Fecha de hoy del pedido
$hoy = date('Y-m-d');

$sql = "INSERT INTO `pedidos`(`NUM_PEDIDO`, `CLIENTE`, `FECHA`) VALUES (null,$numCliente,'$hoy')";

$conexion = obtenerConexion();
mysqli_query($conexion, $sql);

if (mysqli_errno($conexion) != 0) {
    $numerror = mysqli_errno($conexion);
    $descrerror = mysqli_error($conexion);

    echo "<p>Se ha producido un error numero $numerror que corresponde a: $descrerror</p>";

    echo "<p><a href='cesta.php' class='btn btn-primary'>Volver a la cesta</a></p>";
} else {

    ////// INSERTAR LÍNEAS

    // Recuperar el  NUM_PEDIDO generado automáticamente por MySQL al insertar
    // el nuevo registro de pedido
    $numPedido = mysqli_insert_id($conexion);

    // Utilizamos una sentencia preparada 
    $sentencia = $conexion->stmt_init();

    $sql = "INSERT INTO `lineas`(`NUM_PEDIDO`, `NUM_LINEA`, `COD_PRODUCTO`, `PRECIO`, `CANTIDAD`) VALUES (?,null,?,?,?)";

    $sentencia->prepare($sql);

    foreach ($_SESSION["cesta"] as $codprod => $info) {
        $sentencia->bind_param('iidi', $numPedido, $codprod, $info["precio"], $info["unidades"]);
        $sentencia->execute();
    }

    ////// ACTUALIZAR STOCK PRODUCTOS

    // Utilizamos una sentencia preparada 
    $sentencia = $conexion->stmt_init();

    $sql = "UPDATE productos SET Stock = Stock - ? WHERE CodProd = ?";

    $sentencia->prepare($sql);

    foreach ($_SESSION["cesta"] as $codprod => $info) {
        $sentencia->bind_param('ii', $info["unidades"], $codprod);
        $sentencia->execute();
    }

    ////// PEDIDO CONFIRMADO

    ////// MOSTRAMOS EL PEDIDO GRABADO
    echo '
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <title>Tienda: Pedido grabado</title>
</head>

<body>
    <div class="container">
        <h1>Pedido grabado con el número: ' . $numPedido . '</h1>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Producto</th>
                    <th>Categoría</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Total línea</th>
                </tr>
            </thead>
            <tbody>';

    $total = 0;

    foreach ($_SESSION["cesta"] as $articulo => $info) {
        $cadena = "<tr><td><img width='70' heigth='70' src='imagenes/" . $articulo . "'/></td>";
        $cadena .= "<td>" . $info["nombre"] . "</td>";
        $cadena .= "<td>" . $info["categoria"] . "</td>";
        $cadena .= "<td>" . $info["unidades"] . "</td>";
        $cadena .= "<td>" . number_format($info["precio"], 2, ',', '.') . "</td>";
        $cadena .= "<td>" . number_format($info["precio"] * $info["unidades"], 2, ',', '.') . "</td>";

        echo $cadena;

        $total = $total + $info["unidades"] * $info["precio"];
    }

    echo "<tr><td colspan='5' class='text-end fw-bold'>TOTAL DEL PEDIDO</td><td>" . number_format($total, 2, ',', '.') . "</td></tr>";

    echo '
</tbody>
</table>

<a href="clientes.php" class="btn btn-primary ms-2">Volver a menú de cliente</a>

</div>

<script src="js/bootstrap.min.js"></script>
</body>

</html>';

 ///// VACIAR LA CESTA ALMACENADA EN LA SESIÓN
 unset($_SESSION["cesta"]);

} // FIN IF PEDIDO INSERTADO
