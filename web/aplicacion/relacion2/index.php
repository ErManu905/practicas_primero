<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

// Parte del controlador
$ejercicios = array(
    "Ejercicio 1: Cadenas de texto" => "ejercicio1.php",
    "Ejercicio 2: Manipulación de cadenas" => "ejercicio2.php",
    "Ejercicio 3: Cadenas aleatorias" => "ejercicio3.php",
    "Ejercicio 4: Formateo de números" => "ejercicio4.php",
    "Ejercicio 5: Expresiones regulares" => "ejercicio5.php"
);

// Parte de la vista
inicioCabecera("INDEX RELACION 2");
cabecera();
finCabecera();

inicioCuerpo("2DAW APLICACION", "Inicio > Relación 2");
cuerpo($ejercicios);
finCuerpo();

// Parte de la cabecera
function cabecera()
{
    ?>
    <h2>Relación 2: Ejercicios de PHP</h2>
    <?php
}

// Parte del cuerpo
function cuerpo($ejercicios)
{
    ?>
    <h3>Listado de ejercicios</h3>

    <ul>
        <?php foreach ($ejercicios as $titulo => $archivo) { ?>
            <li>
                <a href="<?php echo htmlspecialchars($archivo, ENT_QUOTES, "UTF-8"); ?>">
                    <?php echo htmlspecialchars($titulo, ENT_QUOTES, "UTF-8"); ?>
                </a>
            </li>
        <?php } ?>
    </ul>
    <?php
}
?>
