<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

// Parte del controlador
// Se crea una cadena de varias líneas usando HEREDOC
$cadena = <<<TEXTO
<h1>Mi página web</h1>
Número de alumnos: 25
Correo electrónico: manuel@gmail.com
<p>Este es un párrafo.</p>
Precio del producto: 125
Correo de contacto: prueba123@correo.es
TEXTO;

// Se guardan unas cuantas expresiones regulares en variables
$patronEtiqueta = "/<[^>]+>/";
$patronNumero = "/[0-9]+/";
$patronEmail = "/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\\.[a-zA-Z]{2,}/";

// Se busca una etiqueta HTML siguiendo el patrón pre-establecido
$resultadoEtiqueta = array();
preg_match($patronEtiqueta, $cadena, $resultadoEtiqueta, PREG_OFFSET_CAPTURE);

// Se busca un número siguiendo el patrón pre-establecido
$resultadoNumero = array();
preg_match($patronNumero, $cadena, $resultadoNumero, PREG_OFFSET_CAPTURE);

// Se busca un correo electrónico siguiendo el patrón pre-establecido
$resultadoEmail = array();
preg_match($patronEmail, $cadena, $resultadoEmail, PREG_OFFSET_CAPTURE);

// Se pasan las cadenas creadas a un array que mandaremos por la vista
$datos = array(
    "cadena" => $cadena,
    "etiqueta" => $resultadoEtiqueta,
    "numero" => $resultadoNumero,
    "email" => $resultadoEmail
);

// Parte de la vista
inicioCabecera("PRUEBAS CON EXPRESIONES REGULARES");
cabecera();
finCabecera();

inicioCuerpo("2DAW APLICACION", "Inicio > Relación 2 > Ejercicio 5");
cuerpo($datos);
finCuerpo();

// Parte de la cabecera
function cabecera()
{
    ?>
    <h2>Ejercicio 5: Expresiones regulares</h2>
    <?php
}

// Parte del cuerpo
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
            <?php
            echo mb_strlen(
                mb_strcut($datos["cadena"], 0, $datos["etiqueta"][0][1], "UTF-8"),
                "UTF-8"
            );
            ?>
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
            <?php echo htmlspecialchars($datos["numero"][0][0], ENT_QUOTES, "UTF-8"); ?>
        </p>
        <p>Posición:
            <?php
            echo mb_strlen(
                mb_strcut($datos["cadena"], 0, $datos["numero"][0][1], "UTF-8"),
                "UTF-8"
            );
            ?>
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
            <?php
            echo mb_strlen(
                mb_strcut($datos["cadena"], 0, $datos["email"][0][1], "UTF-8"),
                "UTF-8"
            );
            ?>
        </p>
        <?php
    } else {
        echo "<p>No se encontró ningún correo electrónico.</p>";
    }
    ?>
    <?php
}
?>