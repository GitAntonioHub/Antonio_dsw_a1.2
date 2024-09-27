<?php
// Incluir las funciones de validación
require_once 'validaciones.php';

// Verificar si se ha accedido por GET o POST y si se han remitido datos del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'GET') {
    
    // Recoger datos, limpian entradas para evitar XSS
    $correo = isset($_REQUEST['correo']) ? limpiarEntrada($_REQUEST['correo']) : null;
    $modulo = isset($_REQUEST['modulo']) ? limpiarEntrada($_REQUEST['modulo']) : null;
    $asunto = isset($_REQUEST['asunto']) ? limpiarEntrada($_REQUEST['asunto']) : null;
    $descripcion = isset($_REQUEST['descripcion']) ? limpiarEntrada($_REQUEST['descripcion']) : null;
    $temas = isset($_REQUEST['temas']) ? array_map('limpiarEntrada', $_REQUEST['temas']) : [];

    // Array de módulos válidos para 2º DAW
    $modulos_validos = ["DSW", "EIE", "HLC", "DPL", "SRI"];

    // Array para almacenar los errores
    $errores = [];

    // Validar correo
    if (!$correo || !validarCorreo($correo)) {
        $errores[] = "El formato del correo no es válido.";
    }

    // Validar módulo
    if (!$modulo || !validarModulo($modulo, $modulos_validos)) {
        $errores[] = "El módulo seleccionado no es válido.";
    }

    // Validar asunto y descripción
    if (!$asunto || !$descripcion || !validarAsuntoYDescripcion($asunto, $descripcion)) {
        if (strlen($asunto) > 50 || is_numeric($asunto)) {
            $errores[] = "El asunto no puede tener más de 50 caracteres ni ser numérico.";
        }
        if (strlen($descripcion) > 300) {
            $errores[] = "La descripción no puede tener más de 300 caracteres.";
        }
    }

    // Validar temas
    if (!validarTemas($temas)) {
        $errores[] = "Debe seleccionar entre 1 y 3 temas.";
    }

    // Comprobar si hay errores
    if (!empty($errores)) {
        // Mostrar errores y un enlace para volver al formulario
        echo "<h2>Se han detectado los siguientes errores:</h2>";
        echo "<ul>";
        foreach ($errores as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul>";
        echo '<a href="formulario.php">Volver al formulario</a>';
    } else {
        // Si no hay errores, almacenar los datos en el archivo dudas.csv
        if (!is_dir('data')) {
            mkdir('data');
        }

        // Convertir los temas seleccionados en una cadena entrecomillada y separada por comas
        $temas_seleccionados = implode(',', $temas);
        $file = fopen('data/dudas.csv', 'a');
        $line = '"' . implode('";"', [$correo, $modulo, $asunto, $descripcion, $temas_seleccionados]) . '"';
        fwrite($file, $line . "\n");

        fclose($file);

        // Mostrar mensaje de éxito
        echo "<h2>Datos registrados correctamente.</h2>";
        echo '<a href="formulario.php">Enviar otra duda</a>';
    }

} else {
    // Si no hay datos de formulario, mostrar un mensaje de error
    echo "<h2>Acceso no permitido. Por favor, complete el formulario primero.</h2>";
    echo '<a href="formulario.php">Volver al formulario</a>';
}
?>