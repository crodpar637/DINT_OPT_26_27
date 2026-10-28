<?php
require_once("funcionesBD.php");

$conexion = obtenerConexion();

$sql = "SELECT idtipo,tipo FROM tipo;";

$resultado = mysqli_query($conexion, $sql);

$options = "";
while ($fila = mysqli_fetch_assoc($resultado)) {
    // $tipos[] = $fila; // Insertar una fila al final
    $options .= " <option value='" . $fila["idtipo"] . "'>" . $fila["tipo"] . "</option>";
}

// Cabecera HTML que incluye navbar
include_once("cabecera.html");
?>

<div class="container" id="formularios">
    <div class="row">
        <form class="form-horizontal" action="proceso_alta_componente.php" name="frmAltacomponente" id="frmAltacomponente" method="post">
            <fieldset>
                <!-- Form Name -->
                <legend>Alta de componente</legend>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="txtNombre">Nombre</label>
                    <div class="col-xs-4">
                        <input id="txtNombre" name="txtNombre" placeholder="Nombre del componente" class="form-control input-md" maxlength="25" type="text">
                    </div>
                </div>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="txtDescripcion">Descripción</label>
                    <div class="col-xs-4">
                        <input id="txtDescripcion" name="txtDescripcion" placeholder="Descripcion" class="form-control input-md" type="text">
                    </div>
                </div>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="txtPrecio">Precio</label>
                    <div class="col-xs-4">
                        <input id="txtPrecio" name="txtPrecio" placeholder="Precio" class="form-control input-md" type="number">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="lstTipo">Tipo</label>
                    <div class="col-xs-4">
                        <select name="lstTipo" id="lstTipo" class="form-select" aria-label="Default select example">
                            <?php echo $options; ?>
                        </select>
                    </div>
                </div>
                <!-- Button -->
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="btnAceptarAltaComponente"></label>
                    <div class="col-xs-4">
                        <input type="submit" id="btnAceptarAltaComponente" name="btnAceptarAltaComponente" class="btn btn-primary" value="Aceptar" />
                    </div>
                </div>
            </fieldset>
        </form>

    </div>
</div>
</body>

</html>