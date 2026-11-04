<?php
include_once("config.php");
$conexion = obtenerConexion();

// Recoger datos
$componente = json_decode($_POST['componente']);

$sql = "UPDATE componente
SET nombre = '" . $componente->nombre . "', 
descripcion = '" .  $componente->descripcion . "', 
precio = $componente->precio, 
idtipo = $componente->idtipo 
WHERE idcomponente = $componente->idcomponente ";

mysqli_query($conexion, $sql);

if (mysqli_errno($conexion) != 0) {
    $numerror = mysqli_errno($conexion);
    $descrerror = mysqli_error($conexion);

    responder(null, false, "Se ha producido un error número $numerror que corresponde a: $descrerror <br>", $conexion);

} else {
    // Prototipo responder($datos,$error,$mensaje,$conexion)
    responder(null, true, "Se ha modificado el componente", $conexion);
}
?>
