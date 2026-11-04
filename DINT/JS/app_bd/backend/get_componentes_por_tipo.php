<?php
require_once('config.php');
$conexion = obtenerConexion();

// Datos de entrada
$idtipo = $_GET['idtipo'];

// SQL
$sql = "SELECT c.*, t.tipo FROM componente as c, tipo as t 
WHERE c.idtipo = t.idtipo 
AND c.idtipo = $idtipo;";

$resultado = mysqli_query($conexion, $sql);

while ($fila = mysqli_fetch_assoc($resultado)) {
    $datos[] = $fila; // Insertar la fila en el array
}

responder($datos, true, "Datos recuperados", $conexion);