
<?php

/**
 * Esta función añade un valor a un array asociativo y cuenta las llamadas correctas.
 *
 * @param array &$vector Array que se actualizará.
 * @param string $posicion Clave donde se guardará el valor.
 * @param int $valor Número que se guardará.
 * @param int &$numero Número de llamada.
 * @return bool True si todo ha ido bien y false si hay un error.
 */
function cuentaVeces(array &$vector, string $posicion, int $valor, int &$numero): bool
{
    static $llamadas = 0;

    if ($posicion === "2daw" || $posicion === "primera") {
        return false;
    }

    $llamadas++;
    $vector[$posicion] = $valor;
    $numero = $llamadas;

    return true;
}

/**
 * Esta función genera una cadena aleatoria de letras y números.
 *
 * @param int $longitud Longitud de la cadena.
 * @return string|false Cadena generada o false si la longitud no es válida.
 */
function generarCadena(int $longitud = 10): string|false
{
    if ($longitud <= 0) {
        return false;
    }

    $caracteres = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $cadena = "";

    for ($i = 0; $i < $longitud; $i++) {
        $posicion = random_int(0, strlen($caracteres) - 1);
        $cadena .= $caracteres[$posicion];
    }

    return $cadena;
}

/**
 * Esta función realiza una operación con todos los operandos recibidos.
 *
 * @param int $tipo Tipo de operación.
 * @param int|float ...$operandos Números sobre los que se opera.
 * @return int|float|false Resultado o false si faltan operandos.
 */
function operaciones(int $tipo, int|float ...$operandos): int|float|false
{
    if (count($operandos) < 2) {
        return false;
    }

    if ($tipo === 1) {
        return array_sum($operandos);
    }

    if ($tipo === 2) {
        $resultado = $operandos[0];

        for ($i = 1; $i < count($operandos); $i++) {
            $resultado -= $operandos[$i];
        }

        return $resultado;
    }

    if ($tipo === 3) {
        $resultado = 1;

        foreach ($operandos as $operando) {
            $resultado *= $operando;
        }

        return $resultado;
    }

    $pares = 0;
    $impares = 0;

    foreach ($operandos as $i => $operando) {
        if (($i + 1) % 2 == 0) {
            $pares += $operando;
        } else {
            $impares += $operando;
        }
    }

    return $pares - $impares;
}

/**
 * Esta función suma los tres valores pasados por parámetro y devuelve el producto de estos.
 *
 * @param int &$valor Primer valor, que se actualizará con la suma.
 * @param int $segundo Segundo valor, por defecto 4.
 * @param int $tercero Tercer valor, por defecto 10.
 * @return int Producto de los tres valores originales.
 */
function devuelve(int &$valor, int $segundo = 4, int $tercero = 10): int
{
    $producto = $valor * $segundo * $tercero;
    $valor = $valor + $segundo + $tercero;

    return $producto;
}

/**
 * Esta función suma dos números enteros.
 *
 * @param int $a Primer número.
 * @param int $b Segundo número.
 * @return int Resultado de la suma.
 */
function suma(int $a, int $b): int
{
    return $a + $b;
}

/**
 * Esta función resta dos números enteros.
 *
 * @param int $a Primer número.
 * @param int $b Segundo número.
 * @return int Resultado de la resta.
 */
function resta(int $a, int $b): int
{
    return $a - $b;
}

/**
 * Esta función multiplica dos números enteros.
 *
 * @param int $a Primer número.
 * @param int $b Segundo número.
 * @return int Resultado de la multiplicación.
 */
function multiplicacion(int $a, int $b): int
{
    return $a * $b;
}

/**
 * Esta función ejecuta una operación usando una variable de función.
 *
 * @param string $operacion Nombre de la operación.
 * @param int $a Primer operando.
 * @param int $b Segundo operando.
 * @return int|false Resultado o false si la operación no es válida.
 */
function hacerOperacion(string $operacion, int $a, int $b): int|false
{
    if (
        $operacion !== "suma" &&
        $operacion !== "resta" &&
        $operacion !== "multiplicacion"
    ) {
        return false;
    }

    $funcion = $operacion;

    return $funcion($a, $b);
}

/**
 * Esta función llama a una función de callback con dos operandos.
 *
 * @param int $a Primer operando.
 * @param int $b Segundo operando.
 * @param callable $callback Función que se ejecutará.
 * @return int Resultado de la función callback.
 */
function llamadaAFuncion(int $a, int $b, callable $callback): int
{
    return $callback($a, $b);
}

/**
 * Esta función ordena un array de mayor a menor según la longitud de sus elementos.
 *
 * @param array &$vector Array que se ordenará.
 * @return void
 */
function ordenar(array &$vector): void
{
    usort($vector, function ($a, $b) {
        return strlen($b) <=> strlen($a);
    });
}
?>