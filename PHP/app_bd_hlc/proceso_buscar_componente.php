<?php
require_once("funcionesBD.php");
$conexion = obtenerConexion();

// Recuperar parámetro
$nombre_componente = $_GET['txtNombreComponente'];

// No validamos, suponemos que la entrada de datos es correcta

$sql = "SELECT c.*, p.descripcion AS tipodesc FROM componente c, tipo p 
WHERE c.idtipo = p.idtipo 
AND nombre LIKE '%$nombre_componente%';";

$resultado = mysqli_query($conexion, $sql);

if(mysqli_num_rows($resultado) > 0 ){ // Mostrar tabla de datos, hay datos

    $mensaje = "<h2 class='text-center'>Componente localizado</h2>";
    $mensaje .= "<table class='table table-striped'>";
    $mensaje .= "<thead><tr><th>IDCOMPONENTE</th><th>NOMBRE</th><th>DESCRIPCION</th><th>PRECIO</th><th>TIPO</th><th>ACCION</th></tr></thead>";
    $mensaje .= "<tbody>";
    
    while($fila = mysqli_fetch_assoc($resultado)){
        $mensaje .= "<tr>";
        $mensaje .= "<td>" . $fila['idcomponente'] . "</td>";
        $mensaje .= "<td>" . $fila['nombre'] . "</td>";
        $mensaje .= "<td>" . $fila['descripcion'] . "</td>";
        $mensaje .= "<td>" . $fila['precio'] . "</td>";
        $mensaje .= "<td>" . $fila['tipodesc'] . "</td>";

        // Formulario en la celda para procesar borrado del registro
        $mensaje .= "<td><form action='proceso_borrar_componente.php' method='post'>";
        // input hidden para enviar idcomponente a borrar
        $idcomponente = $fila['idcomponente'];
        $mensaje .= "<input type='hidden' name='idcomponente' value='$idcomponente' />";  
        $mensaje .= "<button type='submit' name='btnBorrar' class='btn btn-primary'><i class='bi bi-trash'></i></button> </form> </td>";

        $mensaje .= "</tr>";
    }
    
    $mensaje .= "</tbody></table>"; 
} else { // No hay datos
   $mensaje = "<h2 class='text-center mt-5'>No hay componentes con nombre $nombre_componente</h2>";
}

// Insertamos cabecera
include_once("cabecera.html");

// Mostrar mensaje calculado antes
echo $mensaje;

?>
