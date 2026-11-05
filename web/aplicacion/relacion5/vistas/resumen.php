<?php
/**
 * Muestra el resumen de los datos introducidos.
 *
 * @param array $valores Datos validados del formulario.
 * @return void
 */
function mostrarResumen(array $valores): void
{
?>

<h2>Resumen de información</h2>

<p>Los datos se han introducido correctamente.</p>

<fieldset>
    <legend>Datos personales</legend>

    <p>
        <strong>Nombre:</strong>
        <?= htmlspecialchars($valores['nombre'], ENT_QUOTES, 'UTF-8') ?>
    </p>

    <p>
        <strong>Fecha de nacimiento:</strong>
        <?= htmlspecialchars($valores['fechaNacimiento'], ENT_QUOTES, 'UTF-8') ?>
    </p>

    <p>
        <strong>Fecha del carnet:</strong>
        <?= htmlspecialchars(
            $valores['diaCarnet'] . '/' .
            $valores['mesCarnet'] . '/' .
            $valores['anioCarnet'],
            ENT_QUOTES,
            'UTF-8'
        ) ?>
    </p>

    <p>
        <strong>Hora de levantarse:</strong>
        <?= htmlspecialchars($valores['horaLevantarse'], ENT_QUOTES, 'UTF-8') ?>
    </p>

</fieldset>


<fieldset>
    <legend>Situación actual</legend>

    <p>
        <strong>Estado:</strong>
        <?= htmlspecialchars($valores['estadoTexto'], ENT_QUOTES, 'UTF-8') ?>
    </p>

    <p><strong>Estudios:</strong></p>

    <ul>
        <?php foreach ($valores['estudiosTexto'] as $estudio): ?>

            <li>
                <?= htmlspecialchars($estudio, ENT_QUOTES, 'UTF-8') ?>
            </li>

        <?php endforeach; ?>
    </ul>

</fieldset>


<fieldset>
    <legend>Otros datos</legend>

    <p>
        <strong>Número de hermanos:</strong>
        <?= htmlspecialchars((string) $valores['hermanos'], ENT_QUOTES, 'UTF-8') ?>
    </p>

    <p>
        <strong>Sueldo:</strong>
        <?= number_format($valores['sueldo'], 2, ',', '.') ?> €
    </p>

</fieldset>

<?php
}
?>