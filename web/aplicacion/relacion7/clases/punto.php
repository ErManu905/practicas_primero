<?php

class Punto
{
    // Colores y sus valores RGB.
    public const COLORES = array(
        "black" => array("nombre" => "Negro", "rgb" => array(0, 0, 0)),
        "red" => array("nombre" => "Rojo", "rgb" => array(255, 0, 0)),
        "green" => array("nombre" => "Verde", "rgb" => array(0, 128, 0)),
        "blue" => array("nombre" => "Azul", "rgb" => array(0, 0, 255)),
        "yellow" => array("nombre" => "Amarillo", "rgb" => array(255, 255, 0))
    );

    // Grosores
    public const GROSORES = array(1 => "fino", 2 => "medio", 3 => "grueso");

    // Datos privados del punto.
    private $x;
    private $y;
    private $color;
    private $grosor;

    // Constructor
    public function __construct($x, $y, $color, $grosor)
    {
        if (!$this->setX($x)) {
            throw new Exception("La coordenada X no es válida.");
        }

        if (!$this->setY($y)) {
            throw new Exception("La coordenada Y no es válida.");
        }

        if (!$this->setColor($color)) {
            throw new Exception("El color no es válido.");
        }

        if (!$this->setGrosor($grosor)) {
            throw new Exception("El grosor no es válido.");
        }
    }

    // Devuelve o modifica la coordenada X.
    public function getX() {return $this->x;}
    public function setX($x) {

        if (!is_int($x) || $x < 0 || $x > 20000) {return false;}
        $this->x = $x;

        return true;
    }

    // Devuelve o modifica la coordenada Y.
    public function getY() {return $this->y;}
    public function setY($y) {

        if (!is_int($y) || $y < 0 || $y > 20000) {return false;}
        $this->y = $y;

        return true;
    }

    // Devuelve o modifica el color.
    public function getColor() {return $this->color;}
    public function setColor($color) {

        if (!is_string($color) || !array_key_exists($color, self::COLORES)) {return false;}
        $this->color = $color;

        return true;
    }

    // Devuelve o modifica el grosor.
    public function getGrosor() {return $this->grosor;}
    public function setGrosor($grosor) {

        if (!is_int($grosor) || !array_key_exists($grosor, self::GROSORES)) {return false;}
        $this->grosor = $grosor;

        return true;
    }
}
?>