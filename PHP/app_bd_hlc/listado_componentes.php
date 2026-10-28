<?php
require_once("funcionesBD.php");
$conexion = obtenerConexion();

// Verifico si ha llegado el parametro de tipo 
if (isset($_GET['lstTipo'])) {
    // Recuperar parámetro
    $idtipo = $_GET['lstTipo'];

    $sql = "SELECT c.*, p.descripcion AS tipodesc FROM componente c, tipo p 
WHERE c.idtipo = p.idtipo AND p.idtipo = $idtipo ORDER BY idcomponente ASC;";

} else if (isset($_GET['txtPrecioMin']) && isset($_GET['txtPrecioMax']) ) { 

    $precio_min = $_GET['txtPrecioMin'];
    $precio_max = $_GET['txtPrecioMax'];

    $sql = "SELECT c.*, p.descripcion AS tipodesc 
    FROM componente c, tipo p 
    WHERE c.idtipo = p.idtipo 
    AND c.precio BETWEEN $precio_min AND $precio_max 
    ORDER BY idcomponente ASC;";


} else { // No recibo idtipo ni txtPrecioMin y txtPrecioMax para filtrar
    $sql = "SELECT c.*, p.descripcion AS tipodesc FROM componente c, tipo p 
    WHERE c.idtipo = p.idtipo ORDER BY idcomponente ASC;";

}

// Ejecutar consulta
$resultado = mysqli_query($conexion, $sql);

// Montar tabla
$mensaje = "<h2 class='text-center'>Listado de componentes</h2>";
$mensaje .= "<table class='table table-striped'>";
$mensaje .= "<thead><tr><th>IDCOMPONENTE</th><th>NOMBRE</th><th>DESCRIPCION</th><th>PRECIO</th><th>TIPO</th><th>ACCIÓN</th></tr></thead>";
$mensaje .= "<tbody>";

// Recorrer filas mientras $fila != null
// OJO: es una asignación a la variable $fila y después se evalua $fila != null
while ($fila = mysqli_fetch_assoc($resultado)) {
    $mensaje .= "<tr><td>" . $fila['idcomponente'] . "</td>";
    $mensaje .= "<td>" . $fila['nombre'] . "</td>";
    $mensaje .= "<td>" . $fila['descripcion'] . "</td>";
    $mensaje .= "<td>" . $fila['precio'] . "</td>";
    $mensaje .= "<td>" . $fila['tipodesc'] . "</td>";

    $mensaje .= "<td><form class='d-inline me-1' action='editar_componente.php' method='post'>";
    $mensaje .= "<input type='hidden' name='componente' value='" . htmlspecialchars(json_encode($fila),ENT_QUOTES) . "' />";
    $mensaje .= "<button name='Editar' class='btn btn-primary'><i class='bi bi-pencil-square'></i></button></form>";

    $mensaje .= "<form class='d-inline' action='proceso_borrar_componente.php' method='post'>";
    $mensaje .= "<input type='hidden' name='idcomponente' value='" . $fila['idcomponente']  . "' />";
    $mensaje .= "<button name='Borrar' class='btn btn-danger'><i class='bi bi-trash'></i></button></form>";

    $mensaje .= "</td></tr>";
    
}

// Cerrar tabla
$mensaje .= "</tbody></table>";

// Insertamos cabecera
include_once("cabecera.html");

// Mostrar mensaje calculado antes
echo $mensaje;


