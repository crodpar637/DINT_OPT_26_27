<?php
/*
  config.php

  Fichero de configuración y utilidades para la pequeña API de ejemplo.
  Está pensado para ser incluido (require/include) desde los scripts
  del directorio `backend/` (por ejemplo: get_tipos.php, alta_componente.php, ...)

  Objetivo didáctico (alumnos CFGS DAM):
  - Mostrar cómo centralizar la configuración de conexión a la base de datos.
  - Proveer funciones reutilizables para obtener la conexión y responder en JSON.
  - Señalar buenas prácticas y riesgos (credenciales en texto plano, manejo de errores).

  Uso típico:
    require_once __DIR__ . '/config.php';
    $conexion = obtenerConexion();
    // ... operaciones con $conexion ...
    responder($datos, true, 'OK', $conexion);

*/

/* -------------------------------------------------------------
   CONFIGURACIÓN DE CONEXIÓN
   -------------------------------------------------------------
   $basedatos es un array asociativo que contiene los parámetros
   necesarios para conectar con MySQL/MariaDB usando mysqli.

   Campos:
     - basedatos : nombre de la base de datos (schema)
     - usuario   : usuario de la base de datos
     - password  : contraseña del usuario
     - servidor  : host del servidor MySQL (en Docker suele ser el nombre del servicio)
     - puerto    : puerto TCP (3306 por defecto)

   NOTA DE SEGURIDAD: En proyectos reales no es recomendable dejar
   credenciales en texto plano en el repositorio. Usar variables de
   entorno o archivos fuera del control de versiones.
*/
$basedatos = array(
    "basedatos" => "empresa",
    "usuario" => "root",
    "password" => "test",
    "servidor" => "db",
    "puerto" => 3306
);


/* -------------------------------------------------------------
   CONTROL DE ERRORES (ERROR REPORTING)
   -------------------------------------------------------------
   Ajustamos el nivel de reporting para no mostrar warnings o notices
   en producción o en entornos educativos donde no queremos ruido.

   - error_reporting(E_ERROR | E_PARSE): mostrará sólo errores fatales y
     errores de parseo. Para desarrollo puedes usar E_ALL.
   - mysqli_report(MYSQLI_REPORT_OFF): evitamos que mysqli lance warnings
     automáticos; manejamos errores de forma controlada con excepciones
     o comprobaciones explícitas.
*/
// Mostrar sólo errores fatales y parse errors (evita warnings innecesarios)
error_reporting(E_ERROR | E_PARSE);

// Desactivar el reporte automático de errores de mysqli (lo gestionamos nosotros)
mysqli_report(MYSQLI_REPORT_OFF);


/* -------------------------------------------------------------
   FUNCIONES COMUNES
   -------------------------------------------------------------
   Aquí se definen dos utilidades reutilizables:
     - obtenerConexion(): devuelve un objeto mysqli conectado y listo.
     - responder(...): envía una respuesta JSON con estructura conocida
       y cierra la conexión si se le pasa.

   Contrato rápido:
     obtenerConexion(): mysqli | finaliza ejecución en caso de error
     responder(datos, ok, mensaje, conexion=null): void (envía JSON y exit)

   Errores comunes a contemplar:
     - credenciales incorrectas -> obtenerConexion falla
     - consultas que devuelven false -> comprobar con === false
     - llamadas a responder sin datos válidos -> enviar mensaje útil
*/

function obtenerConexion()
{
    // Accedemos a la configuración global $basedatos
    global $basedatos;

    try {
        // Creamos la conexión usando los parámetros del array
        $conexion = new mysqli(
            $basedatos["servidor"],
            $basedatos["usuario"],
            $basedatos["password"],
            $basedatos["basedatos"],
            $basedatos["puerto"]
        );

        // Fijamos el conjunto de caracteres a utf8mb4 para soportar emojis y acentos
        $conexion->set_charset("utf8mb4");
        return $conexion;
    } catch (mysqli_sql_exception $e) {
        // En caso de error de conexión, devolvemos un JSON con error y paramos
        // responder() hace exit por nosotros. Pasamos null como conexión.
        responder(null, false, "Error de conexión: " . $e->getMessage(), null);
    }
}


function responder($datos, $ok, $mensaje, $conexion = null)
{
    // Cabecera indicando que la respuesta es JSON y con codificación UTF-8
    header('Content-Type: application/json; charset=utf-8');

    // Estructura de la respuesta que el frontend esperará:
    // { ok: bool, datos: any, mensaje: string }
    echo json_encode([
        "ok" => $ok,
        "datos" => $datos,
        "mensaje" => $mensaje
    ], JSON_UNESCAPED_UNICODE);

    // Si nos pasan la conexión, la cerramos aquí para evitar fugas
    if ($conexion) {
        $conexion->close();
    }

    // exit con código 0 si ok==true, o 1 si ok==false.
    // Esto detiene la ejecución del script inmediatamente.
    exit($ok ? 0 : 1);
}
