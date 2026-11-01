<?php
/**
 * Clase que representa a una persona.
 */
class Persona
{
    // Propiedades privadas de la persona
    private string $_nombre;
    private string $_fecha_nacimiento;
    private string $_domicilio;
    private string $_localidad;
    private EstadoCivil $_estado;


    /**
     * Constructor privado de la clase.
     *
     * Inicializa la persona con valores por defecto.
     */
    private function __construct()
    {
        $this->_nombre = "prueba";
        $this->_fecha_nacimiento = "01/01/2000";
        $this->_domicilio = "carrera 12";
        $this->_localidad = "antequera";
        $this->_estado = EstadoCivil::SOLTERO;
    }


    /**
     * Esta función devuelve el nombre de la persona.
     *
     * @return string Nombre de la persona.
     */
    public function getNombre(): string
    {
        return $this->_nombre;
    }


    /**
     * Esta función modifica el nombre de la persona.
     *
     * @param string $nombre Nuevo nombre.
     * @return void
     */
    public function setNombre(string $nombre): void
    {
        $this->_nombre = $nombre;
    }


    /**
     * Esta función devuelve la fecha de nacimiento.
     *
     * @return string Fecha de nacimiento.
     */
    public function getFechaNacimiento(): string
    {
        return $this->_fecha_nacimiento;
    }


    /**
     * Esta función modifica la fecha de nacimiento.
     *
     * @param string $fecha_nacimiento Nueva fecha de nacimiento.
     * @return void
     */
    public function setFechaNacimiento(string $fecha_nacimiento): void
    {
        $this->_fecha_nacimiento = $fecha_nacimiento;
    }


    /**
     * Esta función devuelve el domicilio de la persona.
     *
     * @return string Domicilio de la persona.
     */
    public function getDomicilio(): string
    {
        return $this->_domicilio;
    }


    /**
     * Esta función modifica el domicilio de la persona.
     *
     * @param string $domicilio Nuevo domicilio.
     * @return void
     */
    public function setDomicilio(string $domicilio): void
    {
        $this->_domicilio = $domicilio;
    }


    /**
     * Esta función devuelve la localidad de la persona.
     *
     * @return string Localidad de la persona.
     */
    public function getLocalidad(): string
    {
        return $this->_localidad;
    }


    /**
     * Esta función modifica la localidad de la persona.
     *
     * @param string $localidad Nueva localidad.
     * @return void
     */
    public function setLocalidad(string $localidad): void
    {
        $this->_localidad = $localidad;
    }


    /**
     * Esta función devuelve el estado civil de la persona.
     *
     * @return EstadoCivil Estado civil.
     */
    public function getEstado(): EstadoCivil
    {
        return $this->_estado;
    }


    /**
     * Esta función modifica el estado civil de la persona.
     *
     * @param EstadoCivil $estado Nuevo estado civil.
     * @return void
     */
    public function setEstado(EstadoCivil $estado): void
    {
        $this->_estado = $estado;
    }


    /**
     * Esta función crea una persona con los datos indicados.
     *
     * @param string $nombre Nombre de la persona.
     * @param string $fecha_nacimiento Fecha de nacimiento.
     * @param string $domicilio Domicilio de la persona.
     * @param string $localidad Localidad de la persona.
     * @param EstadoCivil $estado Estado civil de la persona.
     * @return self Nueva persona registrada.
     */
    public static function registrarPersona(
        string $nombre,
        string $fecha_nacimiento,
        string $domicilio,
        string $localidad,
        EstadoCivil $estado
    ): self {
        $persona = new self();

        $persona->setNombre($nombre);
        $persona->setFechaNacimiento($fecha_nacimiento);
        $persona->setDomicilio($domicilio);
        $persona->setLocalidad($localidad);
        $persona->setEstado($estado);

        return $persona;
    }


    /**
     * Esta función devuelve una descripción de la persona.
     *
     * @return string Información de la persona.
     */
    public function toString(): string
    {
        return $this->_nombre .
            " es una persona " . $this->_estado->descripcion() .
            " nacida en " . $this->_fecha_nacimiento .
            " y que vive en " . $this->_localidad;
    }
}
?>