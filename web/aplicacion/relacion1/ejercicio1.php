<?php

include_once(dirname(__FILE__) . "/../../cabecera.php");

// Funciones para iniciar el programa web
inicioCabecera("FUNCIONES MATEMATICAS");
cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION", "Inicio > Relación 1 > Ejercicio 1");
cuerpo();
finCuerpo();
function cabecera() {}

// Cuerpo de la página
function cuerpo()
{
?>
    <h2>Funciones matemáticas</h2>
    <br>
<?php
    // Este número será usado para las pruebas matemáticas
    $numero = 7.6;
    echo "Número utilizado: " . $numero;
    echo "<br>";

    // Función de redondeo 
    echo "<strong>round()</strong>";
    echo "<br>";
    echo "Redondear 7.6: " . round($numero);
    echo "<br>";

    // Función de redondeo hacia abajo
    echo "<strong>floor()</strong>";
    echo "<br>";
    echo "Redondear" . $numero . "hacia abajo: " . floor($numero);
    echo "<br>";

    // Función de potencias
    echo "<strong>pow()</strong>";
    echo "<br>";
    echo $numero . " elevado a 3: " . pow($numero, 3);
    echo "<br><br>";

    // Función de raíz cuadrada
    echo "<strong>sqrt()</strong>";
    echo "<br>";
    echo "Raíz cuadrada de 25: " . sqrt(25);
    echo "<br>";

    // Función de redondeo hacia arriba
    echo "<strong>ceil()</strong>";
    echo "<br>";
    echo "Redondear 7.2 hacia arriba: " . ceil(7.2);
    echo "<br>";


    // Función de valor absoluto
    $negativo = -$numero;
    echo "<strong>abs()</strong>";
    echo "<br>";
    echo "Valor absoluto de -15" . $negativo .": " . abs($negativo);
    echo "<br>";

    // Función para pasar de número entero a decimal
    echo "<strong>dechex()</strong>";
    echo "<br>";
    $entero = 255;
    echo "El número decimal " . $entero . " en hexadecimal es: " . dechex($entero);
    echo "<br>";


    // Función para pasar un número de una base a otra
    echo "<strong>base_convert()</strong>";
    echo "<br>";
    $numeroBase4 = "123";
    echo "El número " . $numeroBase4 . " de base 4 en base 8 es: " . base_convert($numeroBase4, 4, 8);
    echo "<br>";

    // Definición de variables en diferentes bases
    echo "<h2>Variables en diferentes bases</h2>";
    echo "<br>";

    // Variable binaria
    $binario = 0b1010;
    echo "<strong>Variable binaria:</strong>";
    echo "<br>";
    echo "Valor decimal: " . $binario;
    echo "<br>";
    echo "Valor en binario: " . decbin($binario);
    echo "<br>";

    // Variable octal
    $octal = 012;
    echo "<strong>Variable octal:</strong>";
    echo "<br>";
    echo "Valor decimal: " . $octal;
    echo "<br>";
    echo "Valor en octal: " . decoct($octal);
    echo "<br>";

    // Variable hexadecimal
    $hexadecimal = 0x1A;
    echo "<strong>Variable hexadecimal:</strong>";
    echo "<br>";
    echo "Valor decimal: " . $hexadecimal;
    echo "<br>";
    echo "Valor en hexadecimal: " . dechex($hexadecimal);
    echo "<br>";
?>
<?php
}
?>