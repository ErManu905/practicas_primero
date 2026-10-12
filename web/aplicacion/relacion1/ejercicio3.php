<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

// Parte del controlador

//Este primer array se rellenará mediante varias sentencias
$array1 = array();
$array1[1] = "valor uno";
$array1[16] = "valor dieciseis";
$array1[54] = "valor cincuenta y cuatro";
$array1[] = 34;
$array1["uno"] = "cadena";
$array1["dos"] = true;
$array1["tres"] = 1.345;
$array1["ultima"] = array(1, 34, "nueva");

// Este segundo se hará a través de una sola sentencia "array()"
$array2 = array(1 => "valor uno", 16 => "valor dieciseis", 54 => "valor cincuenta y cuatro", 34,
    "uno" => "cadena", "dos" => true, "tres" => 1.345, "ultima" => array(1, 34, "nueva"));

// Este último se hará a través de un solo par de corchetes
$array3 = [1 => "valor uno", 16 => "valor dieciseis", 54 => "valor cincuenta y cuatro", 34,
    "uno" => "cadena", "dos" => true, "tres" => 1.345, "ultima" => [1, 34, "nueva"]];


// Parte de la vista

inicioCabecera("ARRAYS");
cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION");


// Los arrays se pasarán como parámetros al cuerpo

cuerpo($array1, $array2, $array3);
finCuerpo();


// Cabecera por defecto
function cabecera()
{
}

// Función para los contenidos del cuerpo
function cuerpo($array1, $array2, $array3)
{

?>
    <br><br>
    <h2>Arrays - Varias sentencias</h2>
    <br>

<?php
    foreach ($array1 as $clave => $valor)
    {
        echo "Clave: " . $clave . " - Valor: ";
        if (is_array($valor))
        {
            echo "Array";
        }
        else
        {
            echo $valor;
        }
        echo "<br>";
    }
?>

    <br><br>
    <h2>Arrays - Una sentencia con array()</h2>
    <br>
    
<?php
    foreach ($array2 as $clave => $valor)
    {
        echo "Clave: " . $clave . " - Valor: ";
        if (is_array($valor)){echo "Array";}
        else{echo $valor;}
        echo "<br>";
    }
?>

    <br><br>
    <h2>Arrays - Una sentencia con []</h2>
    <br>

<?php
    foreach ($array3 as $clave => $valor)
    {
        echo "Clave: " . $clave . " - Valor: ";
        if (is_array($valor)){echo "Array";}
        else{echo $valor;}
        echo "<br>";
    }

?>

    <br><br>

<?php
}
?>