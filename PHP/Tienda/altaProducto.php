<?php
session_start();
require_once("funcionesUtiles.php");
comprobarSesionAdmin();

require_once("funcionesBD.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <title>Tienda: Alta producto</title>
</head>

<body>
    <div class="container">
        <form name="frmAltaProducto" id="frmAltaProducto" action="procesoAltaProducto.php" method="POST" enctype="multipart/form-data">
            <legend>Alta de producto</legend>
            <div class="col-md-6 mb-3">
                <label for="txtNombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="txtNombre" name="txtNombre" placeholder="Introduzca el nombre del producto" maxlength="45" size="50" />
            </div>
            <div class="col-md-6 mb-3">
                <label for="txtDescripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="txtDescripcion" name="txtDescripcion" maxlength="90" rows="4" placeholder="Introduzca una descripción"></textarea>
            </div>
            <div class="col-md-6 mb-3">
                <label for="txtStock" class="form-label">Stock</label>
                <input type="number" class="form-control" id="txtStock" name="txtStock" placeholder="Introduzca el stock del producto" min="0" maxlength="11" />
            </div>
            <div class="col-md-6 mb-3">
                <label for="txtPrecio" class="form-label">Precio</label>
                <input type="number" class="form-control" id="txtPrecio" name="txtPrecio" placeholder="Introduzca el precio del producto" min="0" />
            </div>
            <div class="col-md-6 mb-3">
                <label for="lstCategoria" class="form-label">Categorías</label>
                <select name="lstCategoria" id="lstCategoria" class="form-select">
                    <?php
                    $conexion = obtenerConexion();

                    $array_opciones = obtenerArrayOpciones('categoria', 'CodCat', 'Nombre');

                    foreach ($array_opciones as $indice => $valor) {
                        echo "<option value='" . $indice . "'>" . $valor . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="imagen" class="form-label">Subir imagen del producto</label>
                <input type="file" class="form-control" id="imagen" name="imagen" />
            </div>
            <button type="submit" class="btn btn-primary">Aceptar</button>
        </form>
    </div>

    <script src="js/bootstrap.min.js"></script>
</body>

</html>