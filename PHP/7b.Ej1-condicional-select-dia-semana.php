<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dia de la semana</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
</head>

<body>
    <h3>Día de la semana</h3>
    <?php
    switch ($_GET['dia']) {
        case 1:
            echo "<h5>Lunes</h5";
            break;
        case 2:
            echo "<h5>Martes</h5";
            break;
        case 3:
            echo "<h5>Miércoles</h5";
            break;
        case 4:
            echo "<h5>Jueves</h5";
            break;
        case 5:
            echo "<h5>Viernes</h5";
            break;
        case 6:
            echo "<h5>Sabado</h5";
            break;
        case 7:
            echo "<h5>Domingo</h5";
            break;
        default:
            echo "<h5>Parámetro faltante o incorrecto</h7>";
    }
    ?>
</body>

</html>