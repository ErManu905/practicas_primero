<?php
/**
 * Esta clase permite trabajar con propiedades dinámicas e iterar sobre ellas.
 */
class ClaseMisPropiedades implements IteratorAggregate
{
    // Propiedades de la clase
    private array $_propiedades = array();

    public mixed $propPublica = null;

    private mixed $_propPrivada = 25;


    /**
     * Esta función permite consultar las propiedades dinámicas.
     *
     * @param string $nombre Nombre de la propiedad.
     * @return mixed Valor de la propiedad.
     */
    public function __get(string $nombre): mixed
    {
        if (array_key_exists($nombre, $this->_propiedades)) {
            return $this->_propiedades[$nombre];
        }

        throw new OutOfBoundsException("La propiedad " . $nombre . " no existe.");
    }


    /**
     * Esta función permite crear propiedades dinámicas.
     * No permite modificar las propiedades privadas de la clase.
     *
     * @param string $nombre Nombre de la propiedad.
     * @param mixed $valor Valor que se asignará.
     * @return void
     */
    public function __set(string $nombre, mixed $valor): void
    {
        if ($nombre === "_propPrivada" || $nombre === "_propiedades") {
            throw new LogicException("No se puede modificar la propiedad " . $nombre);
        }

        $this->_propiedades[$nombre] = $valor;
    }


    /**
     * Esta función comprueba si existe una propiedad dinámica.
     *
     * @param string $nombre Nombre de la propiedad.
     * @return bool True si existe y false si no existe.
     */
    public function __isset(string $nombre): bool
    {
        return array_key_exists($nombre, $this->_propiedades);
    }


    /**
     * Esta función elimina una propiedad dinámica.
     *
     * @param string $nombre Nombre de la propiedad.
     * @return void
     */
    public function __unset(string $nombre): void
    {
        if ($nombre === "_propPrivada" || $nombre === "_propiedades") {
            throw new LogicException("No se puede eliminar la propiedad " . $nombre);
        }

        unset($this->_propiedades[$nombre]);
    }


    /**
     * Esta función devuelve un iterador con todas las propiedades del objeto.
     *
     * Las claves tendrán el prefijo oi_.
     * Las propiedades públicas y privadas se añaden al final.
     *
     * @return Traversable Iterador de las propiedades.
     */
    public function getIterator(): Traversable
    {
        $elementos = array();

        // Añadir las propiedades dinámicas
        foreach ($this->_propiedades as $clave => $valor) {
            $elementos["oi_" . $clave] = $valor;
        }

        // Añadir las propiedades de la clase al final
        $elementos["oi_propPublica"] = $this->propPublica;
        $elementos["oi__propPrivada"] = $this->_propPrivada;

        return new ArrayIterator($elementos);
    }
}
?>