<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de multiplicar</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
</head>
<body>
    <h3>Tabla de multiplicar del <?=  $_GET['txtNum'] ?> </h3>
    <?php
        $num = $_GET['txtNum'];

        for($i=1;$i<=10;$i++){
            echo "<p>$num x $i = " . $num*$i . "<p>";
        }
    ?>
</body>
