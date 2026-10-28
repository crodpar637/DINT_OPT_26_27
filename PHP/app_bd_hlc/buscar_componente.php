
<?php
include_once("cabecera.html");
?>

<div class="container" id="formularios">
    <div class="row">
        <form class="form-horizontal" action="proceso_buscar_componente.php" name="frmBuscarcomponente" id="frmBuscarcomponente" method="get">
            <fieldset>
                <!-- Form Name -->
                <legend>Buscar un componente</legend>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="txtNombreComponente">Nombre</label>
                    <div class="col-xs-4">
                        <input id="txtNombreComponente" name="txtNombreComponente" placeholder="Nombre del componente" class="form-control input-md" type="text">
                    </div>
                </div>
                
                <!-- Button -->
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="btnAceptarBuscarComponente"></label>
                    <div class="col-xs-4">
                        <input type="submit" id="btnAceptarBuscarComponente" name="btnAceptarBuscarComponente" class="btn btn-primary" value="Aceptar" />
                    </div>
                </div>
            </fieldset>
        </form>

    </div>
</div>
</body>

</html>