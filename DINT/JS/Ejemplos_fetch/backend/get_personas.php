<?php

require_once("funcionesBD.php");

$conexion = obtenerConexion();

$sql = "SELECT id,name FROM Person;";

$resultado = mysqli_query($conexion, $sql);

while ($fila = mysqli_fetch_assoc($resultado)) {
   $datos[] = $fila; // Inserta una fila en el array $datos
}

echo json_encode($datos);

exit;



