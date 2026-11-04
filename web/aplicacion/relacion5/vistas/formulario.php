<?php
/**
 * Muestra el formulario de introducción de información.
 *
 * @param array $valores Valores que se mostrarán en el formulario.
 * @param array $errores Errores encontrados durante la validación.
 * @return void
 */
function mostrarFormulario(array $valores, array $errores): void
{
?>

<h2>Introducción de información</h2>

<form action="index.php" method="POST">

    <!-- Nombre -->
    <fieldset>
        <legend>Datos personales</legend>

        <label for="nombre">Nombre:</label>
        <input
            type="text"
            name="nombre"
            id="nombre"
            maxlength="25"
            value="<?= htmlspecialchars($valores['nombre'], ENT_QUOTES, 'UTF-8') ?>"
        >

        <?php if (isset($errores['nombre'])): ?>
            <p class="error"><?= htmlspecialchars($errores['nombre'], ENT_QUOTES, 'UTF-8') ?></p>
        <?php endif; ?>


        <!-- Contraseña -->
        <label for="contrasena">Contraseña:</label>
        <input
            type="password"
            name="contrasena"
            id="contrasena"
            maxlength="15"
            value="<?= htmlspecialchars($valores['contrasena'], ENT_QUOTES, 'UTF-8') ?>"
        >

        <?php if (isset($errores['contrasena'])): ?>
            <p class="error"><?= htmlspecialchars($errores['contrasena'], ENT_QUOTES, 'UTF-8') ?></p>
        <?php endif; ?>


        <!-- Fecha de nacimiento -->
        <label for="fechaNacimiento">Fecha de nacimiento (dd/mm/aaaa):</label>
        <input
            type="text"
            name="fechaNacimiento"
            id="fechaNacimiento"
            placeholder="dd/mm/aaaa"
            value="<?= htmlspecialchars($valores['fechaNacimiento'], ENT_QUOTES, 'UTF-8') ?>"
        >

        <?php if (isset($errores['fechaNacimiento'])): ?>
            <p class="error"><?= htmlspecialchars($errores['fechaNacimiento'], ENT_QUOTES, 'UTF-8') ?></p>
        <?php endif; ?>


        <!-- Fecha del carnet -->
        <p>Fecha del carnet:</p>

        <label for="diaCarnet">Día:</label>
        <input
            type="number"
            name="diaCarnet"
            id="diaCarnet"
            min="1"
            max="31"
            value="<?= htmlspecialchars((string) $valores['diaCarnet'], ENT_QUOTES, 'UTF-8') ?>"
        >

        <label for="mesCarnet">Mes:</label>
        <input
            type="number"
            name="mesCarnet"
            id="mesCarnet"
            min="1"
            max="12"
            value="<?= htmlspecialchars((string) $valores['mesCarnet'], ENT_QUOTES, 'UTF-8') ?>"
        >

        <label for="anioCarnet">Año:</label>
        <input
            type="number"
            name="anioCarnet"
            id="anioCarnet"
            value="<?= htmlspecialchars((string) $valores['anioCarnet'], ENT_QUOTES, 'UTF-8') ?>"
        >

        <?php if (isset($errores['fechaCarnet'])): ?>
            <p class="error"><?= htmlspecialchars($errores['fechaCarnet'], ENT_QUOTES, 'UTF-8') ?></p>
        <?php endif; ?>


        <!-- Hora de levantarse -->
        <label for="horaLevantarse">Hora de levantarse (hh:mm:ss):</label>
        <input
            type="text"
            name="horaLevantarse"
            id="horaLevantarse"
            placeholder="hh:mm:ss"
            value="<?= htmlspecialchars($valores['horaLevantarse'], ENT_QUOTES, 'UTF-8') ?>"
        >

        <?php if (isset($errores['horaLevantarse'])): ?>
            <p class="error"><?= htmlspecialchars($errores['horaLevantarse'], ENT_QUOTES, 'UTF-8') ?></p>
        <?php endif; ?>

    </fieldset>


    <!-- Estado -->
    <fieldset>
        <legend>Estado actual</legend>

        <?php
        $estados = [
            1 => 'Estudiante',
            2 => 'En paro',
            3 => 'Trabajando',
            4 => 'Jubilado',
            5 => 'Incorrecta'
        ];
        ?>

        <?php foreach ($estados as $codigo => $texto): ?>

            <label>
                <input
                    type="radio"
                    name="estado"
                    value="<?= $codigo ?>"
                    <?= ($valores['estado'] === $codigo) ? 'checked' : '' ?>
                >
                <?= htmlspecialchars($texto, ENT_QUOTES, 'UTF-8') ?>
            </label>

        <?php endforeach; ?>

        <?php if (isset($errores['estado'])): ?>
            <p class="error"><?= htmlspecialchars($errores['estado'], ENT_QUOTES, 'UTF-8') ?></p>
        <?php endif; ?>

    </fieldset>


    <!-- Estudios -->
    <fieldset>
        <legend>Estudios realizados</legend>

        <?php
        $opcionesEstudios = [
            0 => 'Sin estudios',
            1 => 'Primaria',
            2 => 'Secundaria',
            3 => 'Bachillerato',
            4 => 'Ciclo formativo',
            5 => 'Universitarios',
            6 => 'Incorrecta'
        ];
        ?>

        <?php foreach ($opcionesEstudios as $codigo => $texto): ?>

            <label>
                <input
                    type="checkbox"
                    name="estudios[]"
                    value="<?= $codigo ?>"
                    <?= in_array($codigo, $valores['estudios'], true) ? 'checked' : '' ?>
                >
                <?= htmlspecialchars($texto, ENT_QUOTES, 'UTF-8') ?>
            </label>

        <?php endforeach; ?>

        <?php if (isset($errores['estudios'])): ?>
            <p class="error"><?= htmlspecialchars($errores['estudios'], ENT_QUOTES, 'UTF-8') ?></p>
        <?php endif; ?>

    </fieldset>


    <!-- Hermanos y sueldo -->
    <fieldset>
        <legend>Otros datos</legend>

        <label for="hermanos">Número de hermanos:</label>
        <input
            type="number"
            name="hermanos"
            id="hermanos"
            min="0"
            max="20"
            value="<?= htmlspecialchars((string) $valores['hermanos'], ENT_QUOTES, 'UTF-8') ?>"
        >

        <?php if (isset($errores['hermanos'])): ?>
            <p class="error"><?= htmlspecialchars($errores['hermanos'], ENT_QUOTES, 'UTF-8') ?></p>
        <?php endif; ?>


        <label for="sueldo">Sueldo (€):</label>
        <input
            type="number"
            name="sueldo"
            id="sueldo"
            min="1000"
            max="150000"
            step="0.01"
            value="<?= htmlspecialchars((string) $valores['sueldo'], ENT_QUOTES, 'UTF-8') ?>"
        >

        <?php if (isset($errores['sueldo'])): ?>
            <p class="error"><?= htmlspecialchars($errores['sueldo'], ENT_QUOTES, 'UTF-8') ?></p>
        <?php endif; ?>

    </fieldset>


    <!-- Botón de envío -->
    <button type="submit">Enviar información</button>

</form>

<?php
}
?>