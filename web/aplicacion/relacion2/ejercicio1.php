<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

// Parte del controlador
// Variables para probar las cadenas
$nombre = "Manuel";
$edad = 20;

// Pruebas con cadenas con comillas simples y dobles
$cadena1 = 'Hola, me llamo Manuel. Tengo \'20\' años.';
$cadena2 = "Hola, me llamo $nombre. Tengo $edad años.";

// Cadena HEREDOC: este tipo de cadena interpreta las variables
$cadena3 = <<<TEXTO
Hola, soy $nombre.
Tengo $edad años.
Caracteres especiales: á, é, ñ.
Etiquetas HTML: <h1>Hola</h1> y <p>Esto es un párrafo.</p>
TEXTO;

// Cadena NOWDOC: este tipo de cadena NO interpreta las variables
$cadena4 = <<<'TEXTO'
Hola, soy $nombre.
Tengo $edad años.
Caracteres especiales: á, é, ñ.
Etiquetas HTML: <h1>Hola</h1> y <p>Esto es un párrafo.</p>
TEXTO;

// Se pasan las cadenas creadas a un array que mandaremos por la vista
$cadenas = array(
    "Comillas simples" => $cadena1,
    "Comillas dobles" => $cadena2,
    "HEREDOC" => $cadena3,
    "NOWDOC" => $cadena4
);

// Parte de la vista
inicioCabecera("PRUEBAS DE CADENAS");
cabecera();
finCabecera();

inicioCuerpo("2DAW APLICACION", "Inicio > Relación 2 > Ejercicio 1");
cuerpo($cadenas);
finCuerpo();

// Parte de la cabecera
function cabecera()
{
    ?>
    <h2>Ejercicio 1: Cadenas de texto en PHP</h2>
    <?php
}

// Parte del cuerpo
function cuerpo($cadenas)
{
    ?>
    <h3>Tipos de cadenas</h3>

    <?php foreach ($cadenas as $tipo => $cadena) { ?>
        <h4><?php echo $tipo; ?></h4>
        <pre><?php echo htmlspecialchars($cadena, ENT_QUOTES, "UTF-8"); ?></pre>
    <?php } ?>

    <?php
}
?>
