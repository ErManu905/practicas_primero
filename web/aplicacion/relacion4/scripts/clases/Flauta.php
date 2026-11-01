<?php
/**
 * Clase Flauta que representa un instrumento de viento fabricable.
 */
final class Flauta extends InstrumentoViento implements IFabricable
{
    /**
     * Constructor privado de la clase.
     *
     * @param string $material Material de la flauta.
     * @param int $edad Edad de la flauta.
     */
    private function __construct(string $material = "madera", int $edad = 15)
    {
        parent::__construct($material, $edad);
    }


    /**
     * Crea una flauta a partir de un array asociativo.
     *
     * @param array $datos Datos de la flauta.
     * @return self Nueva instancia de Flauta.
     */
    public static function CrearDesdeArray(array $datos): self
    {
        $material = $datos["material"] ?? "madera";
        $edad = $datos["edad"] ?? 15;

        return new self($material, $edad);
    }


    /**
     * Devuelve el sonido producido por la flauta.
     *
     * @return string Sonido de la flauta.
     */
    public function sonido(): string
    {
        return "La flauta produce un sonido melodioso al soplar por ella.";
    }


    /**
     * Devuelve los pasos necesarios para fabricar la flauta.
     *
     * @return string Pasos de fabricación.
     */
    public function metodoFabricacion(): string
    {
        return "Se prepara el material " . $this->_material .
            ", se corta, se realizan los orificios y se ensamblan las piezas.";
    }


    /**
     * Devuelve el método de reciclado de la flauta.
     *
     * @return string Método de reciclado.
     */
    public function metodoReciclado(): string
    {
        if (strtolower($this->_material) === "madera") {
            return "Se separa la madera y se lleva al punto de reciclaje correspondiente.";
        }

        return "El material " . $this->_material .
            " se separa y se lleva al punto de reciclaje correspondiente.";
    }


    /**
     * Modifica los valores de la flauta después de clonarla.
     *
     * La nueva flauta comienza con edad 0 y recibe
     * un nuevo número de instancia.
     *
     * @return void
     */
    public function __clone(): void
    {
        $this->_edad = 0;

        self::$_totalInstrumentos++;

        $this->_numeroInstancia = self::$_totalInstrumentos;
    }
}
?>