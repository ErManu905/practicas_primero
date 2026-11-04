<?php
// Cargamos la librería de validación.
require_once __DIR__ . '/../scripts/librerias/validacion.php';


/**
 * Devuelve los valores iniciales del formulario.
 *
 * @return array
 */
function obtenerValoresIniciales(): array
{
    return [
        'nombre' => '',
        'contrasena' => '',
        'fechaNacimiento' => '',
        'diaCarnet' => '',
        'mesCarnet' => '',
        'anioCarnet' => '',
        'horaLevantarse' => '',
        'estado' => null,
        'estudios' => [],
        'hermanos' => 0,
        'sueldo' => 1100.0
    ];
}


/**
 * Comprueba y procesa los datos enviados mediante POST.
 *
 * @param array $datos Datos recibidos del formulario.
 * @return array Valores, errores y resultado de la validación.
 */
function procesarFormulario(array $datos): array
{
    // Valores iniciales y array de errores.
    $valores = obtenerValoresIniciales();
    $errores = [];

    /*
     * 1. NOMBRE
     * Máximo 25 caracteres, obligatorio y no puede empezar por H.
     */

    $nombre = $datos['nombre'] ?? '';

    if (!is_string($nombre)) {
        $nombre = '';
    }

    $nombre = trim($nombre);

    $correcto = validaCadena($nombre, 25, '');

    if (!$correcto) {
        $errores['nombre'] = 'El nombre no puede superar los 25 caracteres.';
    } elseif ($nombre === '') {
        $errores['nombre'] = 'El nombre es obligatorio.';
    } elseif (mb_substr(mb_strtoupper($nombre), 0, 1) === 'H') {
        $errores['nombre'] = 'El nombre no puede empezar por H.';
    }

    // Convertimos el nombre a mayúsculas.
    $nombre = mb_strtoupper($nombre);

    $valores['nombre'] = $nombre;


    /*
     * 2. CONTRASEÑA
     * Entre 8 y 15 caracteres.
     * Debe incluir mayúscula, minúscula, número y carácter especial.
     */

    $contrasena = $datos['contrasena'] ?? '';

    if (!is_string($contrasena)) {
        $contrasena = '';
    }

    $correcto = validaCadena($contrasena, 15, '');

    if (!$correcto) {
        $errores['contrasena'] = 'La contraseña no puede superar los 15 caracteres.';
    } else {

        // Expresión regular para comprobar los requisitos.
        $expresion = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[$_\-;<>\@]).{8,15}$/';

        if (!validaExpresion($contrasena, $expresion, '')) {
            $errores['contrasena'] = 'La contraseña debe tener entre 8 y 15 caracteres, una mayúscula, una minúscula, un número y un carácter especial ($_-;<>@).';
        }
    }

    $valores['contrasena'] = $contrasena;


    /*
     * 3. FECHA DE NACIMIENTO
     * Debe ser una fecha válida con formato dd/mm/aaaa.
     */

    $fechaNacimiento = $datos['fechaNacimiento'] ?? '';

    if (!is_string($fechaNacimiento)) {
        $fechaNacimiento = '';
    }

    if (!validaFecha($fechaNacimiento, '')) {
        $errores['fechaNacimiento'] = 'La fecha de nacimiento no es válida.';
    }

    $valores['fechaNacimiento'] = $fechaNacimiento;


    /*
     * 4. FECHA DEL CARNET
     * Recogemos día, mes y año por separado.
     * La persona debe tener al menos 18 años.
     */

    $dia = $datos['diaCarnet'] ?? '';
    $mes = $datos['mesCarnet'] ?? '';
    $anio = $datos['anioCarnet'] ?? '';

    if (!is_scalar($dia) || !is_scalar($mes) || !is_scalar($anio)) {
        $dia = '';
        $mes = '';
        $anio = '';
    }

    $dia = trim((string) $dia);
    $mes = trim((string) $mes);
    $anio = trim((string) $anio);

    $fechaCarnet = '';

    if ($dia === '' || $mes === '' || $anio === '') {

        $errores['fechaCarnet'] = 'Debes introducir el día, mes y año del carnet.';

    } else {

        // Construimos una única fecha.
        $fechaCarnet = $dia . '/' . $mes . '/' . $anio;

        if (!validaFecha($fechaCarnet, '')) {

            $errores['fechaCarnet'] = 'La fecha del carnet no es válida.';

        } else {

            // Comprobamos la fecha de nacimiento y la del carnet.
            if (isset($errores['fechaNacimiento'])) {

                $errores['fechaCarnet'] = 'No se puede comprobar la mayoría de edad sin una fecha de nacimiento válida.';

            } else {

                $nacimiento = DateTime::createFromFormat('!d/m/Y', $fechaNacimiento);
                $carnet = DateTime::createFromFormat('!d/m/Y', $fechaCarnet);

                if ($nacimiento === false || $carnet === false) {

                    $errores['fechaCarnet'] = 'No se han podido comprobar las fechas.';

                } else {

                    // Calculamos la fecha en la que cumple 18 años.
                    $mayoriaEdad = $nacimiento->add(
                        new DateInterval('P18Y')
                    );

                    // El carnet no puede ser anterior a esa fecha.
                    if ($carnet < $mayoriaEdad) {
                        $errores['fechaCarnet'] = 'Debes tener al menos 18 años en la fecha del carnet.';
                    }
                }
            }
        }
    }

    // Guardamos la fecha normalizada en sus tres campos.
    if ($fechaCarnet !== '') {

        $partesFecha = explode('/', $fechaCarnet);

        $dia = $partesFecha[0];
        $mes = $partesFecha[1];
        $anio = $partesFecha[2];
    }

    $valores['diaCarnet'] = $dia;
    $valores['mesCarnet'] = $mes;
    $valores['anioCarnet'] = $anio;


    /*
     * 5. HORA DE LEVANTARSE
     * Debe tener formato hh:mm:ss.
     */

    $hora = $datos['horaLevantarse'] ?? '';

    if (!is_string($hora)) {
        $hora = '';
    }

    if (!validaHora($hora, '')) {
        $errores['horaLevantarse'] = 'La hora introducida no es válida.';
    }

    $valores['horaLevantarse'] = $hora;


    /*
     * 6. ESTADO
     * Debe seleccionarse una opción entre 1 y 4.
     */

    $estadoRaw = $datos['estado'] ?? '';

    $estado = false;

    if (is_scalar($estadoRaw)) {
        $estado = filter_var((string) $estadoRaw, FILTER_VALIDATE_INT);
    }

    if ($estado === false || !validaRango($estado, [1, 2, 3, 4])) {

        $errores['estado'] = 'Debes seleccionar un estado válido.';

        $estado = null;
    }

    $valores['estado'] = $estado;


    /*
     * 7. ESTUDIOS
     * Se permite seleccionar varias opciones.
     * Si se selecciona 0, se eliminan las demás opciones.
     */

    $estudios = $datos['estudios'] ?? [];

    if (!is_array($estudios)) {

        $estudios = [];
        $errores['estudios'] = 'Las opciones de estudios no son válidas.';

    } else {

        $estudiosValidos = [];

        foreach ($estudios as $estudio) {

            // Comprobamos que cada código sea un entero.
            if (!is_scalar($estudio)) {
                $errores['estudios'] = 'Hay una opción de estudios incorrecta.';
                continue;
            }

            $codigo = filter_var((string) $estudio, FILTER_VALIDATE_INT);

            if ($codigo === false || !validaRango($codigo, [0, 1, 2, 3, 4, 5])) {

                $errores['estudios'] = 'Has seleccionado una opción de estudios incorrecta.';

            } else {

                // Evitamos introducir códigos repetidos.
                if (!in_array($codigo, $estudiosValidos, true)) {
                    $estudiosValidos[] = $codigo;
                }
            }
        }

        // Debe seleccionarse al menos una opción.
        if (empty($estudiosValidos)) {

            $errores['estudios'] = 'Debes seleccionar al menos un estudio.';

        } else {

            // Sin estudios es incompatible con las demás opciones.
            if (in_array(0, $estudiosValidos, true)) {
                $estudiosValidos = [0];
            }
        }

        $estudios = $estudiosValidos;
    }

    $valores['estudios'] = $estudios;


    /*
     * 8. HERMANOS
     * Entero entre 0 y 20.
     * Valor por defecto: 0.
     */

    $hermanosRaw = $datos['hermanos'] ?? '0';

    $hermanos = false;

    if (is_scalar($hermanosRaw)) {
        $hermanos = filter_var((string) $hermanosRaw, FILTER_VALIDATE_INT);
    }

    if ($hermanos === false) {

        $errores['hermanos'] = 'El número de hermanos debe ser un entero.';
        $hermanos = 0;

    } elseif (!validaEntero($hermanos, 0, 20, 0)) {

        $errores['hermanos'] = 'El número de hermanos debe estar entre 0 y 20.';
    }

    $valores['hermanos'] = $hermanos;


    /*
     * 9. SUELDO
     * Número real entre 1000 y 150000 euros.
     * Valor por defecto: 1100 euros.
     */

    $sueldoRaw = $datos['sueldo'] ?? '1100';

    $sueldo = 1100.0;

    if (is_scalar($sueldoRaw)) {

        // Permitimos introducir decimales con coma o con punto.
        $sueldoTexto = str_replace(',', '.', trim((string) $sueldoRaw));

        if (is_numeric($sueldoTexto)) {

            $sueldo = (float) $sueldoTexto;

            if (!validaReal($sueldo, 1000.0, 150000.0, 1100.0)) {

                $errores['sueldo'] = 'El sueldo debe estar entre 1000 y 150000 euros.';
            }

        } else {

            $errores['sueldo'] = 'El sueldo debe ser un número válido.';
        }

    } else {

        $errores['sueldo'] = 'El sueldo introducido no es válido.';
    }

    $valores['sueldo'] = $sueldo;


    /*
     * 10. PREPARAMOS LOS TEXTOS PARA EL RESUMEN.
     */

    // Traducción del estado seleccionado.
    $estados = [
        1 => 'Estudiante',
        2 => 'En paro',
        3 => 'Trabajando',
        4 => 'Jubilado'
    ];

    $valores['estadoTexto'] = $estados[$estado] ?? '';

    // Traducción de los estudios seleccionados.
    $opcionesEstudios = [
        0 => 'Sin estudios',
        1 => 'Primaria',
        2 => 'Secundaria',
        3 => 'Bachillerato',
        4 => 'Ciclo formativo',
        5 => 'Universitarios'
    ];

    $valores['estudiosTexto'] = [];

    foreach ($estudios as $codigo) {

        if (isset($opcionesEstudios[$codigo])) {
            $valores['estudiosTexto'][] = $opcionesEstudios[$codigo];
        }
    }


    /*
     * 11. DEVOLVEMOS EL RESULTADO AL INDEX.
     */

    return [
        'valores' => $valores,
        'errores' => $errores,
        'correcto' => empty($errores)
    ];
}
?>