<?php
// contacto.php

// Verifica si el método de la solicitud es POST (es decir, que se ha enviado un formulario)
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Verifica si se ha enviado el campo "txtNombre". Si es así, lo limpia y lo guarda, si no, lo deja como vacío
    $nombre = isset($_POST["txtNombre"]) ? htmlspecialchars(trim($_POST["txtNombre"])) : "";

    // Hace lo mismo para el campo "txtTelefono"
    $telefono = isset($_POST["txtTelefono"]) ? htmlspecialchars(trim($_POST["txtTelefono"])) : "";

    // Hace lo mismo para el campo "txtEmail"
    $email = isset($_POST["txtEmail"]) ? htmlspecialchars(trim($_POST["txtEmail"])) : "";

    // Hace lo mismo para el campo "selectServicio"
    $servicio = isset($_POST["selectServicio"]) ? htmlspecialchars(trim($_POST["selectServicio"])) : "";

    // Hace lo mismo para el campo "txtMensaje"
    $mensaje = isset($_POST["txtMensaje"]) ? htmlspecialchars(trim($_POST["txtMensaje"])) : "";

    // Hace lo mismo para el campo "csrf_token", que es usado para seguridad contra ataques CSRF
    $csrf_token = isset($_POST["csrf_token"]) ? htmlspecialchars(trim($_POST["csrf_token"])) : "";

    // Agrupa todos los datos en un arreglo asociativo para su uso más ordenado
    $datos_formulario = [
        "nombre"      => $nombre,
        "telefono"    => $telefono,
        "email"       => $email,
        "servicio"    => $servicio,
        "mensaje"     => $mensaje,
        "csrf_token"  => $csrf_token
    ];

    // Muestra los datos recibidos del formulario de manera organizada en pantalla
    echo "<h1>Datos del Formulario Recibidos</h1>";
    echo "<p><strong>Nombre:</strong> " . $datos_formulario["nombre"] . "</p>";
    echo "<p><strong>Teléfono:</strong> " . $datos_formulario["telefono"] . "</p>";
    echo "<p><strong>Email:</strong> " . $datos_formulario["email"] . "</p>";
    echo "<p><strong>Servicio seleccionado:</strong> " . $datos_formulario["servicio"] . "</p>";
    echo "<p><strong>Mensaje:</strong> " . $datos_formulario["mensaje"] . "</p>";
    echo "<p><strong>CSRF Token:</strong> " . $datos_formulario["csrf_token"] . "</p>";

} else {
    // Si se intenta acceder a este archivo sin enviar el formulario (por GET u otro método), muestra un mensaje de acceso no permitido
    echo "Acceso no permitido. Por favor, envíe el formulario correctamente.";
}
?>
