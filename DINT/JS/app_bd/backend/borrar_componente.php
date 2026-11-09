<?php
require_once('config.php');
$conexion = obtenerConexion();

// Recoger datos de entrada
$idcomponente = $_POST['idcomponente'];

// SQL
$sql = "DELETE FROM componente WHERE idcomponente = $idcomponente;";

$resultado = mysqli_query($conexion, $sql);

// responder(datos, ok, mensaje, conexion)
responder(null, true, "Datos eliminados", $conexion);

