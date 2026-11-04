<?php
require_once('config.php');
$conexion = obtenerConexion();

// Recoger datos de entrada
$idcomponente = $_POST['idcomponente'];

// SQL
$sql = "DELETE FROM componente WHERE idcomponente = $idcomponente;";

$resultado = mysqli_query($conexion, $sql);

// responder(datos, error, mensaje, conexion)
responder(null, false, "Datos eliminados", $conexion);

