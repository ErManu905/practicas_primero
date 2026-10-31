<?php
/**
 * Enumeración que representa los diferentes estados civiles.
 */
enum EstadoCivil: int
{
    case SOLTERO = 10;
    case CASADO = 20;
    case PAREJA = 30;
    case VIUDO = 40;


    /**
     * Devuelve la descripción del estado civil.
     *
     * @return string Nombre del estado civil.
     */
    public function descripcion(): string
    {
        return strtolower($this->name);
    }


    /**
     * Devuelve el valor numérico del estado civil.
     *
     * @return int Valor del estado civil.
     */
    public function valor(): int
    {
        return $this->value;
    }


    /**
     * Devuelve un array con todos los casos de la enumeración.
     *
     * @return array Casos de EstadoCivil.
     */
    public static function casos(): array
    {
        return self::cases();
    }
}
?>