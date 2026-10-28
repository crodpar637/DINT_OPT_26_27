<?php
include_once("cabecera.html");
?>

<div class="container" id="formularios">
    <div class="row">
        <form class="form-horizontal" action="listado_componentes.php" method="get">
            <fieldset>
                <!-- Form Name -->
                <legend>Buscar componentes por precio</legend>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="txtPrecioMin">Precio mínimo</label>
                    <div class="col-xs-4">
                        <input id="txtPrecioMin" name="txtPrecioMin" placeholder="Precio mínimo" class="form-control input-md" maxlength="25" type="text">
                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="txtPrecioMax">Precio máximo</label>
                    <div class="col-xs-4">
                        <input id="txtPrecioMax" name="txtPrecioMax" placeholder="Precio máximo" class="form-control input-md" maxlength="25" type="text">
                    </div>
                </div>


                <!-- Button -->
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="btnAceptarBuscarComponentesPrecio"></label>
                    <div class="col-xs-4">
                        <input type="submit" id="btnAceptarBuscarComponentesPrecio" name="btnAceptarBuscarComponentesPrecio" class="btn btn-primary" value="Aceptar" />
                    </div>
                </div>
            </fieldset>
        </form>

    </div>
</div>
</body>

</html>