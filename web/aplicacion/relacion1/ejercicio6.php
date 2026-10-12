<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

// Parte del controlador
$vector = array("primera" => 12.56, 24 => true, 67 => 23.76);

// Parte de la vista
inicioCabecera("SIMULAR FOREACH CON CLAVE-VALOR");
cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION");

// Los arrays se pasarán como parámetros al cuerpo
cuerpo($vector);
finCuerpo();

// Cabecera por defecto
function cabecera() {}

// Función para los contenidos del cuerpo
function cuerpo($vector)
{
?>

    <br><br>
    <h2>Recorrido del array usando funciones de recorrido</h2>
    <br>

<?php
    // Nos colocamos al principio del array
    reset($vector);

    // Mientras haya elementos
    while (key($vector) !== null)
    {
        echo "Indice: " . key($vector);
        echo " - Valor: " . current($vector);
        echo "<br>";

        // Pasamos al siguiente elemento
        next($vector);
    }
?>

    <br>
    <h2>Recorrido usando array_keys y array_values</h2>
    <br>

<?php
    // Obtenemos los índices
    $indices = array_keys($vector);

    // Obtenemos los valores
    $valores = array_values($vector);

    // Recorremos los índices y valores mediante sus posiciones
    for ($i = 0; $i < count($indices); $i++)
    {
        echo "Indice: " . $indices[$i];
        echo " - Valor: " . $valores[$i];
        echo "<br>";
    }
?>

    <br><br>

<?php
}
?>