
<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

// Controlador
$nombre = "Manuel";
$edad = 20;

// Cadenas con comillas simples y dobles
$cadena1 = 'Hola, me llamo Manuel. Tengo \'20\' años.';
$cadena2 = "Hola, $nombre. Tienes $edad años.";

// Cadena HEREDOC: interpreta las variables
$cadena3 = <<<TEXTO
Hola, $nombre.
Tienes $edad años.
Caracteres especiales: á, é, ñ.
Etiquetas HTML: <h1>Hola</h1> y <p>Esto es un párrafo.</p>
TEXTO;

// Cadena NOWDOC: no interpreta las variables
$cadena4 = <<<'TEXTO'
Hola, $nombre.
Tienes $edad años.
Caracteres especiales: á, é, ñ.
Etiquetas HTML: <h1>Hola</h1> y <p>Esto es un párrafo.</p>
TEXTO;

// Datos que se pasan a la vista
$cadenas = array(
    "Comillas simples" => $cadena1,
    "Comillas dobles" => $cadena2,
    "HEREDOC" => $cadena3,
    "NOWDOC" => $cadena4
);

// Dibuja la plantilla
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();

inicioCuerpo("2DAW APLICACION", "Inicio > Relación 1 > Ejercicio 1");
cuerpo($cadenas);
finCuerpo();

// Vista
function cabecera()
{
    ?>
    <h2>Ejercicio 1: Cadenas de texto en PHP</h2>
    <?php
}

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
