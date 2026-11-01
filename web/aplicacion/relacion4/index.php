<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

// Autocarga de las clases de la Relación 4
spl_autoload_register(function ($clase) {

    $archivo = __DIR__ . "/scripts/clases/" . $clase . ".php";

    if (file_exists($archivo)) {
        require_once($archivo);
    }
});


// Parte del controlador

// Primera prueba: clase InstrumentoBase
$reflexionBase = new ReflectionClass("InstrumentoBase");

$datos["baseAbstracta"] = $reflexionBase->isAbstract();


// Segunda, tercera y cuarta prueba: instrumentos, interfaz y Flauta

// Crear una flauta indicando sus valores
$flauta = Flauta::CrearDesdeArray(array(
    "material" => "madera",
    "edad" => 15
));

// Pruebas de InstrumentoBase
$datos["descripcion"] = $flauta->getDescripcion();
$datos["edadInicial"] = $flauta->getEdad();
$datos["textoFlauta"] = (string) $flauta;

// Comprobar la herencia de InstrumentoViento
$datos["vientoAbstracto"] = (new ReflectionClass("InstrumentoViento"))->isAbstract();

// Pruebas de sonido y afinación
$datos["sonido"] = $flauta->sonido();
$datos["afinar"] = $flauta->afinar();

// Comprobar la interfaz IFabricable
$datos["fabricable"] = $flauta instanceof IFabricable;

$datos["fabricacion"] = $flauta->metodoFabricacion();
$datos["reciclado"] = $flauta->metodoReciclado();

// Aumentar la edad del instrumento
$flauta->envejecer();

$datos["edadEnvejecida"] = $flauta->getEdad();

// Clonar la flauta
$clon = clone $flauta;

$datos["edadClon"] = $clon->getEdad();
$datos["textoClon"] = (string) $clon;

// Crear otra flauta con los valores por defecto
$flautaDefecto = Flauta::CrearDesdeArray(array());

$datos["textoFlautaDefecto"] = (string) $flautaDefecto;


// Quinta prueba: enumeración EstadoCivil y clase Persona

// Obtener todos los casos del estado civil
$casosEstado = EstadoCivil::casos();

$datos["casosEstado"] = array();

foreach ($casosEstado as $estado) {
    $datos["casosEstado"][] = $estado->descripcion() .
        " - " . $estado->valor();
}

// Seleccionar un estado civil aleatorio
$indice = array_rand($casosEstado);
$estadoAleatorio = $casosEstado[$indice];

// Crear una persona mediante el método estático
$persona = Persona::registrarPersona(
    "Persona de prueba",
    "01/01/2000",
    "carrera 12",
    "Antequera",
    $estadoAleatorio
);

// Modificar algunos datos de la persona
$persona->setNombre("Persona modificada");
$persona->setLocalidad("Málaga");

// Recoger los datos de la persona
$datos["persona"] = $persona->toString();
$datos["nombrePersona"] = $persona->getNombre();
$datos["fechaNacimiento"] = $persona->getFechaNacimiento();
$datos["domicilio"] = $persona->getDomicilio();
$datos["localidad"] = $persona->getLocalidad();
$datos["estadoPersona"] = $persona->getEstado()->descripcion();
$datos["valorEstado"] = $persona->getEstado()->valor();


// Sexta prueba: clase SerieFibonacci

// Recorrer la serie mediante Iterator
$serie = array();

foreach (new SerieFibonacci(10) as $valor) {
    $serie[] = $valor;
}

$datos["serie"] = $serie;

// Recorrer la serie mediante el generador
$serieGenerador = array();

foreach (SerieFibonacci::fFibonacci(10) as $valor) {
    $serieGenerador[] = $valor;
}

$datos["serieGenerador"] = $serieGenerador;


// Séptima prueba: clase ClaseMisPropiedades

$objeto = new ClaseMisPropiedades();

// Asignar valores a las propiedades
$objeto->propPublica = "publica";
$objeto->propiedad1 = 25;
$objeto->propiedad2 = "cadena de texto";

// Consultar las propiedades dinámicas
$datos["propiedad1"] = $objeto->propiedad1;
$datos["propiedad2"] = $objeto->propiedad2;
$datos["propPublica"] = $objeto->propPublica;

// Recorrer el objeto mediante foreach
$propiedades = array();

foreach ($objeto as $clave => $valor) {
    $propiedades[$clave] = $valor;
}

$datos["propiedades"] = $propiedades;

// Comprobar que no se puede modificar la propiedad privada
try {
    $objeto->_propPrivada = "privada";
    $datos["errorPrivada"] = "No se ha detectado el error.";
} catch (LogicException $e) {
    $datos["errorPrivada"] = $e->getMessage();
}

// Comprobar que no se puede consultar una propiedad inexistente
try {
    $valor = $objeto->propiedad3;
    $datos["errorPropiedad"] = "No se ha detectado el error.";
} catch (OutOfBoundsException $e) {
    $datos["errorPropiedad"] = $e->getMessage();
}


// Se pasan los resultados a la vista
// Parte de la vista

inicioCabecera("RELACIÓN 4: CLASES, OBJETOS Y ENUMERACIONES");
cabecera();
finCabecera();

inicioCuerpo("2DAW APLICACION", "Inicio > Relación 4");
cuerpo($datos);
finCuerpo();


// Parte de la cabecera
function cabecera()
{
    ?>
    <h2>Relación 4: Clases, objetos y enumeraciones</h2>
    <?php
}


