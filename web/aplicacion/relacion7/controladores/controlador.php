<?php

require_once __DIR__ . "/../clases/punto.php";

function obtenerNavegadorR7()
{
    $navegador = $_SERVER["HTTP_USER_AGENT"] ?? "";

    if (strpos($navegador, "Edg") !== false) {return "edge";}
    if (strpos($navegador, "Firefox") !== false) {return "firefox";}
    if (strpos($navegador, "Chrome") !== false) {return "chrome";}
    if (strpos($navegador, "Safari") !== false) {return "safari";}

    return "otro";
}

// Combina la dirección IP y el navegador del cliente.
function obtenerIdentificadorClienteR7()
{
    $ip = $_SERVER["REMOTE_ADDR"] ?? "desconocida";
    $ip = preg_replace("/[^A-Za-z0-9]/", "_", $ip);

    return $ip . "_" . obtenerNavegadorR7();
}

// Devuelve la ruta del fichero que contiene los puntos del cliente.
function obtenerRutaDatosR7()
{
    return __DIR__ . "/../datos/puntos_" .obtenerIdentificadorClienteR7() . ".dat";
}

// Fichero que indica si ya se crearon los puntos iniciales.
function obtenerRutaInicializacionR7()
{
    return __DIR__ . "/../datos/inicializado_" .obtenerIdentificadorClienteR7() . ".txt";
}

// Devuelve la ruta física de la imagen que se guarda en el servidor.
function obtenerRutaImagenR7()
{
    return __DIR__ . "/../imagenes/puntos/imagen_" .obtenerIdentificadorClienteR7() . ".jpg";
}

// Devuelve la ruta que utilizará la etiqueta img del navegador.
function obtenerUrlImagenR7()
{
    return "imagenes/puntos/imagen_" .obtenerIdentificadorClienteR7() . ".jpg";
}

// Crea las carpetas de datos e imágenes cuando todavía no existen.
function crearCarpetasR7()
{
    $carpetas = array(__DIR__ . "/../datos",
        __DIR__ . "/../imagenes/puntos");

    foreach ($carpetas as $carpeta) {
        if (!is_dir($carpeta)) {
            if (!mkdir($carpeta, 0775, true) && !is_dir($carpeta)) {return false;}
        }
    }

    return true;
}

// Guarda todos los puntos con el formato solicitado en el fichero DAT.
function guardarPuntosR7($puntos)
{
    $lineas = array();

    foreach ($puntos as $punto) {
        $lineas[] = $punto->getX() . " ; " . $punto->getY() . " ; " .
            $punto->getColor() . " ; " . $punto->getGrosor();
    }

    $contenido = implode(PHP_EOL, $lineas);

    return file_put_contents(
        obtenerRutaDatosR7(),
        $contenido,
        LOCK_EX
    ) !== false;
}

// Convierte una línea del DAT o TXT en un objeto Punto válido.
function crearPuntoDesdeLineaR7($linea)
{
    $datos = explode(";", $linea);

    if (count($datos) != 4) {return false;}

    $x = filter_var(trim($datos[0]), FILTER_VALIDATE_INT);
    $y = filter_var(trim($datos[1]), FILTER_VALIDATE_INT);
    $color = trim($datos[2]);
    $grosor = filter_var(trim($datos[3]), FILTER_VALIDATE_INT);

    // Comprobamos las coordenadas.
    if (
        $x === false || $x < 0 || $x > 500 ||
        $y === false || $y < 0 || $y > 500 ||
        $grosor === false ||
        !array_key_exists($color, Punto::COLORES) ||
        !array_key_exists($grosor, Punto::GROSORES)
    ) {
        return false;
    }

    try {
        return new Punto($x, $y, $color, $grosor);
    } catch (Exception $e) {
        return false;
    }
}

