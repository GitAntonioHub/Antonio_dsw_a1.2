<?php

require_once 'validaciones.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'GET') {
    
    $correo = isset($_REQUEST['correo']) ? limpiarEntrada($_REQUEST['correo']) : null;
    $modulo = isset($_REQUEST['modulo']) ? limpiarEntrada($_REQUEST['modulo']) : null;
    $asunto = isset($_REQUEST['asunto']) ? limpiarEntrada($_REQUEST['asunto']) : null;
    $descripcion = isset($_REQUEST['descripcion']) ? limpiarEntrada($_REQUEST['descripcion']) : null;
    $temas = isset($_REQUEST['temas']) ? array_map('limpiarEntrada', $_REQUEST['temas']) : [];

    $modulos_validos = ["DSW", "EIE", "HLC", "DPL", "SRI"];

    $errores = [];

    if (!$correo || !validarCorreo($correo)) {
        $errores[] = "El formato del correo no es válido.";
    }

    if (!$modulo || !validarModulo($modulo, $modulos_validos)) {
        $errores[] = "El módulo seleccionado no es válido.";
    }

    if (!$asunto || !$descripcion || !validarAsuntoYDescripcion($asunto, $descripcion)) {
        if (strlen($asunto) > 50 || is_numeric($asunto)) {
            $errores[] = "El asunto no puede tener más de 50 caracteres ni ser numérico.";
        }
        if (strlen($descripcion) > 300) {
            $errores[] = "La descripción no puede tener más de 300 caracteres.";
        }
    }

    if (!validarTemas($temas)) {
        $errores[] = "Debe seleccionar entre 1 y 3 temas.";
    }

    if (!empty($errores)) {
        echo "<h2>Se han detectado los siguientes errores:</h2>";
        echo "<ul>";
        foreach ($errores as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul>";
        echo '<a href="formulario.php">Volver al formulario</a>';
    } else {
        if (!is_dir('data')) {
            mkdir('data');
        }

        $temas_seleccionados = implode(',', $temas);
        $file = fopen('data/dudas.csv', 'a');
        $line = '"' . implode('";"', [$correo, $modulo, $asunto, $descripcion, $temas_seleccionados]) . '"';
        fwrite($file, $line . "\n");

        fclose($file);

        echo "<h2>Datos registrados correctamente.</h2>";
        echo '<a href="formulario.php">Enviar otra duda</a>';
    }

} else {
    echo "<h2>Acceso no permitido. Por favor, complete el formulario primero.</h2>";
    echo '<a href="formulario.php">Volver al formulario</a>';
}
?>