<?php

/**
 * Muestra el resumen de los puntos guardados.
 *
 * @param array $datos Datos preparados por el controlador.
 */
function mostrarResumen(array $datos): void
{
    // Recogemos los datos.
    $texto = $datos["texto_puntos"];
    $imagen = $datos["ruta_imagen"];

?>

<h2>Puntos guardados</h2>

<!-- Mostramos los puntos en el textarea. -->
<label for="puntos">Lista de puntos:</label>

<textarea
    id="puntos"
    name="puntos"
    rows="10"
    cols="50"
    readonly
><?= htmlspecialchars($texto, ENT_QUOTES, 'UTF-8') ?></textarea>


<h2>Imagen de los puntos</h2>

<!-- Mostramos la imagen guardada. -->
<img
    src="<?= htmlspecialchars($imagen, ENT_QUOTES, 'UTF-8') ?>"
    alt="Imagen con los puntos guardados"
    width="504"
    height="504"
>


<!-- Enlace para descargar la imagen. -->
<p>
    <a href="imagen.php">Descargar imagen JPG</a>
</p>

<?php
}
?>