<?php

include_once(dirname(__FILE__) . "/../../cabecera.php");

require_once __DIR__ . "/controladores/controlador.php";
require_once __DIR__ . "/vistas/formulario.php";
require_once __DIR__ . "/vistas/resumen.php";

$datos = prepararPagina($_SERVER['REQUEST_METHOD'], $_POST, $_FILES);

inicioCabecera("Manejo de Ficheros");
cabecera();
finCabecera();

inicioCuerpo("2DAW APLICACION", "Inicio > Relación 7");
cuerpo($datos);
finCuerpo();

function cabecera() {
    ?>
        <h2>Relación 7: Ficheros</h2>
    <?php
}

function cuerpo($datos) {
    mostrarFormulario($datos);
    mostrarResumen($datos);

    ?>
        <p>
            <a href="../relacion5/index.php">Volver al apartado anterior</a>
        </p>
    <?php
}
?>