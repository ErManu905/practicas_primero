<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

// Parte de la vista
inicioCabecera("INDEX");
cabecera();
finCabecera();

inicioCuerpo("2DAW APLICACION", "Inicio > Relación 1");
cuerpo();
finCuerpo();

// Cabecera por defecto
function cabecera() {}

// Función para los contenidos del cuerpo
function cuerpo()
{
?>
    <br><br>
    <h2>Ejercicios de PHP</h2>
    <br>

    <a href="ejercicio1.php">Ejercicio 1</a>
    <br><br>
    <a href="ejercicio2.php">Ejercicio 2</a>
    <br><br>
    <a href="ejercicio3.php">Ejercicio 3</a>
    <br><br>
    <a href="ejercicio4.php">Ejercicio 4</a>
    <br><br>
    <a href="ejercicio5.php">Ejercicio 5</a>
    <br><br>
    <a href="ejercicio6.php">Ejercicio 6</a>
    <br><br>
    <a href="ejercicio7.php">Ejercicio 7</a>
    <br><br>
<?php
}
?>