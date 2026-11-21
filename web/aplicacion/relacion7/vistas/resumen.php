<?php

function mostrarResumen(array $datos): void
{
    $texto = $datos["texto_puntos"];
    $imagen = $datos["ruta_imagen"];

?>

<h2>Puntos guardados</h2>

<label for="puntos">Lista de puntos:</label>

<textarea id="puntos" name="puntos" rows="10" cols="50" readonly>
    <?= htmlspecialchars($texto, ENT_QUOTES, 'UTF-8') ?>
</textarea>


<h2>Imagen de los puntos</h2>

<img src="<?= htmlspecialchars($imagen, ENT_QUOTES, 'UTF-8') ?>" alt="Imagen con los puntos guardados"
    width="504" height="504">

<p>
    <a href="imagen.php">Descargar imagen JPG</a>
</p>

<?php
}
?>