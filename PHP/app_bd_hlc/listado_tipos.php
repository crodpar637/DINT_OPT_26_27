<?php
require_once("funcionesBD.php");
$conexion = obtenerConexion();

// Verifico si ha llegado el parametro de tipo 
if (isset($_GET['txtNombre'])) {
    // Recuperar parámetro
    $nombre = $_GET['txtNombre'];

    $sql = "SELECT * 
    FROM tipo  
    WHERE tipo LIKE '%$nombre%';";
} else {
    $sql = "SELECT * 
            FROM tipo ;"  ;
}

// Ejecutar consulta
$resultado = mysqli_query($conexion, $sql);

// Montar tabla
$mensaje = "<h2 class='text-center'>Listado de tipos de componentes</h2>";
$mensaje .= "<table class='table table-striped'>";
$mensaje .= "<thead><tr><th>IDTIPO</th><th>NOMBRE</th><th>DESCRIPCION</th><th>ACCIÓN</th></tr></thead>";
$mensaje .= "<tbody>";

// Recorrer filas mientras $fila != null
// OJO: es una asignación a la variable $fila y después se evalua $fila != null
while ($fila = mysqli_fetch_assoc($resultado)) {
    $mensaje .= "<tr><td>" . $fila['idtipo'] . "</td>";
    $mensaje .= "<td>" . $fila['tipo'] . "</td>";
    $mensaje .= "<td>" . $fila['descripcion'] . "</td>";
  

    $mensaje .= "<td><form class='d-inline me-1' action='editar_tipo_componente.php' method='get'>";
    $mensaje .= "<input type='hidden' name='componente' value='" . htmlspecialchars(json_encode($fila),ENT_QUOTES) . "' />";
    $mensaje .= "<button name='Editar' class='btn btn-primary'><i class='bi bi-pencil-square'></i></button></form>";

    $mensaje .= "</td></tr>";
    
}

// Cerrar tabla
$mensaje .= "</tbody></table>";

// Insertamos cabecera
include_once("cabecera.html");

// Mostrar mensaje calculado antes
echo $mensaje;


