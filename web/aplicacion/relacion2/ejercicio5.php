
<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

// Controlador

// Cadena de varias líneas usando HEREDOC
$cadena = <<<TEXTO
<h1>Mi página web</h1>
Número de alumnos: 25
Correo electrónico: manuel@gmail.com
<p>Este es un párrafo.</p>
Precio del producto: 125
Correo de contacto: prueba123@correo.es
TEXTO;

// Expresiones regulares
$patronEtiqueta = "/<[^>]+>/";
$patronNumero = "/[0-9]+/";
$patronEmail = "/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/";

// Buscar una etiqueta HTML
$resultadoEtiqueta = array();
preg_match($patronEtiqueta, $cadena, $resultadoEtiqueta, PREG_OFFSET_CAPTURE);

// Buscar un número
$resultadoNumero = array();
preg_match($patronNumero, $cadena, $resultadoNumero, PREG_OFFSET_CAPTURE);

// Buscar un correo electrónico
$resultadoEmail = array();
preg_match($patronEmail, $cadena, $resultadoEmail, PREG_OFFSET_CAPTURE);

// Datos para la vista
$datos = array(
    "cadena" => $cadena,
    "etiqueta" => $resultadoEtiqueta,
    "numero" => $resultadoNumero,
    "email" => $resultadoEmail
);

// Plantilla
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();

inicioCuerpo("2DAW APLICACION", "Inicio > Relación 1 > Ejercicio 5");
cuerpo($datos);
finCuerpo();

// Vista
function cabecera()
{
    ?>
    <h2>Ejercicio 5: Expresiones regulares</h2>
    <?php
}

function cuerpo($datos)
{
    ?>
    <h3>Cadena original</h3>
    <pre><?php
        echo htmlspecialchars($datos["cadena"], ENT_QUOTES, "UTF-8");
    ?></pre>

    <h3>1. Buscar una etiqueta HTML</h3>
    <?php
    if (count($datos["etiqueta"]) > 0) {
        ?>
        <p>Elemento encontrado:
            <?php echo htmlspecialchars($datos["etiqueta"][0][0], ENT_QUOTES, "UTF-8"); ?>
        </p>
        <p>Posición:
            <?php echo $datos["etiqueta"][0][1]; ?>
        </p>
        <?php
    } else {
        echo "<p>No se encontró ninguna etiqueta.</p>";
    }
    ?>

    <h3>2. Buscar un número</h3>
    <?php
    if (count($datos["numero"]) > 0) {
        ?>
        <p>Elemento encontrado:
            <?php echo $datos["numero"][0][0]; ?>
        </p>
        <p>Posición:
            <?php echo $datos["numero"][0][1]; ?>
        </p>
        <?php
    } else {
        echo "<p>No se encontró ningún número.</p>";
    }
    ?>

    <h3>3. Buscar una dirección de correo electrónico</h3>
    <?php
    if (count($datos["email"]) > 0) {
        ?>
        <p>Elemento encontrado:
            <?php echo htmlspecialchars($datos["email"][0][0], ENT_QUOTES, "UTF-8"); ?>
        </p>
        <p>Posición:
            <?php echo $datos["email"][0][1]; ?>
        </p>
        <?php
    } else {
        echo "<p>No se encontró ningún correo electrónico.</p>";
    }
    ?>
    <?php
}
?>