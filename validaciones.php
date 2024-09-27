<?php
// validaciones.php

// Función para validar el correo
function validarCorreo($correo) {
    return filter_var($correo, FILTER_VALIDATE_EMAIL);
}

// Función para validar el módulo
function validarModulo($modulo, $modulos_validos) {
    return in_array($modulo, $modulos_validos);
}

// Función para validar el asunto y la descripción
function validarAsuntoYDescripcion($asunto, $descripcion) {
    return strlen($asunto) <= 50 && !is_numeric($asunto) && strlen($descripcion) <= 300;
}

// Función para validar los temas seleccionados (entre 1 y 3)
function validarTemas($temas) {
    return count($temas) >= 1 && count($temas) <= 3;
}

// Función para evitar ataques XSS
function limpiarEntrada($dato) {
    return htmlspecialchars(trim($dato), ENT_QUOTES, 'UTF-8');
}
?>