<?php
require_once('config.php'); // Incluye obtenerConexion() y responder()

$libro = json_decode($_POST["libro"]);

try {
    // Obtener conexión a la BBDD (usa la configuración centralizada)
    $conexion = obtenerConexion();

    $sql = "INSERT INTO libro(idlibro, idgenero, titulo, autor, descripcion, imagen) VALUES (null, $libro->idgenero, '$libro->titulo', '$libro->autor', '$libro->descripcion', '$libro->imagen')";

    $resultado = $conexion->query($sql);

    // responder() enviará un JSON con estructura { ok, datos, mensaje }
    // y cerrará la conexión si se le pasa.
    responder(null, true, "Libro guardado en la base de datos", $conexion);

} catch (mysqli_sql_exception $e) {
    // Errores específicos de mysqli (p. ej. problemas con la consulta o la conexión)
    // Enviamos un JSON de error. Usamos $conexion ?? null para evitar usar
    // una variable no definida si la conexión falló al crearse.
    responder(null, false, "Error en la base de datos: " . $e->getMessage(), $conexion ?? null);
} catch (Exception $e) {
    // Captura cualquier otra excepción / error inesperado
    responder(null, false, "Error general: " . $e->getMessage(), $conexion ?? null);
}