// Lee el fichero del cliente y devuelve un array de objetos Punto.
function leerPuntosR7()
{
    $puntos = array();
    $ruta = obtenerRutaDatosR7();

    if (!file_exists($ruta) || !is_readable($ruta)) {return $puntos;}

    $lineas = file($ruta, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    if ($lineas === false) {return $puntos;}

    foreach ($lineas as $linea) {

        $punto = crearPuntoDesdeLineaR7($linea);

        if ($punto !== false) {$puntos[] = $punto;}
    }

    return $puntos;
}

// Dibuja los puntos y guarda la imagen JPG en el servidor.
function actualizarImagenR7($puntos)
{
    if (!function_exists("imagecreatetruecolor")) {return false;}

    $imagen = imagecreatetruecolor(504, 504);
    $blanco = imagecolorallocate($imagen, 255, 255, 255);
    $negro = imagecolorallocate($imagen, 0, 0, 0);

    imagefill($imagen, 0, 0, $blanco);
    imagerectangle($imagen, 0, 0, 503, 503, $negro);

    foreach ($puntos as $punto) {

        $rgb = Punto::COLORES[$punto->getColor()]["rgb"];

        $colorPunto = imagecolorallocate($imagen, $rgb[0], $rgb[1], $rgb[2]);

        $tamano = $punto->getGrosor() * 3;

        imagefilledellipse($imagen, $punto->getX() + 2, $punto->getY() + 2, $tamano,
            $tamano, $colorPunto
        );
    }

    $resultado = imagejpeg($imagen, obtenerRutaImagenR7(), 90);

    imagedestroy($imagen);

    return $resultado;
}

// Prepara las carpetas, los tres puntos iniciales y la primera imagen.
function inicializarR7()
{
    if (!crearCarpetasR7()) {
        return false;
    }

    $rutaDatos = obtenerRutaDatosR7();
    $rutaImagen = obtenerRutaImagenR7();
    $rutaMarca = obtenerRutaInicializacionR7();

    $imagenDebeActualizarse = false;

    if (!file_exists($rutaMarca)) {
        if (!file_exists($rutaDatos) || filesize($rutaDatos) == 0) {

            $puntos = array(new Punto(100, 100, "red", 1),
                new Punto(250, 250, "blue", 2), new Punto(400, 400, "green", 3));

            if (!guardarPuntosR7($puntos)) {return false;}

            $imagenDebeActualizarse = true;
        }

        // Guardamos la marca para no volver a crear los puntos iniciales.
        if (file_put_contents($rutaMarca, "inicializado", LOCK_EX) === false) {
            return false;
        }
    }

    if ($imagenDebeActualizarse || !file_exists($rutaImagen)) {actualizarImagenR7(leerPuntosR7());}

    return true;
}

// Procesa la petición y prepara todos los datos que necesitan las vistas.
function prepararPagina($metodo, $post, $files)
{
    $datos["valores"] = array("x" => "",
        "y" => "", "color" => "", "grosor" => "");

    $datos["errores"] = array();
    $datos["mensaje"] = "";

    if (!inicializarR7()) {$datos["mensaje"] = "No se han podido preparar los ficheros.";}

    $puntos = leerPuntosR7();

    // Solo procesamos acciones cuando se ha enviado un formulario.
    if ($metodo == "POST") {

        $accion = "";

        if (isset($post["accion"]) && is_string($post["accion"])) {$accion = $post["accion"];}

        // Añadir un punto nuevo.
        if ($accion == "guardar") {

            $campos = array("x", "y", "color", "grosor");

            foreach ($campos as $campo) {

                if (isset($post[$campo]) && is_scalar($post[$campo])) {
                    $datos["valores"][$campo] = trim((string) $post[$campo]);
                }
            }

            $x = filter_var($datos["valores"]["x"], FILTER_VALIDATE_INT);
            $y = filter_var($datos["valores"]["y"], FILTER_VALIDATE_INT);
            $color = $datos["valores"]["color"];
            $grosor = filter_var($datos["valores"]["grosor"], FILTER_VALIDATE_INT);

            if ($datos["valores"]["x"] == "") {
                $datos["errores"]["x"] = "Introduce la coordenada X.";
            } elseif ($x === false || $x < 0 || $x > 500) {
                $datos["errores"]["x"] = "X debe ser un entero entre 0 y 500.";
            }

            if ($datos["valores"]["y"] == "") {
                $datos["errores"]["y"] = "Introduce la coordenada Y.";
            } elseif ($y === false || $y < 0 || $y > 500) {
                $datos["errores"]["y"] = "Y debe ser un entero entre 0 y 500.";
            }

            if ($color == "" || !array_key_exists($color, Punto::COLORES)) {
                $datos["errores"]["color"] = "Selecciona un color válido.";
            }

            if (
                $datos["valores"]["grosor"] == "" ||
                $grosor === false || !array_key_exists($grosor, Punto::GROSORES)) {
                $datos["errores"]["grosor"] = "Selecciona un grosor válido.";
            }

            if (count($datos["errores"]) == 0) {

                try {

                    $punto = new Punto($x, $y, $color, $grosor);
                    $puntos[] = $punto;

                    if (guardarPuntosR7($puntos)) {

                        if (actualizarImagenR7($puntos)) {
                            $datos["mensaje"] = "El punto se ha guardado correctamente.";
                        } else {
                            $datos["mensaje"] = "El punto se guardó, pero no se pudo actualizar la imagen. Comprueba GD.";
                        }

                        // Limpiamos el formulario.
                        $datos["valores"] = array("x" => "", "y" => "", "color" => "", "grosor" => "");

                    } else {
                        $datos["mensaje"] = "No se ha podido guardar el punto.";
                        $puntos = leerPuntosR7();
                    }

                } catch (Exception $e) {
                    $datos["mensaje"] = "No se ha podido crear el punto.";
                }
            }
        }

        // Borrar el punto que se ha seleccionado.
        elseif ($accion == "borrar") {
            $indice = false;

            if (isset($post["indice"]) && is_scalar($post["indice"])) {
                $indice = filter_var($post["indice"], FILTER_VALIDATE_INT);
            }

            if ($indice === false || !isset($puntos[$indice])) {
                $datos["mensaje"] = "Selecciona un punto válido.";
            } else {

                array_splice($puntos, $indice, 1);

                if (guardarPuntosR7($puntos)) {

                    if (actualizarImagenR7($puntos)) {
                        $datos["mensaje"] = "El punto se ha borrado correctamente.";
                    } else {
                        $datos["mensaje"] = "El punto se borró, pero no se pudo actualizar la imagen. Comprueba GD.";
                    }

                } else {
                    $datos["mensaje"] = "No se ha podido actualizar el fichero.";
                    $puntos = leerPuntosR7();
                }
            }
        }

        // Leer un TXT y añadir únicamente las líneas válidas.
        elseif ($accion == "importar") {

            // Comprobamos que PHP ha recibido correctamente un archivo subido.
            if (
                !isset($files["fichero"]) ||
                !is_array($files["fichero"]) ||
                !isset($files["fichero"]["error"], $files["fichero"]["name"], $files["fichero"]["tmp_name"]) ||
                $files["fichero"]["error"] != UPLOAD_ERR_OK ||
                !is_string($files["fichero"]["name"]) ||
                !is_string($files["fichero"]["tmp_name"]) ||
                !is_uploaded_file($files["fichero"]["tmp_name"])
            ) {

                $datos["mensaje"] = "Selecciona un fichero TXT válido.";

            } else {

                $nombre = $files["fichero"]["name"];
                $temporal = $files["fichero"]["tmp_name"];

                $extension = strtolower(
                    pathinfo($nombre, PATHINFO_EXTENSION)
                );

                if ($extension != "txt") {

                    $datos["mensaje"] = "El archivo debe ser un TXT válido.";

                } else {

                    $lineas = file($temporal, FILE_IGNORE_NEW_LINES);

                    if ($lineas === false) {

                        $datos["mensaje"] = "No se ha podido leer el fichero.";

                    } else {

                        $anadidos = 0;
                        $incorrectos = 0;

                        foreach ($lineas as $linea) {

                            if (trim($linea) == "") {
                                continue;
                            }

                            $punto = crearPuntoDesdeLineaR7($linea);

                            if ($punto !== false) {

                                $puntos[] = $punto;
                                $anadidos++;

                            } else {
                                $incorrectos++;
                            }
                        }


                        if ($anadidos > 0) {

                            if (guardarPuntosR7($puntos)) {

                                if (actualizarImagenR7($puntos)) {
                                    $datos["mensaje"] = "Se han añadido " . $anadidos . " puntos.";
                                } else {
                                    $datos["mensaje"] = "Se guardaron los puntos, pero no se pudo actualizar la imagen. Comprueba GD.";
                                }

                                if ($incorrectos > 0) {
                                    $datos["mensaje"] .= " Se han ignorado " . $incorrectos . " líneas incorrectas.";
                                }

                            } else {

                                $datos["mensaje"] = "No se han podido guardar los puntos importados.";
                                $puntos = leerPuntosR7();
                            }

                        } else {
                            $datos["mensaje"] = "No se encontraron puntos válidos en el fichero.";
                        }
                    }
                }
            }
        }
    }

    // Pasamos los puntos, el texto y la imagen a las vistas.
    $datos["puntos"] = $puntos;

    $datos["texto_puntos"] = "";

    foreach ($puntos as $punto) {

        $datos["texto_puntos"] .= $punto->getX() . " ; " . $punto->getY() . " ; " .
            $punto->getColor() . " ; " . $punto->getGrosor() . "\n";
    }

    $datos["ruta_imagen"] = obtenerUrlImagenR7();

    return $datos;
}

?>