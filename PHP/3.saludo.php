<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saludo</title>ç
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
</head>

<body>
    <?php
    // Recogemos los datos enviados medianta GET
    // $nombre = $_GET["txtNombre"];
    // $edad = $_GET["txtEdad"];
    $nombre = $_POST["txtNombre"];
    $edad = $_POST["txtEdad"];

    if (empty($_POST["txtNombre"])) {
        echo "<p>No ha llegado el nombre</p>";
        echo "<a href='2.formulario.php'>Volver al formulario</a>";
        return;
    }

    // Enviamos la salida
    echo "<h1>Hola $nombre, tu edad es $edad</h1>";
    ?>

    <p>Hola
        <?= $_POST['txtNombre'] ?>
        <?php echo $_POST['txtNombre'] ?>
        , aunque tienes <?= $_POST['txtEdad'] ?>
        años, estás hecho un chaval.</p>
</body>

</html>