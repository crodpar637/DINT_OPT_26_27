<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Varios botones submit</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
</head>
<body>
    <?php
        if(isset($_POST['btnHombre'])){
            echo "<h6>Bienvenido," .  $_POST['txtNombre'] . "</h6>";

        } else if (isset($_POST['btnMujer'])){
            echo "<h6>Bienvenida," .  $_POST['txtNombre'] . "</h6>";
        } else if(isset($_POST['btnNoBinario'])){
            echo "<h6>Bienvenide," .  $_POST['txtNombre'] . "</h6>";
        } else {
            echo "<h3>No han llegado parámetros</h3>";
        }
        echo "<br>";
        echo $_POST['btnHombre'] ?? "No han pulsado btnHombre";
    ?>

</body>