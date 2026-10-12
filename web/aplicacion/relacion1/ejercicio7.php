<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

// Este programa no tiene controlador, ya que solo se mostrarán las funciones de fecha individualmente

// Parte de la vista
inicioCabecera("MOSTRAR FUNCIONAMIENTO FECHAS");
cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION");
cuerpo();
finCuerpo();

// Cabecera por defecto
function cabecera() {}

// Función para los contenidos del cuerpo
function cuerpo()
{
// Fechas usando funciones
?>

    <br><br>
    <h2>Fechas usando funciones</h2>
    <br>

<?php
    // Array para los meses
    $meses = array(1 => "enero", 2 => "febrero", 3 => "marzo", 4 => "abril", 5 => "mayo", 6 => "junio",
        7 => "julio", 8 => "agosto", 9 => "septiembre", 10 => "octubre", 11 => "noviembre", 12 => "diciembre");

    // Array para los días
    $dias = array(1 => "lunes", 2 => "martes", 3 => "miércoles", 4 => "jueves", 5 => "viernes",
        6 => "sábado", 7 => "domingo");

    // Mostrar la fecha actual
    echo "<strong>1. Fecha actual</strong><br>";
    echo date("d/m/Y");
    echo "<br><br>";

    // Mostrar la fecha actual en formato largo
    echo "<strong>2. Fecha actual con formato largo</strong><br>";

    $dia = date("d");
    $mes = date("n");
    $ano = date("Y");
    $diaSemana = date("N");

    echo "día " . $dia;
    echo ", mes " . $meses[$mes];
    echo ", año " . $ano;
    echo ", día de la semana " . $dias[$diaSemana];
    echo "<br><br>";

    // Mostrar la hora actual
    echo "<strong>3. Hora actual</strong><br>";
    echo date("H:i:s");
    echo "<br><br>";

    // Mostrar una fecha y hora exacta
    echo "<strong>4. Fecha 29/03/2024 a las 12:45</strong><br>";
    $fecha = strtotime("29/03/2024 12:45");
    echo date("d/m/Y", $fecha);
    echo "<br>";

    $dia = date("d", $fecha);
    $mes = date("n", $fecha);
    $ano = date("Y", $fecha);
    $diaSemana = date("N", $fecha);

    echo "día " . $dia;
    echo ", mes " . $meses[$mes];
    echo ", año " . $ano;
    echo ", día de la semana " . $dias[$diaSemana];
    echo "<br>";
    echo date("H:i:s", $fecha);
    echo "<br><br>";

    // Restar días y horas a la fecha actual

    echo "<strong>5. Fecha actual menos 12 días y 4 horas</strong><br>";

    $fecha = strtotime("-12 days -4 hours");

    echo date("d/m/Y", $fecha);
    echo "<br>";

    $dia = date("d", $fecha);
    $mes = date("n", $fecha);
    $ano = date("Y", $fecha);
    $diaSemana = date("N", $fecha);

    echo "día " . $dia;
    echo ", mes " . $meses[$mes];
    echo ", año " . $ano;
    echo ", día de la semana " . $dias[$diaSemana];

    echo "<br>";
    echo date("H:i:s", $fecha);

//Fechas usando la clase DateTime
?>

    <br><br>
    <hr>
    <br>

    <h2>Fechas usando la clase DateTime</h2>
    <br>

<?php
    // Mostrar la fecha actual
    echo "<strong>1. Fecha actual</strong><br>";
    $fecha = new DateTime();
    echo $fecha->format("d/m/Y");
    echo "<br><br>";

    // Mostrar la fecha actual en formato largo
    echo "<strong>2. Fecha actual con formato largo</strong><br>";
    $dia = $fecha->format("d");
    $mes = $fecha->format("n");
    $ano = $fecha->format("Y");
    $diaSemana = $fecha->format("N");
    echo "día " . $dia;
    echo ", mes " . $meses[$mes];
    echo ", año " . $ano;
    echo ", día de la semana " . $dias[$diaSemana];
    echo "<br><br>";

    // Mostrar la hora actual Hora actual</strong><br>";
    echo $fecha->format("H:i:s");
    echo "<br><br>";

    // Mostrar una fecha y hora exacta
    echo "<strong>4. Fecha 29/03/2024 a las 12:45</strong><br>";
    $fecha = new DateTime("2024-03-29 12:45:00");
    echo $fecha->format("d/m/Y");
    echo "<br>";

    $dia = $fecha->format("d");
    $mes = $fecha->format("n");
    $ano = $fecha->format("Y");
    $diaSemana = $fecha->format("N");

    echo "día " . $dia;
    echo ", mes " . $meses[$mes];
    echo ", año " . $ano;
    echo ", día de la semana " . $dias[$diaSemana];
    echo "<br>";

    echo $fecha->format("H:i:s");
    echo "<br><br>";

    // Restar días y horas a la fecha actual
    echo "<strong>5. Fecha actual menos 12 días y 4 horas</strong><br>";

    $fecha = new DateTime();
    $fecha->modify("-12 days -4 hours");

    echo $fecha->format("d/m/Y");
    echo "<br>";

    $dia = $fecha->format("d");
    $mes = $fecha->format("n");
    $ano = $fecha->format("Y");
    $diaSemana = $fecha->format("N");

    echo "día " . $dia;
    echo ", mes " . $meses[$mes];
    echo ", año " . $ano;
    echo ", día de la semana " . $dias[$diaSemana];
    echo "<br>";

    echo $fecha->format("H:i:s");
?>

    <br><br>

<?php
}
?>