<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test de PHP</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
</head>
<body>
    <h4>Resultado del test de PHP</h4>
    <?php
        $puntos = 0;

        if(isset($_GET["r1"])){
            if ($_GET["r1"] == 2){
                $puntos += 2;
                echo "<p>Has acertado la primera pregunta</p>";
            } else {
                $puntos -= 1;
                echo "<p>Has fallado la primera pregunta</p>";
            }
        } else {
            echo "<p>No has contestado la primera pregunta</p>";
        }

        if(isset($_GET["r2"])){
            if ($_GET["r2"] == 1){
                $puntos += 2;
                echo "<p>Has acertado la segunda pregunta</p>";
            } else {
                $puntos -= 1;
                echo "<p>Has fallado la segunda pregunta</p>";
            }
        } else {
            echo "<p>No has contestado la segunda pregunta</p>";
        }

        echo "<p>La puntuación en el test es: <strong>$puntos</strong></p>";
    ?>
</body>
</html>