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
    <title>Tienda: Alta categoría</title>
</head>

<body>
    <div class="container">

        <h4>Procesar el alta de categoría</h4>

        <?php
        $nombre = $_POST["txtNombre"];
        $descripcion = $_POST["txtDescripcion"];

        $conexion = obtenerConexion();

        $sql = "INSERT INTO categoria (Nombre, Descripcion) VALUES ('$nombre', '$descripcion');";
        mysqli_query($conexion, $sql);

        if (mysqli_errno($conexion) == 0) {
            echo "<p>Ha añadido una nueva categoría.</p>";
            echo "<p><a href='altaCategoria.php' class='btn btn-primary'>Añadir otra categoría.</a></p>";
        } else {
            $numerror = mysqli_errno($conexion);
            $descrerror = mysqli_error($conexion);

            if ($numerror == 1062) {
                echo "<p>Ya existe la categoría $nombre en la Base de Datos.</p>";
                echo "<p><a href='altaCategoria.php' class='btn btn-primary'>Añadir otra categoría</a></p>";
            } else {
                echo "<p>Se ha producido un error numero $numerror que corresponde a: $descrerror</p>";
            }
        }
        echo "<a href='admin.php' class='btn btn-primary'>Vuelta al menú de administrador</a>";
        ?>

    </div>

    <script src="js/bootstrap.min.js"></script>
</body>

</html>