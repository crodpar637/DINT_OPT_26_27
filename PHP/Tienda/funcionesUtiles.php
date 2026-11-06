<?php
function comprobarSesionAdmin() {
    if (!isset($_SESSION["conectado"]) || $_SESSION["conectado"] != "admin") {
        header("Location: index.php");
    }
}

function comprobarSesionCliente() {
    if (!isset($_SESSION["conectado"]) || $_SESSION["conectado"] != "cliente") {
        header("Location: index.php");
    }
}

function comprobarSesionClienteOAdmin() {
    if (!isset($_SESSION["conectado"])) {
        header("Location: index.php");
    }
}

