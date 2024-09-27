<?php
// Recoger datos del formulario
$correo = $_POST['correo'];
$modulo = $_POST['modulo'];
$asunto = $_POST['asunto'];
$descripcion = $_POST['descripcion'];

// Array de módulos válidos para 2º DAW
$modulos_validos = ["DSW", "EIE", "HLC", "DPL", "SRI"];

// Array para almacenar los errores
$errores = [];

// Validación del correo
if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    $errores[] = "El formato del correo no es válido.";
}

// Validación del módulo
if (!in_array($modulo, $modulos_validos)) {
    $errores[] = "El módulo seleccionado no es válido.";
}

// Validación del asunto (máximo 50 caracteres y no puede ser numérico)
if (strlen($asunto) > 50 || is_numeric($asunto)) {
    $errores[] = "El asunto no puede tener más de 50 caracteres ni ser numérico.";
}

// Validación de la descripción (máximo 300 caracteres)
if (strlen($descripcion) > 300) {
    $errores[] = "La descripción no puede tener más de 300 caracteres.";
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

    $file = fopen('data/dudas.csv', 'a');
    $line = '"' . implode('";"', [$correo, $modulo, $asunto, $descripcion]) . '"';
    fwrite($file, $line . "\n");

    fclose($file);

    // Mostrar mensaje de éxito
    echo "<h2>Datos registrados correctamente.</h2>";
    echo '<a href="formulario.php">Enviar otra duda</a>';
}
?>