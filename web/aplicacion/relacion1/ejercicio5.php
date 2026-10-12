<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

// Parte del controlador


// Creamos el array
$vector = array();
$vector[1] = "esto es una cadena";
$vector["posi1"] = 25.67;
$vector[] = false;
$vector["ultima"] = array(2, 5, 96);
$vector[56] = 23;


// Parte de la vista
inicioCabecera("MOSTRAR TIPO DEL CONTENIDO");
cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION");

// Los arrays se pasarán como parámetros al cuerpo
cuerpo($vector);
finCuerpo();

// Cabecera por defecto
function cabecera(){}

// Función para los contenidos del cuerpo
function cuerpo($vector)
{
?>

    <br><br>
    <h2>Contenido del array</h2>
    <br>

<?php
    // Recorremos el array
    foreach ($vector as $posicion => $contenido)
    {
        echo "posicion " . $posicion . " contenido (" . gettype($contenido) . ") ";

        // Si es un array
        if (is_array($contenido))
        {
            echo "<br>";
            echo "Contenido del array:";
            echo "<br>";
            foreach ($contenido as $valor)
            {
                echo $valor . " ";
            }
            echo "<br>";

        }

        // Si es un entero
        elseif (is_int($contenido))
        {
            echo "Entero con valor " . $contenido;
            echo ", en binario " . decbin($contenido);
            echo "<br>";
        }

        // Si es un real
        elseif (is_float($contenido))
        {
            echo $contenido;
            echo " que al cuadrado es " . ($contenido * $contenido);
            echo "<br>";

        }

        // Si es una cadena
        elseif (is_string($contenido))
        {
            echo "-" . $contenido . "-";
            echo "<br>";
        }

        // Si es un booleano
        elseif (is_bool($contenido))
        {
            echo $contenido ? "true" : "false";
            echo " y su opuesto ";
            echo $contenido ? "false" : "true";
            echo "<br>";
        }
    }
?>

    <br><br>

<?php
}
?>