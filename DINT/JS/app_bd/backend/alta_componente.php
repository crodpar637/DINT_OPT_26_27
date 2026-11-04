<?php
include_once("config.php");
$conexion = obtenerConexion();

// Recoger datos
$componente = json_decode($_POST['componente']);

$sql = "INSERT INTO componente VALUES(null, '$componente->nombre' , '$componente->descripcion', $componente->precio, $componente->idtipo ); ";

mysqli_query($conexion, $sql);

if (mysqli_errno($conexion) != 0) {
    $numerror = mysqli_errno($conexion);
    $descrerror = mysqli_error($conexion);
    // Prototipo responder($datos,$ok,$mensaje,$conexion)
    responder(null, false, "Se ha producido un error número $numerror que corresponde a: $descrerror <br>", $conexion);

} else {
    // Prototipo responder($datos,$ok,$mensaje,$conexion)
    responder(null, true, "Se ha dado de alta el componente", $conexion);
}
?>
