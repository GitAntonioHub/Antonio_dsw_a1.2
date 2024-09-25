<?php
$correo = $_POST['correo'];
$modulo = $_POST['modulo'];
$asunto = $_POST['asunto'];
$descripcion = $_POST['descripcion'];

if (!is_dir('data')) {
    mkdir('data', 0777, true);
}

$archivo = 'data/dudas.csv';

$linea = "\"$correo\";\"$modulo\";\"$asunto\";\"$descripcion\"\n";

file_put_contents($archivo, $linea, FILE_APPEND);

echo '<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación</title>
</head>
<body>
    <h1>Duda registrada con éxito</h1>
    <p>Tu duda ha sido registrada correctamente.</p>
    <p><a href="formulario.php">Enviar otra duda</a></p>
</body>
</html>';
?>