<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

// Parte del controlador

// Para este primer array, generamos 5 filas usando 2 bucles for
$array1 = array();
for ($i = 1; $i <= 5; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        $array1[] = $i;
    }
}

// Para este segundo array, lo generamos mediante la constante FILAS
define("FILAS", 5);
$array2 = array();
for ($i = 1; $i <= FILAS; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        $array2[] = $i;
    }
}

// Parte de la vista
inicioCabecera("PIRAMIDE");
cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION");

// Los arrays se pasarán como parámetros al cuerpo
cuerpo($array1, $array2);
finCuerpo();

// Cabecera por defecto
function cabecera(){}

// Función para los contenidos del cuerpo
function cuerpo($array1, $array2)
{
?>
    <br><br>
    <h2>Array generado con 5 filas</h2>
    <br>

<?php
    // Recorremos el primer array con foreach
    foreach ($array1 as $valor){echo $valor . " ";}
?>

    <br><br>
    <h2>Array generado utilizando FILAS</h2>
    <br>

<?php
    // Recorremos el segundo array con foreach
    foreach ($array2 as $valor){echo $valor . " ";}
?>

    <br><br>

<?php
}
?>