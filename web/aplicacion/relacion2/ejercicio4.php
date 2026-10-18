<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

// Parte del controlador
$valor1 = 17.5;
$valor2 = 379987.24;

// Dar formato a los números
$numero1 = number_format($valor1, 1, ",", "");
$numero2 = number_format($valor2, 2, ",", ".");

// Rellenar los numeros creados anteriormente hasta 15 caracteres
$numero1 = str_pad($numero1, 15, "0", STR_PAD_LEFT);
$numero2 = str_pad($numero2, 15, " ", STR_PAD_LEFT);

// Se pasan las cadenas creadas a un array que mandaremos por la vista
$datos = array(
    "numero1" => $numero1,
    "numero2" => $numero2
);

// Parte de la vista
inicioCabecera("FORMATEO DE NÚMEROS");
cabecera();
finCabecera();

inicioCuerpo("2DAW APLICACION", "Inicio > Relación 2 > Ejercicio 4");
cuerpo($datos);
finCuerpo();

// Parte de la cabecera
function cabecera()
{
    ?>
    <h2>Ejercicio 4: Formateo de números</h2>
    <?php
}

// Parte del cuerpo
function cuerpo($datos)
{
    ?>
    <pre>el primer valor -<?php echo $datos["numero1"]; ?>-, el segundo valor -<?php echo $datos["numero2"]; ?>-</pre>
    <?php
}
?>