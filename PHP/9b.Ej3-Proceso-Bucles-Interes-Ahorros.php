<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bucles - Interés - Ahorros</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
    <style>
        .centrado{
            text-align: center;
        }
        .derecha {
            text-align: right;
        }
        </style>
</head>

<body>
    <h3>Resultado del plan de ahorro</h3>
    <table>
        <thead>
            <tr>
                <th class="centrado">AÑO</th>
                <th class="centrado">IMPORTE</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $inicial = $_GET['inicial']; // Importe inicial
            $anual = $_GET['anual']; // Aportación anual
            $num_annos = $_GET['num_annos']; // Número de años
            $interes = $_GET['interes']; // Interes aplicable

            $total = $inicial;

            for ($i = 1; $i <= $num_annos; $i++) {
                echo "<tr> <td class='centrado'> $i </td>";
                $total_listado = number_format($total,2);
                echo "<td class='derecha'> $total_listado € </td></tr>";

                //Año siguiente
                $total = $total * (1 + $interes/100); // Aplicacion de interes
                $total = $total + $anual; // Suma de la siguiente aportacion anual
            }
            ?>
        </tbody>
    </table>


</body>

</html>