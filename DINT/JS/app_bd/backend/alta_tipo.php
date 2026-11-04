<?php
/*
    alta_tipo.php

    Pequeña API para insertar un nuevo registro en la tabla `tipo`.
    Versión adaptada al estilo seguro y didáctico usado en `alta_componente.php`:
    - Usa try/catch para manejar excepciones de mysqli.
    - Valida la entrada mínima y responde en JSON con responder().
    - Emplea prepared statement para evitar inyección SQL.

    Entrada esperada (POST):
      - 'tipo' (string) obligatorio
      - 'descripcion' (string) opcional

    Flujo:
      1) Incluir `config.php` y obtener conexión.
      2) Validar campos POST.
      3) Ejecutar INSERT con prepared statement.
      4) Responder en JSON usando responder().
*/

include_once(__DIR__ . '/config.php');

try {
    $conexion = obtenerConexion();

    // Validación básica de entrada
    if (!isset($_POST['tipo'])) {
        responder(null, false, "Falta el campo 'tipo' en POST", $conexion);
    }

    $tipo = trim($_POST['tipo']);
    $descripcion = isset($_POST['descripcion']) ? trim($_POST['descripcion']) : '';

    if ($tipo === '') {
        responder(null, false, "El campo 'tipo' no puede estar vacío", $conexion);
    }

    // Prepared statement para insertar de forma segura
    $sql = "INSERT INTO tipo (tipo, descripcion) VALUES (?, ?)";
    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        throw new mysqli_sql_exception('Error al preparar la consulta: ' . $conexion->error);
    }

    // Bind y ejecución ('s' -> string)
    $stmt->bind_param('ss', $tipo, $descripcion);
    if (!$stmt->execute()) {
        throw new mysqli_sql_exception('Error al ejecutar INSERT: ' . $stmt->error);
    }

    // Éxito
    responder(null, true, 'Se ha insertado el tipo de componente', $conexion);

} catch (mysqli_sql_exception $e) {
    // Responder con información controlada sobre el error de BBDD
    responder(null, false, 'Error en la base de datos: ' . $e->getMessage(), $conexion ?? null);
} catch (Exception $e) {
    responder(null, false, 'Error inesperado: ' . $e->getMessage(), $conexion ?? null);
}

?>
