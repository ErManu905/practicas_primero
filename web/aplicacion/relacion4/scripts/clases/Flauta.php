<?php
abstract class InstrumentoViento extends InstrumentoBase
{
    // Propiedad protegida que indica el material del instrumento
    protected string $_material = "madera";


    /**
     * Constructor de la clase.
     *
     * @param string $material Material del instrumento.
     * @param int $edad Edad del instrumento.
     */
    public function __construct(string $material = "madera", int $edad = 15)
    {
        $this->_material = $material;

        parent::__construct("instrumento de viento", $edad);
    }


    /**
     * Devuelve los pasos necesarios para afinar el instrumento.
     *
     * Este método no podrá redefinirse en las clases descendientes.
     *
     * @return string Pasos para afinar el instrumento.
     */
    final public function afinar(): string
    {
        return "Para afinar el instrumento de viento, se debe ajustar la embocadura y comprobar las notas.";
    }


    /**
     * Devuelve la información del instrumento de viento.
     *
     * @return string Información del instrumento.
     */
    public function __toString(): string
    {
        return parent::__toString() .
            " Instrumento de material " . $this->_material;
    }
}
?>