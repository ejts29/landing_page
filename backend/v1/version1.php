<?php
// Ruta: backend/v1/version1.php

// Obtenemos la URL sin dominio
$_ruta = $_SERVER['REQUEST_URI'];

// Explota la ruta por "/"
$_explode = explode("/", $_ruta);

// Sacamos los datos de la URL
$_version = $_explode[5] ?? "";
$_mantenedor = $_explode[6] ?? "";
$_parametros = explode("?", $_explode[7] ?? "");
$_metodo = $_SERVER['REQUEST_METHOD'];
$_header = getallheaders()['Authorization'] ?? "";

// Tokens simulados
$_token_get = "abc123";
$_token_get_eva = "xyz456";
