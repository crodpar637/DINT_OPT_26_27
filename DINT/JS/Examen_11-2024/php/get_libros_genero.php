<?php
require_once('config.php'); // Incluye obtenerConexion() y responder()

try {
    // Obtener conexión a la BBDD (usa la configuración centralizada)
    $conexion = obtenerConexion();

    // Obtener parámetro
    $idgenero = $_GET["idgenero"];

    // Consulta entre libros y generos
    $sql = "SELECT l.*,g.genero 
            FROM  libro as l inner join genero as g 
            ON l.idgenero = g.idgenero
            WHERE l.idgenero = $idgenero";
            
    $resultado = $conexion->query($sql);

    // Recolectamos las filas en un array asociativo para serializar a JSON
    $datos = [];
    while ($fila = $resultado->fetch_assoc()) {
        $datos[] = $fila; // cada $fila es un array asociativo (columna => valor)
    }

    // responder() enviará un JSON con estructura { ok, datos, mensaje }
    // y cerrará la conexión si se le pasa.
    responder($datos, true, "Datos recuperados correctamente", $conexion);
} catch (mysqli_sql_exception $e) {
    // Errores específicos de mysqli (p. ej. problemas con la consulta o la conexión)
    // Enviamos un JSON de error. Usamos $conexion ?? null para evitar usar
    // una variable no definida si la conexión falló al crearse.
    responder(null, false, "Error en la base de datos: " . $e->getMessage(), $conexion ?? null);
} catch (Exception $e) {
    // Captura cualquier otra excepción / error inesperado
    responder(null, false, "Error general: " . $e->getMessage(), $conexion ?? null);
}
