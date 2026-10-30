<?php
class InstrumentoBase
{
    // Propiedades de la clase
    private string $_descripcion;
    protected int $_edad = 10;

    // Contador de instrumentos creados
    protected static int $_totalInstrumentos = 0;

    // Número de orden de creación de la instancia
    protected int $_numeroInstancia;


    /**
     * Constructor de la clase.
     *
     * @param string $descripcion Descripción del instrumento.
     * @param int $edad Edad del instrumento.
     */
    public function __construct(string $descripcion, int $edad = 10)
    {
        $this->_descripcion = $descripcion;
        $this->_edad = $edad;

        self::$_totalInstrumentos++;

        $this->_numeroInstancia = self::$_totalInstrumentos;
    }


    /**
     * Devuelve la descripción del instrumento.
     *
     * @return string Descripción del instrumento.
     */
    public function getDescripcion(): string
    {
        return $this->_descripcion;
    }


    /**
     * Modifica la descripción del instrumento.
     *
     * @param string $descripcion Nueva descripción.
     * @return void
     */
    public function setDescripcion(string $descripcion): void
    {
        $this->_descripcion = $descripcion;
    }


    /**
     * Devuelve la edad del instrumento.
     *
     * @return int Edad del instrumento.
     */
    public function getEdad(): int
    {
        return $this->_edad;
    }


    /**
     * Aumenta la edad del instrumento en un año.
     *
     * @return void
     */
    public function envejecer(): void
    {
        $this->_edad++;
    }


    /**
     * Devuelve el sonido del instrumento.
     * Este método será abstracto en la versión definitiva.
     *
     * @return string Sonido del instrumento.
     */
    public function sonido(): string
    {
        return "El instrumento produce un sonido.";
    }


    /**
     * Devuelve los pasos para afinar el instrumento.
     * Este método será abstracto en la versión definitiva.
     *
     * @return string Pasos para afinar el instrumento.
     */
    public function afinar(): string
    {
        return "Se debe afinar el instrumento.";
    }


    /**
     * Devuelve la información del instrumento al utilizar echo.
     *
     * @return string Información del instrumento.
     */
    public function __toString(): string
    {
        return "instrumento con descripción " . $this->_descripcion .
            ", instancia " . $this->_numeroInstancia .
            " de un total de " . self::$_totalInstrumentos .
            ". Tiene " . $this->_edad .
            " años. La clase es " . get_class($this);
    }


    /**
     * Impide consultar propiedades directamente desde el exterior.
     *
     * @param string $nombre Nombre de la propiedad.
     * @return mixed
     */
    public function __get(string $nombre): mixed
    {
        throw new LogicException("No se puede acceder a la propiedad " . $nombre);
    }


    /**
     * Impide modificar propiedades directamente desde el exterior.
     *
     * @param string $nombre Nombre de la propiedad.
     * @param mixed $valor Valor que se intenta asignar.
     * @return void
     */
    public function __set(string $nombre, mixed $valor): void
    {
        throw new LogicException("No se puede modificar la propiedad " . $nombre);
    }


    /**
     * Impide comprobar propiedades mediante isset.
     *
     * @param string $nombre Nombre de la propiedad.
     * @return bool
     */
    public function __isset(string $nombre): bool
    {
        throw new LogicException("No se puede consultar la propiedad " . $nombre);
    }


    /**
     * Impide eliminar propiedades desde el exterior.
     *
     * @param string $nombre Nombre de la propiedad.
     * @return void
     */
    public function __unset(string $nombre): void
    {
        throw new LogicException("No se puede eliminar la propiedad " . $nombre);
    }
}

?>