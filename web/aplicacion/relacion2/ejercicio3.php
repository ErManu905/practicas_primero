<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

// Controlador

// a) Array con todos los caracteres permitidos
$caracteres = array();

for ($i = 0; $i < 26; $i++) {
    $caracteres[] = chr(97 + $i); // Letras minúsculas
}

for ($i = 0; $i < 26; $i++) {
    $caracteres[] = chr(65 + $i); // Letras mayúsculas
}

for ($i = 0; $i < 10; $i++) {
    $caracteres[] = chr(48 + $i); // Números
}

// Generar cadena aleatoria de 20 caracteres
$cadena1 = "";

for ($i = 0; $i < 20; $i++) {
    $posicion = random_int(0, count($caracteres) - 1);
    $cadena1 .= $caracteres[$posicion];
}


// b) Generar caracteres a partir del código ASCII
$cadena2 = "";

for ($i = 0; $i < 20; $i++) {
    do {
        $codigo = random_int(48, 122);
    } while (
        !($codigo >= 48 && $codigo <= 57) &&
        !($codigo >= 65 && $codigo <= 90) &&
        !($codigo >= 97 && $codigo <= 122)
    );

    $cadena2 .= chr($codigo);
}

// Datos para la vista
$datos = array(
    "cadena1" => $cadena1,
    "cadena2" => $cadena2,
    "caracteres" => $caracteres
);

// Plantilla
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();

inicioCuerpo("2DAW APLICACION", "Inicio > Relación 1 > Ejercicio 3");
cuerpo($datos);
finCuerpo();

// Vista
function cabecera()
{
    ?>
    <h2>Ejercicio 3: Cadenas aleatorias</h2>
    <?php
}

function cuerpo($datos)
{
    ?>
    <h3>a) Mediante un array de caracteres</h3>

    <p>Caracteres permitidos: <?php
        echo htmlspecialchars(implode("", $datos["caracteres"]), ENT_QUOTES, "UTF-8");
    ?></p>

    <p>Cadena aleatoria:</p>
    <pre><?php echo htmlspecialchars($datos["cadena1"], ENT_QUOTES, "UTF-8"); ?></pre>

    <h3>b) Mediante códigos ASCII</h3>

    <p>Cadena aleatoria:</p>
    <pre><?php echo htmlspecialchars($datos["cadena2"], ENT_QUOTES, "UTF-8"); ?></pre>
    <?php
}
?>