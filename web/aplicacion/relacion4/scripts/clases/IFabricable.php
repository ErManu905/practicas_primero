<?php
/**
 * Interfaz que define los métodos de fabricación y reciclado.
 */
interface IFabricable
{
    /**
     * Esta función devuelve los pasos necesarios para fabricar el elemento.
     *
     * @return string Pasos de fabricación.
     */
    public function metodoFabricacion(): string;


    /**
     * Esta función devuelve el método de reciclado del elemento.
     *
     * @return string Método de reciclado.
     */
    public function metodoReciclado(): string;
}

?>