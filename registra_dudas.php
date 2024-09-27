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

// Función para validar el correo
function validarCorreo($correo) {
    return filter_var($correo, FILTER_VALIDATE_EMAIL);
}

// Función para validar el módulo
function validarModulo($modulo, $modulos_validos) {
    return in_array($modulo, $modulos_validos);
}

// Función para validar el asunto (máximo 50 caracteres y no puede ser numérico)
// y la descripción (máximo 300 caracteres)
function validarAsuntoYDescripcion($asunto, $descripcion) {
    return strlen($asunto) <= 50 && !is_numeric($asunto) && strlen($descripcion) <= 300;
}

// Validar correo
if (!validarCorreo($correo)) {
    $errores[] = "El formato del correo no es válido.";
}

// Validar módulo
if (!validarModulo($modulo, $modulos_validos)) {
    $errores[] = "El módulo seleccionado no es válido.";
}

// Validar asunto y descripción
if (!validarAsuntoYDescripcion($asunto, $descripcion)) {
    if (strlen($asunto) > 50 || is_numeric($asunto)) {
        $errores[] = "El asunto no puede tener más de 50 caracteres ni ser numérico.";
    }
    if (strlen($descripcion) > 300) {
        $errores[] = "La descripción no puede tener más de 300 caracteres.";
    }
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