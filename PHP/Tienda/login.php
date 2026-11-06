<?php
session_start();
require_once("funcionesBD.php");

if (!isset($_POST["email"]) || !isset($_POST["password"])) {
    $mensajeaccesoincorrecto = "Faltan campos por rellenar, por favor introduzca todos los datos de login";
} else {
    //Recibimos las dos variables
    $email = $_POST["email"];
    $password = $_POST["password"];

    $conexion = obtenerConexion();
    $resultado = comprobarUsuario("clientes", "email", "password", $email, $password);

    if ($resultado == 0) {
        if ($email == "admin@admin.com") {
            $_SESSION["conectado"] = "admin";
            $_SESSION["correo"] = $email;
            header("Location: admin.php");
        } else {
            $_SESSION["conectado"] = "cliente";
            $_SESSION["correo"] = $email;
            header("Location: clientes.php");
        }
    } else if ($resultado == 1) {
        $mensajeaccesoincorrecto = "El usuario existe, pero la contraseña es incorrecta, por favor vuelva a introducirla.";
    } else if ($resultado == 2) {
        $mensajeaccesoincorrecto = "El usuario no existe, por favor vuelta a introducir los datos de login.";
    } else if ($resultado == 3) {
        $mensajeaccesoincorrecto = "Faltan campos por rellenar, por favor introduzca todos los datos de login.";
    } else if ($resultado == 4) {
        $mensajeaccesoincorrecto = "Se ha producido un error en la base de datos, vuelva a intentarlo.";
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
    <title>Tienda: Login</title>
</head>

<body>
    <div class="container mt-5">
        <?php
            echo "<a href='index.php' class='btn btn-primary'>" . $mensajeaccesoincorrecto . "</a>";
        ?>
    </div>

    <script src="js/bootstrap.min.js"></script>
</body>

</html>