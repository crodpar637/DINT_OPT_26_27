<?php

// Recupero datos de parametro en forma de array asociativo
$componente = json_decode($_POST['componente'],true);

require_once("funcionesBD.php");
$conexion = obtenerConexion();

$sql = "SELECT idtipo,tipo FROM tipo;";

$resultado = mysqli_query($conexion, $sql);

$options = "";
while ($fila = mysqli_fetch_assoc($resultado)) {
    // Si coincide el tipo con el del componente es el que debe aparecer seleccionado (selected)
    if ($fila['idtipo'] == $componente['idtipo']){
        $options .= " <option selected value='" . $fila["idtipo"] . "'>" . $fila["tipo"] . "</option>";
    } else{
        $options .= " <option value='" . $fila["idtipo"] . "'>" . $fila["tipo"] . "</option>";
    }
}

// Cabecera HTML que incluye navbar
include_once("cabecera.html");
?>

<div class="container" id="formularios">
    <div class="row">
        <form class="form-horizontal" action="proceso_modificar_componente.php" name="frmAltacomponente" id="frmAltacomponente" method="post">
            <fieldset>
                <!-- Form Name -->
                <legend>Modificación de componente</legend>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="txtNombre">Nombre</label>
                    <div class="col-xs-4">
                        <input value="<?php echo $componente['nombre']?>" id="txtNombre" name="txtNombre" placeholder="Nombre del componente" class="form-control input-md" type="text">
                    </div>
                </div>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="txtDescripcion">Descripción</label>
                    <div class="col-xs-4">
                        <input value="<?php echo $componente['descripcion']?>" id="txtDescripcion" name="txtDescripcion" placeholder="Descripcion" class="form-control input-md" type="text">
                    </div>
                </div>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="txtPrecio">Precio</label>
                    <div class="col-xs-4">
                        <input value="<?php echo $componente['precio']?>" id="txtPrecio" name="txtPrecio" placeholder="Precio" class="form-control input-md" type="number" step="0.01">
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
                <input value="<?php echo $componente['idcomponente']?>" type='hidden' name='idcomponente' id='idcomponente' />
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