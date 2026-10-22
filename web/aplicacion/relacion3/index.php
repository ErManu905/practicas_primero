
<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once(dirname(__FILE__) . "/libreria.php");

// Parte del controlador

// Primera prueba: contar llamadas y actualizar el array
$vector = array();
$numero = 0;
$resultado1 = array();

$resultado1[] = cuentaVeces($vector, "1osición", 7, $numero);
$resultado1[] = array("vector" => $vector, "numero" => $numero);

$resultado1[] = cuentaVeces($vector, "otra", 2, $numero);
$resultado1[] = array("vector" => $vector, "numero" => $numero);

$resultadoError = cuentaVeces($vector, "2daw", 5, $numero);

// Segunda prueba: generar cadenas
$cadena1 = generarCadena(7);
$cadena2 = generarCadena();
$cadenaError = generarCadena(0);

// Tercera prueba: operaciones
$resultadoSuma = operaciones(1, 2, 5, 7, 3, 4);
$resultadoResta = operaciones(2, 20, 5, 3);
$resultadoMultiplicacion = operaciones(3, 2, 3, 4);
$resultadoAlternativo = operaciones(5, 2, 5, 7, 3, 4);

// Cuarta prueba: devolver suma y producto
$valor1 = 7;
$producto1 = devuelve($valor1, 4, 10);

$valor2 = 7;
$producto2 = devuelve($valor2);

$valor3 = 7;
$producto3 = devuelve($valor3, 4);

$valor4 = 7;
$producto4 = devuelve($valor4, tercero: 5);

// Quinta prueba: variable función
$operacionCorrecta = hacerOperacion("resta", 3, 1);
$operacionIncorrecta = hacerOperacion("division", 3, 1);

// Sexta prueba: funciones flecha
$flecha1 = llamadaAFuncion(1, 2, fn($a, $b) => $a + $b);
$flecha2 = llamadaAFuncion(5, 3, fn($a, $b) => $a - $b);
$flecha3 = llamadaAFuncion(4, 6, fn($a, $b) => $a * $b);

// Sexta prueba: funciones anónimas asignadas a variables
$funcionSuma = function ($a, $b) {
    return $a + $b;
};

$funcionResta = function ($a, $b) {
    return $a - $b;
};

$funcionMultiplicacion = function ($a, $b) {
    return $a * $b;
};

$anonima1 = llamadaAFuncion(1, 2, $funcionSuma);
$anonima2 = llamadaAFuncion(5, 3, $funcionResta);
$anonima3 = llamadaAFuncion(4, 6, $funcionMultiplicacion);

// Séptima prueba: ordenar por longitud
$vectorOrdenar = array("uno", "grande", "caminos", "a");
ordenar($vectorOrdenar);

// Se pasan los resultados a la vista
$datos = array(
    "vector" => $vector,
    "numero" => $numero,
    "resultado1" => $resultado1,
    "resultadoError" => $resultadoError,
    "cadena1" => $cadena1,
    "cadena2" => $cadena2,
    "cadenaError" => $cadenaError,
    "resultadoSuma" => $resultadoSuma,
    "resultadoResta" => $resultadoResta,
    "resultadoMultiplicacion" => $resultadoMultiplicacion,
    "resultadoAlternativo" => $resultadoAlternativo,
    "valor1" => $valor1,
    "producto1" => $producto1,
    "valor2" => $valor2,
    "producto2" => $producto2,
    "valor3" => $valor3,
    "producto3" => $producto3,
    "valor4" => $valor4,
    "producto4" => $producto4,
    "operacionCorrecta" => $operacionCorrecta,
    "operacionIncorrecta" => $operacionIncorrecta,
    "flecha1" => $flecha1,
    "flecha2" => $flecha2,
    "flecha3" => $flecha3,
    "anonima1" => $anonima1,
    "anonima2" => $anonima2,
    "anonima3" => $anonima3,
    "vectorOrdenar" => $vectorOrdenar
);

// Parte de la vista
inicioCabecera("RELACIÓN 3: FUNCIONES");
cabecera();
finCabecera();

inicioCuerpo("2DAW APLICACION", "Inicio > Relación 3");
cuerpo($datos);
finCuerpo();

// Parte de la cabecera
function cabecera()
{
    ?>
    <h2>Relación 3: Funciones</h2>
    <?php
}

// Parte del cuerpo
function cuerpo($datos)
{
    ?>
    <h3>1. Función cuentaVeces()</h3>
    <p>Array resultante:</p>
    <pre><?php echo htmlspecialchars(print_r($datos["vector"], true), ENT_QUOTES, "UTF-8"); ?></pre>
    <p>Número de llamada: <?php echo $datos["numero"]; ?></p>
    <p>Prueba con una clave no permitida:
        <?php echo $datos["resultadoError"] ? "Correcta" : "Error detectado"; ?>
    </p>

    <h3>2. Función generarCadena()</h3>
    <p>Cadena de 7 caracteres: <?php echo htmlspecialchars((string) $datos["cadena1"], ENT_QUOTES, "UTF-8"); ?></p>
    <p>Cadena por defecto: <?php echo htmlspecialchars((string) $datos["cadena2"], ENT_QUOTES, "UTF-8"); ?></p>
    <p>Prueba con longitud 0:
        <?php echo $datos["cadenaError"] === false ? "Error detectado" : "Correcta"; ?>
    </p>

    <h3>3. Función operaciones()</h3>
    <p>Suma: <?php echo $datos["resultadoSuma"]; ?></p>
    <p>Resta: <?php echo $datos["resultadoResta"]; ?></p>
    <p>Multiplicación: <?php echo $datos["resultadoMultiplicacion"]; ?></p>
    <p>Operación alternativa: <?php echo $datos["resultadoAlternativo"]; ?></p>

    <h3>4. Función devuelve()</h3>
    <p>Tres parámetros: suma = <?php echo $datos["valor1"]; ?>, producto = <?php echo $datos["producto1"]; ?></p>
    <p>Solo el primer parámetro: suma = <?php echo $datos["valor2"]; ?>, producto = <?php echo $datos["producto2"]; ?></p>
    <p>Primer y segundo parámetros: suma = <?php echo $datos["valor3"]; ?>, producto = <?php echo $datos["producto3"]; ?></p>
    <p>Primer y tercer parámetros: suma = <?php echo $datos["valor4"]; ?>, producto = <?php echo $datos["producto4"]; ?></p>

    <h3>5. Función hacerOperacion()</h3>
    <p>Resta de 3 - 1: <?php echo $datos["operacionCorrecta"]; ?></p>
    <p>Operación no válida:
        <?php echo $datos["operacionIncorrecta"] === false ? "Error detectado" : "Correcta"; ?>
    </p>

    <h3>6. Función llamadaAFuncion()</h3>
    <p>Funciones flecha: <?php echo $datos["flecha1"]; ?>, <?php echo $datos["flecha2"]; ?>, <?php echo $datos["flecha3"]; ?></p>
    <p>Funciones anónimas: <?php echo $datos["anonima1"]; ?>, <?php echo $datos["anonima2"]; ?>, <?php echo $datos["anonima3"]; ?></p>

    <h3>7. Función ordenar()</h3>
    <p>Array ordenado:</p>
    <pre><?php echo htmlspecialchars(print_r($datos["vectorOrdenar"], true), ENT_QUOTES, "UTF-8"); ?></pre>
    <?php
}
?>