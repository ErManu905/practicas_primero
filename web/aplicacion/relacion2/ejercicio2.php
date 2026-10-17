<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

// Controlador
$cadena = "Está la niña en casa";

// 1. Separar cada carácter usando mb_substr
$caracteres = array();
$longitud = mb_strlen($cadena, "UTF-8");


/*
// NO válido para recorrer correctamente todos los caracteres UTF-8:
$caracter = $cadena[$i];

// NO válido para recorrer correctamente todos los caracteres UTF-8:
$caracter = substr($cadena, $i, 1);
*/

// Válido para caracteres UTF-8:
$caracter = mb_substr($cadena, $i, 1, "UTF-8");


for ($i = 0; $i < $longitud; $i++) {
    $caracteres[] = mb_substr($cadena, $i, 1, "UTF-8");
}

// 2. Cadena inversa, índices negativos y mayúsculas/minúsculas
$inverso = array();

for ($i = 0; $i < $longitud; $i++) {
    $caracter = mb_substr($cadena, -($i + 1), 1, "UTF-8");

    if ($i % 2 == 0) {
        $caracter = mb_strtoupper($caracter, "UTF-8");
    } else {
        $caracter = mb_strtolower($caracter, "UTF-8");
    }

    $inverso[] = $caracter;
}

// 3. Separar la cadena por la letra a
$partes = explode("a", $cadena);

// 4. Cambiar el espacio después de "niña" por "/mujer "
$posicion = mb_strpos($cadena, "niña", 0, "UTF-8");

if ($posicion !== false) {
    $posicionEspacio = $posicion + mb_strlen("niña", "UTF-8");

    $cadenaModificada =
        mb_substr($cadena, 0, $posicionEspacio, "UTF-8")
        . "/mujer "
        . mb_substr($cadena, $posicionEspacio + 1, null, "UTF-8");
} else {
    $cadenaModificada = $cadena;
}

// Datos para la vista
$datos = array(
    "cadena" => $cadena,
    "caracteres" => $caracteres,
    "inverso" => $inverso,
    "partes" => $partes,
    "modificada" => $cadenaModificada
);

// Plantilla
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();

inicioCuerpo("2DAW APLICACION", "Inicio > Relación 1 > Ejercicio 2");
cuerpo($datos);
finCuerpo();

// Vista
function cabecera()
{
    ?>
    <h2>Ejercicio 2: Manipulación de cadenas</h2>
    <?php
}

function cuerpo($datos)
{
    ?>
    <h3>Cadena original</h3>
    <p><?php echo htmlspecialchars($datos["cadena"], ENT_QUOTES, "UTF-8"); ?></p>

    <h3>1. Cada carácter en una línea con espacios según su posición</h3>
    <pre><?php
    foreach ($datos["caracteres"] as $i => $caracter) {
        echo str_repeat(" ", $i);
        echo htmlspecialchars($caracter, ENT_QUOTES, "UTF-8") . "\n";
    }
    ?></pre>

    <h3>2. Cadena inversa con índices negativos</h3>
    <pre><?php
    foreach ($datos["inverso"] as $i => $caracter) {
        echo str_repeat(" ", $i);
        echo htmlspecialchars($caracter, ENT_QUOTES, "UTF-8") . "\n";
    }
    ?></pre>

    <h3>3. Separar por la letra «a»</h3>
    <?php foreach ($datos["partes"] as $parte) { ?>
        <p><?php echo htmlspecialchars($parte, ENT_QUOTES, "UTF-8"); ?></p>
    <?php } ?>

    <h3>4. Sustituir el espacio después de «niña»</h3>
    <p><?php echo htmlspecialchars($datos["modificada"], ENT_QUOTES, "UTF-8"); ?></p>
    <?php
}
?>