<?php
/**
 * Clase que permite generar y recorrer la serie de Fibonacci.
 */
class SerieFibonacci implements Iterator
{
    // Propiedades privadas de la clase
    private int $_limite;
    private int $_claveActual;


    /**
     * Constructor de la clase.
     *
     * @param int $limite Última posición de la serie que se generará.
     */
    public function __construct(int $limite)
    {
        $this->_limite = $limite;
        $this->_claveActual = 0;
    }


    /**
     * Devuelve el valor actual de la serie.
     *
     * @return int Valor actual de Fibonacci.
     */
    public function current(): int
    {
        return $this->calcularFibonacci($this->_claveActual);
    }


    /**
     * Devuelve la posición actual de la serie.
     *
     * @return int Posición actual.
     */
    public function key(): int
    {
        return $this->_claveActual;
    }


    /**
     * Avanza a la siguiente posición de la serie.
     *
     * @return void
     */
    public function next(): void
    {
        $this->_claveActual++;
    }


    /**
     * Reinicia el recorrido de la serie.
     *
     * @return void
     */
    public function rewind(): void
    {
        $this->_claveActual = 0;
    }


    /**
     * Comprueba si quedan valores por recorrer.
     *
     * @return bool True si quedan valores y false si ha terminado.
     */
    public function valid(): bool
    {
        return $this->_claveActual <= $this->_limite;
    }


    /**
     * Calcula el valor de Fibonacci de una posición.
     *
     * @param int $posicion Posición que se quiere calcular.
     * @return int Resultado de Fibonacci.
     */
    private function calcularFibonacci(int $posicion): int
    {
        if ($posicion === 0) {
            return 0;
        }

        if ($posicion === 1) {
            return 1;
        }

        $anterior = 0;
        $actual = 1;

        for ($i = 2; $i <= $posicion; $i++) {
            $siguiente = $anterior + $actual;

            $anterior = $actual;
            $actual = $siguiente;
        }

        return $actual;
    }


    /**
     * Genera la serie de Fibonacci utilizando un generador.
     *
     * @param int $ultimo Última posición de la serie.
     * @return Generator Generador con los valores de Fibonacci.
     */
    public static function fFibonacci(int $ultimo): Generator
    {
        if ($ultimo < 0) {
            return;
        }

        yield 0;

        if ($ultimo === 0) {
            return;
        }

        yield 1;

        $anterior = 0;
        $actual = 1;

        for ($i = 2; $i <= $ultimo; $i++) {
            $siguiente = $anterior + $actual;

            $anterior = $actual;
            $actual = $siguiente;

            yield $actual;
        }
    }
}
?>