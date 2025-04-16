<?php
// Ruta: backend/v1/mantenedor/index.php

// Se incluye un archivo PHP externo, que probablemente contiene configuraciones o funciones comunes.
include_once '../version1.php';

// Se inicializan variables para verificar la existencia de un parámetro 'id' en la URL.
$existeId = false;
$valorId = 0;

// Se verifica si hay parámetros pasados en la URL (usando $_parametros).
// Si existen, se recorren para buscar uno que contenga la cadena 'id'.
if (count($_parametros) > 0){
    foreach($_parametros as $p){
        // Si el parámetro contiene 'id', se marca como existente y se extrae su valor.
        if(strpos($p, 'id') !== false){
            $existeId = true;
            $valorId = explode('=', $p)[1]; // Obtiene el valor después del '=' en el parámetro.
        }
    }
}

// Verifica si la versión de la API es 'v1'.
// Esta variable probablemente proviene de alguna configuración o parámetro en la solicitud.
if ($_version == 'v1'){
    // Se valida que el recurso solicitado sea 'mantenedor'.
    if ($_mantenedor == 'mantenedor'){
        // Se revisa el método HTTP utilizado en la solicitud.
        switch ($_metodo){
            case 'GET': // Si el método es GET, se ejecuta el bloque correspondiente.
                // Se valida si el encabezado de autorización es correcto.
                if ($_header == $_token_get){
                    // Se incluye el archivo del controlador que maneja las operaciones del 'mantenedor'.
                    include_once 'controller.php';
                    $control = new Controlador(); // Se crea una instancia del controlador.
                    $lista = $control->getAll(); // Se obtiene la lista de elementos del mantenedor.

                    // Si se encontró un 'id' en los parámetros, se filtra la lista de resultados.
                    if ($existeId) {
                        // Se filtra la lista de elementos para obtener solo aquellos cuyo 'id' coincida con el valor proporcionado.
                        $lista = array_filter($lista, function($item) use ($valorId) {
                            return $item['id'] == $valorId;
                        });
                        // Se reindexa la lista filtrada para asegurar que los índices sean consecutivos.
                        $lista = array_values($lista);
                    }

                    // Se devuelve una respuesta HTTP 200 (éxito) con los datos en formato JSON.
                    http_response_code(200);
                    echo json_encode(['data' => $lista]);
                } else {
                    // Si el encabezado de autorización es incorrecto, se devuelve un error 401 (no autorizado).
                    http_response_code(401);
                    echo json_encode(['error' => 'No tiene autorización para GET']);
                }
                break;

            default:
                // Si se usa un método HTTP no permitido, se devuelve un error 405 (método no permitido).
                http_response_code(405);
                echo json_encode(['error' => 'Método no permitido']);
                break;
        }
    }
}

