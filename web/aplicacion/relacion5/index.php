<?php
// Cargamos el controlador y las vistas.
require_once __DIR__ . '/controladores/controlador.php';
require_once __DIR__ . '/vistas/formulario.php';
require_once __DIR__ . '/vistas/resumen.php';

// Inicializamos los valores del formulario.
$valores = obtenerValoresIniciales();
$errores = [];
$correcto = false;

// Comprobamos si se ha enviado el formulario.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Procesamos y validamos los datos recibidos.
    $resultado = procesarFormulario($_POST);

    // Recogemos los valores, errores y resultado.
    $valores = $resultado['valores'];
    $errores = $resultado['errores'];
    $correcto = $resultado['correcto'];
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Relación 5 - Introducción de información</title>

    <style>
        /* Estilos básicos de la página. */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        /* Menú horizontal. */
        .menu ul {
            display: flex;
            list-style: none;
            padding: 10px;
            gap: 20px;
            background-color: #333;
        }

        .menu a {
            color: white;
            text-decoration: none;
        }

        .menu a:hover {
            text-decoration: underline;
        }

        /* Barra de ubicación. */
        .ubicacion {
            margin: 20px 0;
            color: #666;
        }

        /* Mensajes de error. */
        .error {
            color: red;
        }

        /* Separación de los apartados del formulario. */
        fieldset {
            margin-bottom: 15px;
            padding: 15px;
        }

        label {
            display: inline-block;
            margin: 5px;
        }
    </style>

</head>

<body>

    <header>

        <h1>Práctica de PHP - Relación 5</h1>

        <!-- Menú horizontal de navegación. -->
        <nav class="menu">
            <ul>
                <li>
                    <a href="../../index.php">Inicio</a>
                </li>

                <li>
                    <a href="../relacion4/index.php">Relación anterior</a>
                </li>

                <li>
                    <a href="index.php">Relación 5</a>
                </li>
            </ul>
        </nav>

    </header>


    <!-- Barra de ubicación. -->
    <nav class="ubicacion" aria-label="Barra de ubicación">

        <a href="../../index.php">Inicio</a>
        &gt; Aplicación
        &gt; Relación 5
        &gt; Introducción de información

    </nav>


    <main>

        <?php

        // Si todos los datos son correctos, mostramos el resumen.
        if ($correcto) {

            mostrarResumen($valores);

            // Permitimos volver a introducir nuevos datos.
            ?>

            <p>
                <a href="index.php">Introducir nuevos datos</a>
            </p>

            <?php

        } else {

            // Si no hay datos o existen errores, mostramos el formulario.
            mostrarFormulario($valores, $errores);
        }

        ?>

    </main>


    <footer>

        <p>
            <a href="../relacion4/index.php">Volver al apartado anterior</a>
        </p>

    </footer>

</body>
</html>