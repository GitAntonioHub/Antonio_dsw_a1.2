<?php

function validarCorreo($correo) {
    return filter_var($correo, FILTER_VALIDATE_EMAIL);
}

function validarModulo($modulo, $modulos_validos) {
    return in_array($modulo, $modulos_validos);
}

function validarAsuntoYDescripcion($asunto, $descripcion) {
    return strlen($asunto) <= 50 && !is_numeric($asunto) && strlen($descripcion) <= 300;
}

function validarTemas($temas) {
    return count($temas) >= 1 && count($temas) <= 3;
}

function limpiarEntrada($dato) {
    return htmlspecialchars(trim($dato), ENT_QUOTES, 'UTF-8');
}
?>