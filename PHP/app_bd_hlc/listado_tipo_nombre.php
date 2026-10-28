<?php
include_once("cabecera.html");
?>


<div class="container" id="formularios">
    <div class="row">
        <form class="form-horizontal" action="listado_tipos.php" method="get">
            <fieldset>
                <!-- Form Name -->
                <legend>Buscar tipos de componentes por nombre</legend>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="txtNombre">Nombre del tipo de componente</label>
                    <div class="col-xs-4">
                        <input id="txtNombre" name="txtNombre" placeholder="Nombre del tipo de componente" class="form-control input-md" maxlength="25" type="text">
                    </div>
                </div>

                <!-- Button -->
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="btnAceptarBuscarTipoComponentesNombre"></label>
                    <div class="col-xs-4">
                        <input type="submit" id="btnAceptarBuscarTipoComponentesNombre" name="btnAceptarBuscarTipoComponentesNombre" class="btn btn-primary" value="Aceptar" />
                    </div>
                </div>
            </fieldset>
        </form>

    </div>
</div>
</body>

</html>