// Parte del cuerpo
function cuerpo($datos)
{
    ?>

    <h3>1. Clase abstracta InstrumentoBase</h3>

    <p>¿Es abstracta la clase InstrumentoBase?
        <?php echo $datos["baseAbstracta"] ? "Sí" : "No"; ?>
    </p>

    <p>Descripción: 
        <?php echo htmlspecialchars($datos["descripcion"], ENT_QUOTES, "UTF-8"); ?>
    </p>

    <p>Edad inicial: <?php echo $datos["edadInicial"]; ?></p>

    <p>Información del instrumento:
        <?php echo htmlspecialchars($datos["textoFlauta"], ENT_QUOTES, "UTF-8"); ?>
    </p>


    <h3>2. Interfaz IFabricable</h3>

    <p>¿La flauta implementa IFabricable?
        <?php echo $datos["fabricable"] ? "Sí" : "No"; ?>
    </p>

    <p>Proceso de fabricación:
        <?php echo htmlspecialchars($datos["fabricacion"], ENT_QUOTES, "UTF-8"); ?>
    </p>

    <p>Proceso de reciclado:
        <?php echo htmlspecialchars($datos["reciclado"], ENT_QUOTES, "UTF-8"); ?>
    </p>


    <h3>3. Clase InstrumentoViento</h3>

    <p>¿Es abstracta InstrumentoViento?
        <?php echo $datos["vientoAbstracto"] ? "Sí" : "No"; ?>
    </p>

    <p>Sonido:
        <?php echo htmlspecialchars($datos["sonido"], ENT_QUOTES, "UTF-8"); ?>
    </p>

    <p>Pasos para afinar:
        <?php echo htmlspecialchars($datos["afinar"], ENT_QUOTES, "UTF-8"); ?>
    </p>


    <h3>4. Clase Flauta</h3>

    <p>Edad después de envejecer: <?php echo $datos["edadEnvejecida"]; ?></p>

    <p>Edad de la flauta clonada: <?php echo $datos["edadClon"]; ?></p>

    <p>Información de la flauta clonada:
        <?php echo htmlspecialchars($datos["textoClon"], ENT_QUOTES, "UTF-8"); ?>
    </p>

    <p>Flauta creada con valores por defecto:
        <?php echo htmlspecialchars($datos["textoFlautaDefecto"], ENT_QUOTES, "UTF-8"); ?>
    </p>


    <h3>5. Enumeración EstadoCivil y clase Persona</h3>

    <p>Casos de EstadoCivil:</p>

    <ul>
        <?php foreach ($datos["casosEstado"] as $caso) { ?>
            <li><?php echo htmlspecialchars($caso, ENT_QUOTES, "UTF-8"); ?></li>
        <?php } ?>
    </ul>

    <p>Persona:
        <?php echo htmlspecialchars($datos["persona"], ENT_QUOTES, "UTF-8"); ?>
    </p>

    <p>Nombre: <?php echo htmlspecialchars($datos["nombrePersona"], ENT_QUOTES, "UTF-8"); ?></p>

    <p>Fecha de nacimiento: <?php echo htmlspecialchars($datos["fechaNacimiento"], ENT_QUOTES, "UTF-8"); ?></p>

    <p>Domicilio: <?php echo htmlspecialchars($datos["domicilio"], ENT_QUOTES, "UTF-8"); ?></p>

    <p>Localidad: <?php echo htmlspecialchars($datos["localidad"], ENT_QUOTES, "UTF-8"); ?></p>

    <p>Estado civil aleatorio:
        <?php echo htmlspecialchars($datos["estadoPersona"], ENT_QUOTES, "UTF-8"); ?>
    </p>

    <p>Valor del estado civil: <?php echo $datos["valorEstado"]; ?></p>


    <h3>6. Clase SerieFibonacci</h3>

    <p>Serie mediante Iterator:</p>

    <p><?php echo implode(" ", $datos["serie"]); ?></p>

    <p>Serie mediante generador:</p>

    <p><?php echo implode(" ", $datos["serieGenerador"]); ?></p>


    <h3>7. Clase ClaseMisPropiedades</h3>

    <p>Propiedad pública: 
        <?php echo htmlspecialchars($datos["propPublica"], ENT_QUOTES, "UTF-8"); ?>
    </p>

    <p>Propiedad 1:
        <?php echo $datos["propiedad1"]; ?>
    </p>

    <p>Propiedad 2:
        <?php echo htmlspecialchars($datos["propiedad2"], ENT_QUOTES, "UTF-8"); ?>
    </p>

    <p>Propiedades recorridas mediante foreach:</p>

    <pre><?php
    foreach ($datos["propiedades"] as $clave => $valor) {
        echo htmlspecialchars($clave, ENT_QUOTES, "UTF-8");
        echo " = ";
        echo htmlspecialchars((string) $valor, ENT_QUOTES, "UTF-8");
        echo "\n";
    }
    ?></pre>

    <p>Intento de modificar la propiedad privada:</p>

    <p><?php echo htmlspecialchars($datos["errorPrivada"], ENT_QUOTES, "UTF-8"); ?></p>

    <p>Intento de consultar una propiedad inexistente:</p>

    <p><?php echo htmlspecialchars($datos["errorPropiedad"], ENT_QUOTES, "UTF-8"); ?></p>

    <?php
}
?>