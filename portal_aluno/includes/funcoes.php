<?php

function validarEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function limparTexto($texto) {
    $texto = trim((string) ($texto ?? ""));
    return preg_replace('/\s+/u', ' ', $texto);
}
