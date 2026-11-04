"use strict";

const rutaBackend = "http://localhost/DINT/JS/app_bd/backend/";

/**
 * Realiza peticiones AJAX de tipo GET
 * @param {string} url 
 * @param {FormData} parametros - Objeto FormData con los parámetros de la llamada 
 * @returns {Object} response
 */
async function peticionGET(url, parametros) {
    let response;

    try {
        // Construimos la URL completa
        let oURL = new URL(rutaBackend);
        oURL.pathname += url;

        // Añadimos los parámetros del FormData
        for (let [clave, valor] of parametros) {
            oURL.searchParams.append(clave, valor);
        }

        // Hacemos la petición
        const respuestaServidor = await fetch(oURL, { method: "GET" });

        if (respuestaServidor.ok) {
            response = await respuestaServidor.json();
        } else {
            console.error("Error al acceder al servidor. Status:", respuestaServidor.status);
            response = {
                ok: false,
                mensaje: `Error HTTP: ${respuestaServidor.status}`,
                datos: null
            };
        }

    } catch (error) {
        // Error de conexión o fetch (no hay respuesta del servidor)
        console.error("No se pudo conectar con el servidor:", error);
        response = {
            ok: false,
            mensaje: "No se pudo conectar con el servidor. Verifique su conexión o que el servidor esté disponible.",
            datos: null
        };
    }

    return response;
}

/**
 * Realiza peticiones AJAX de tipo POST
 * @param {string} url 
 * @param {FormData} parametros - Objeto FormData con los parámetros de la llamada 
 * @returns {Object} response
 */
async function peticionPOST(url, parametros) {
    let response;

    try {
        // Construimos la URL completa
        let oURL = new URL(rutaBackend);
        oURL.pathname += url;

        // Hacemos la petición (request)
        const respuestaServidor = await fetch(oURL, {
            body: parametros,
            method: "POST"
        });

        if (respuestaServidor.ok) {
            response = await respuestaServidor.json();
        } else {
            console.error("Error al acceder al servidor. Status:", respuestaServidor.status);
            response = {
                ok: false,
                mensaje: `Error HTTP: ${respuestaServidor.status}`,
                datos: null
            };
        }

    } catch (error) {
        // Error de conexión o fetch (no hay respuesta del servidor)
        console.error("No se pudo conectar con el servidor:", error);
        response = {
            ok: false,
            mensaje: "No se pudo conectar con el servidor. Verifique su conexión o que el servidor esté disponible.",
            datos: null
        };
    }

    return response;
}
