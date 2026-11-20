<?php

function mostrarFormulario(array $datos): void
{
    $valores = $datos["valores"];
    $errores = $datos["errores"];
    $puntos = $datos["puntos"];

    if ($datos["mensaje"] != "") {
        echo "<p>" . htmlspecialchars($datos["mensaje"], ENT_QUOTES, "UTF-8") . "</p>";
    }

?>

<h2>Añadir un punto</h2>
<form action="index.php" method="POST">
    <input type="hidden" name="accion" value="guardar">
    <fieldset>
        <legend>Coordenadas</legend>
        <label for="x">Coordenada X:</label>
        <input type="number" name="x" id="x" step="any"
            value="<?= htmlspecialchars((string) $valores["x"], ENT_QUOTES, "UTF-8") ?>">

        <?php if (isset($errores["x"])): ?>
            <p class="error">
                <?= htmlspecialchars($errores["x"], ENT_QUOTES, "UTF-8") ?>
            </p>
        <?php endif; ?>

        <label for="y">Coordenada Y:</label>
        <input type="number" name="y" id="y" step="any"
            value="<?= htmlspecialchars((string) $valores["y"], ENT_QUOTES, "UTF-8") ?>"
        >

        <?php if (isset($errores["y"])): ?>
            <p class="error">
                <?= htmlspecialchars($errores["y"], ENT_QUOTES, "UTF-8") ?>
            </p>
        <?php endif; ?>
    </fieldset>


    <fieldset>
        <legend>Color</legend>
        <label for="color">Selecciona un color:</label>
        <select name="color" id="color">
            <option value="">Selecciona un color</option>

            <?php
            // Conservamos el color introducido si no es válido.
            if (
                $valores["color"] != "" &&
                !array_key_exists($valores["color"], Punto::COLORES)
            ):
            ?>

                <option
                    value="<?= htmlspecialchars($valores["color"], ENT_QUOTES, "UTF-8") ?>"
                    selected
                >
                    <?= htmlspecialchars($valores["color"], ENT_QUOTES, "UTF-8") ?>
                </option>

            <?php endif; ?>

            <?php foreach (Punto::COLORES as $codigo => $color): ?>
                <option
                    value="<?= htmlspecialchars($codigo, ENT_QUOTES, "UTF-8") ?>"
                    <?= ($valores["color"] === $codigo) ? "selected" : "" ?>
                >
                    <?= htmlspecialchars($color["nombre"], ENT_QUOTES, "UTF-8") ?>
                </option>

            <?php endforeach; ?>
        </select>

        <?php if (isset($errores["color"])): ?>
            <p class="error">
                <?= htmlspecialchars($errores["color"], ENT_QUOTES, "UTF-8") ?>
            </p>
        <?php endif; ?>
    </fieldset>


    <fieldset>
        <legend>Grosor</legend>
        <?php foreach (Punto::GROSORES as $codigo => $nombre): ?>
            <label>
                <input type="radio" name="grosor" value="<?= $codigo ?>"
                    <?= ((string) $valores["grosor"] === (string) $codigo) ? "checked" : "" ?>
                >

                <?= htmlspecialchars($nombre, ENT_QUOTES, "UTF-8") ?>
            </label>

        <?php endforeach; ?>
        <?php if (isset($errores["grosor"])): ?>
            <p class="error">
                <?= htmlspecialchars($errores["grosor"], ENT_QUOTES, "UTF-8") ?>
                <?php if ($valores["grosor"] != ""): ?>
                    Valor introducido:
                    <?= htmlspecialchars((string) $valores["grosor"], ENT_QUOTES, "UTF-8") ?>
                <?php endif; ?>
            </p>
        <?php endif; ?>
    </fieldset>

    <button type="submit">Guardar punto</button>
</form>

<h2>Borrar un punto</h2>
<form action="index.php" method="POST">
    <input type="hidden" name="accion" value="borrar">
    <label for="indice">Selecciona el punto que quieres borrar:</label>
    <select name="indice" id="indice">
        <?php foreach ($puntos as $indice => $punto): ?>
            <option value="<?= $indice ?>">
                Punto <?= $indice + 1 ?>:
                (<?= $punto->getX() ?>, <?= $punto->getY() ?>)
                - <?= htmlspecialchars(Punto::COLORES[$punto->getColor()]["nombre"], ENT_QUOTES, "UTF-8") ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit" <?= count($puntos) == 0 ? "disabled" : "" ?>>
        Borrar punto
    </button>
</form>

<h2>Importar puntos desde un TXT</h2>

<form action="index.php" method="POST" enctype="multipart/form-data">

    <input type="hidden" name="accion" value="importar">

    <label for="fichero">Selecciona un fichero TXT:</label>

    <input
        type="file"
        name="fichero"
        id="fichero"
        accept=".txt,text/plain"
    >

    <button type="submit">Importar puntos</button>

</form>

<?php
}
?>