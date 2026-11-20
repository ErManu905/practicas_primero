<?php

require_once __DIR__ . "/controladores/controlador.php";

if (!function_exists("imagecreatetruecolor")) {
    exit("La librería GD no está disponible.");
}

$rutaFichero = obtenerRutaDatosR7();

$imagen = imagecreatetruecolor(504, 504);

$blanco = imagecolorallocate($imagen, 255, 255, 255);
$negro = imagecolorallocate($imagen, 0, 0, 0);

imagefill($imagen, 0, 0, $blanco);

imagerectangle($imagen, 0, 0, 503, 503, $negro);


if (file_exists($rutaFichero)) {
    $lineas = file(
        $rutaFichero,
        FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES
    );

    if ($lineas !== false) {
        foreach ($lineas as $linea) {
            $datos = explode(";", $linea);
            if (count($datos) == 4) {
                $x = filter_var(trim($datos[0]), FILTER_VALIDATE_INT);
                $y = filter_var(trim($datos[1]), FILTER_VALIDATE_INT);

                $color = trim($datos[2]);

                $grosor = filter_var(trim($datos[3]), FILTER_VALIDATE_INT);

                if ($x !== false && $y !== false && $grosor !== false &&
                    $x >= 0 && $x <= 500 && $y >= 0 && $y <= 500 &&
                    array_key_exists($color, Punto::COLORES) &&
                    array_key_exists($grosor, Punto::GROSORES)) {

                    $rgb = Punto::COLORES[$color]["rgb"];
                    $colorPunto = imagecolorallocate($imagen, $rgb[0], $rgb[1], $rgb[2]);

                    $tamano = $grosor * 3;

                    imagefilledellipse($imagen, $x + 2, $y + 2, $tamano, $tamano, $colorPunto);
                }
            }
        }
    }
}

header("Content-Type: image/jpeg");
header('Content-Disposition: attachment; filename="puntos.jpg"');

imagejpeg($imagen, null, 90);

imagedestroy($imagen);

exit;