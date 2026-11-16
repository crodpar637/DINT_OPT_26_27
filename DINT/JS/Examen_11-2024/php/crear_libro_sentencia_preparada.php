<?php
/**
 * crear_libro_sentencia_preparada.php
 * 
 * Script que inserta un nuevo libro en la base de datos utilizando
 * sentencias preparadas (prepared statements) para evitar SQL injection.
 * Recibe datos JSON por POST y valida antes de procesar.
 */

// Incluye funciones centralizadas: obtenerConexion() y responder()
require_once('config.php');

try {
    /**
     * VALIDACIÓN 1: Verificar que existe el parámetro POST "libro"
     * Se usa empty() para comprobar si está vacío o no existe
     */
    if (empty($_POST["libro"])) {
        throw new Exception("Datos de libro no proporcionados");
    }

    /**
     * Decodificar JSON recibido desde el cliente
     * Convierte string JSON a objeto PHP
     * Ejemplo: '{"idgenero":1,"titulo":"El Quijote",...}' → objeto
     */
    $libro = json_decode($_POST["libro"]);
    
    /**
     * VALIDACIÓN 2: Verificar que el JSON es válido
     * Si hay error en JSON, json_decode() retorna null
     */
    if ($libro === null) {
        throw new Exception("JSON inválido");
    }

    /**
     * VALIDACIÓN 3: Comprobar que los campos obligatorios están completos
     * - idgenero: identificador del género (relación con tabla género)
     * - titulo: nombre del libro (requerido)
     * - autor: nombre del autor (requerido)
     * Los campos descripción e imagen son opcionales
     */
    if (empty($libro->idgenero) || empty($libro->titulo) || empty($libro->autor)) {
        throw new Exception("Campos requeridos faltantes");
    }

    /**
     * Obtener conexión a la base de datos
     * Esta función está definida en config.php
     */
    $conexion = obtenerConexion();

    /**
     * PASO 1: Preparar la sentencia SQL
     * 
     * Los signos de interrogación (?) son placeholders (marcadores).
     * NO insertamos los valores directamente en la consulta.
     * Esto previene SQL injection porque la sentencia y los datos van
     * separados al servidor de base de datos.
     * 
     * Estructura SQL: INSERT INTO tabla(columnas) VALUES (?, ?, ?, ?, ?)
     * Nota: No incluimos 'idlibro' porque la BD lo asigna automáticamente
     */
    $stmt = $conexion->prepare("INSERT INTO libro(idgenero, titulo, autor, descripcion, imagen) 
                               VALUES (?, ?, ?, ?, ?)");
    
    /**
     * Verificar que la preparación fue exitosa
     * Si hay error en la sintaxis SQL, prepare() retorna false
     */
    if (!$stmt) {
        throw new Exception("Error al preparar consulta");
    }

    /**
     * PASO 2: Vincular parámetros a la sentencia preparada
     * 
     * bind_param(tipos, var1, var2, ...)
     * 
     * TIPOS DE DATOS:
     * - i = integer (número entero)
     * - s = string (cadena de texto)
     * - d = double (número decimal)
     * - b = blob (datos binarios)
     * 
     * En nuestro caso: "issss"
     *   i → idgenero (número)
     *   s → titulo (texto)
     *   s → autor (texto)
     *   s → descripcion (texto)
     *   s → imagen (texto/ruta)
     * 
     * Las variables deben pasarse por REFERENCIA (&), pero aquí
     * directamente usamos las propiedades del objeto $libro
     */
    $stmt->bind_param(
        "issss",
        $libro->idgenero,
        $libro->titulo,
        $libro->autor,
        $libro->descripcion,
        $libro->imagen
    );

    /**
     * PASO 3: Ejecutar la sentencia preparada
     * 
     * execute() envía la consulta con los parámetros al servidor.
     * Los valores están separados de la consulta, por lo que aunque
     * contengan caracteres especiales o código SQL, serán tratados
     * como datos, no como código.
     */
    if (!$stmt->execute()) {
        throw new Exception("Error al guardar libro");
    }

    /**
     * Cerrar la sentencia preparada
     * Libera recursos de memoria asociados a $stmt
     */
    $stmt->close();

    /**
     * Respuesta exitosa al cliente
     * responder(datos, ok, mensaje, conexion)
     * - null: sin datos adicionales
     * - true: indica éxito
     * - mensaje: texto para el usuario
     * - $conexion: se cierra la conexión después
     */
    responder(null, true, "Libro guardado en la base de datos", $conexion);

/**
 * MANEJO DE ERRORES ESPECÍFICOS DE BASE DE DATOS
 * Captura excepciones de mysqli (errores de conexión, consulta, etc.)
 */
} catch (mysqli_sql_exception $e) {
    /**
     * Respuesta de error genérica (sin detalles técnicos)
     * Por seguridad, NO exponemos $e->getMessage() al cliente
     * Esto evita revelar estructura de la BD a posibles atacantes
     */
    responder(null, false, "Error en la base de datos", $conexion ?? null);

/**
 * MANEJO DE OTROS ERRORES
 * Captura excepciones generales (validaciones, etc.)
 */
} catch (Exception $e) {
    /**
     * Aquí SÍ enviamos el mensaje porque son validaciones nuestras,
     * no detalles técnicos de la BD
     * El operador ?? null evita error si $conexion no está definida
     */
    responder(null, false, $e->getMessage(), $conexion ?? null);
}