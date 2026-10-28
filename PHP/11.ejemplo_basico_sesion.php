<?php
session_start();

if (!isset($_SESSION['visitas'])) {
    $_SESSION['visitas'] = 1;
} else {
    $_SESSION['visitas']++;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pruebas de PHP</title>
</head>

<body>
    <h1>Pruebas</h1>
    <?php
    echo '<p>Visitas: ', $_SESSION['visitas'], '</p>';
    setcookie("colorPreferido", "#F03276", time() + 7*24*60*60); 
    ?>
</body>

</html>