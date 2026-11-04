<?php
require_once('config.php');
$conexion = obtenerConexion();

// Datos de entrada
$precio_min = $_GET['precioMin'];
$precio_max = $_GET['precioMax'];

// SQL
$sql = "SELECT c.*, t.tipo 
FROM componente as c, tipo as t 
WHERE c.idtipo = t.idtipo 
AND precio between $precio_min AND $precio_max;";

$resultado = mysqli_query($conexion, $sql);

while ($fila = mysqli_fetch_assoc($resultado)) {
    $datos[] = $fila; // Insertar la fila en el array
}

responder($datos, true, "Datos recuperados", $conexion);