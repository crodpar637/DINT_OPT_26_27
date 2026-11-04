<?php

/*
  get_tipos.php

  Pequeña API: devuelve todos los registros de la tabla `tipo` en formato JSON.
  Diseñado para explicar el flujo a alumnos CFGS DAM.

  Flujo general:
   1) Incluye `config.php` que provee obtenerConexion() y responder().
   2) Abre la conexión a la base de datos.
   3) Ejecuta una consulta SELECT sobre `tipo`.
   4) Empaqueta las filas en un array y responde en JSON usando responder().
   5) Si ocurre un error se captura y se devuelve un JSON con ok=false.
*/

require_once('config.php'); // Incluye obtenerConexion() y responder()

try {
    // Obtener conexión a la BBDD (usa la configuración centralizada)
    $conexion = obtenerConexion();

    // Consulta simple — en este caso no hay parámetros externos
    $sql = "SELECT * FROM tipo;";
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

/*
  Notas para alumnos (breve):
   - Siempre validar y sanitizar la entrada del usuario en el frontend/back.
   - Para consultas que reciban parámetros externos, usar prepared statements:
       $stmt = $conexion->prepare('SELECT * FROM tipo WHERE id = ?');
       $stmt->bind_param('i', $id);
       $stmt->execute();
   - No mostrar información sensible en mensajes de error en producción.
   - Mantener la lógica de respuesta centralizada (como responder()) ayuda a
     que el frontend procese errores y datos de forma consistente.
*/
