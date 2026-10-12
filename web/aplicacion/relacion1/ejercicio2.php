<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

// Parte del controlador

// Número de lanzamientos
define("N", 100);

// Array para guardar las tiradas
$tiradas = array();

// Hacemos 6 lanzamientos usando un bucle for
for ($i = 0; $i < 6; $i++)
{
    $tiradas[] = mt_rand(1, 6);
}

// Array para contar cuántas veces aparece cada lado
$veces = array(0, 0, 0, 0, 0, 0);

// Contador de lanzamientos
$i = 0;

// Hacemos el número de lanzamientos especificado usando un bucle while
while ($i < N)
{
    // Número aleatorio
    $numero = mt_rand();

    // El número aleatorio será dividido entre 6, sumando 1.
    $dado = ($numero % 6) + 1;

    // El resultado se guarda en el array
    $veces[$dado - 1]++;

    $i++;
}


// Parte de la vista

inicioCabecera("TIRO DE DADOS");
cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION");

// los arrays se pasarán como parámetro al cuerpo
cuerpo($tiradas, $veces);
finCuerpo();

// Cabecera por defecto de la página
function cabecera()
{
}

// Función para los contenidos del cuerpo
function cuerpo($tiradas, $veces)
{
?>
    <br><br>
    <h2>Lanzamiento de dados</h2>
    <br>
    <strong>6 lanzamientos del dado:</strong>
    <br><br>
<?php

    // Mostramos las tiradas
    for ($i = 0; $i < count($tiradas); $i++)
    {
        echo "Tirada " . ($i + 1) . ": " . $tiradas[$i];
        echo "<br>";
    }
?>
    <br>
    <h2>Resultado de <?php echo N; ?> lanzamientos</h2>
    <br>

<?php
    // Mostramos cuántas veces ha salido cada lado
    echo "El lado 1 ha salido " . $veces[0] . " veces.";
    echo "<br>";
    echo "El lado 2 ha salido " . $veces[1] . " veces.";
    echo "<br>";
    echo "El lado 3 ha salido " . $veces[2] . " veces.";
    echo "<br>";
    echo "El lado 4 ha salido " . $veces[3] . " veces.";
    echo "<br>";
    echo "El lado 5 ha salido " . $veces[4] . " veces.";
    echo "<br>";
    echo "El lado 6 ha salido " . $veces[5] . " veces.";
    echo "<br><br>";
?>
<?php
}
?>