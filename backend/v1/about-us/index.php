<?php
// Se permiten solicitudes desde cualquier origen (CORS).
header("Access-Control-Allow-Origin: *");

// Se permiten los encabezados 'Authorization' y 'Content-Type' en las solicitudes.
header("Access-Control-Allow-Headers: Authorization, Content-Type");

// Se especifica que la respuesta será en formato JSON.
header("Content-Type: application/json");

// Se obtiene el encabezado 'Authorization' de la solicitud.
$auth = getallheaders()["Authorization"] ?? "";

// Verificación del valor del encabezado Authorization.
if ($auth !== "Bearer: ciisa") {
    // Si el token no es el esperado, se retorna un código de error 401 (No autorizado).
    http_response_code(401);
    echo json_encode(["error" => "No autorizado"]);
    exit; // Se detiene la ejecución del script.
}

// Definición de los datos que se enviarán en la respuesta.
$data = [
    "data" => [
        // Primer elemento: Información sobre los servicios ofrecidos.
        [
            "titulo" => [
                "esp" => "Servicios de soporte, gestión y diseño de TI altamente personalizados.",
                "eng" => "Highly Tailored IT Design, Management & Support Services."
            ],
            "descripcion" => [
                "esp" => "Acelere la innovación con equipos tecnológicos de clase mundial. Lo conectaremos con un equipo remoto completo de increíbles talentos independientes para todas sus necesidades de desarrollo de software.",
                "eng" => "Accelerate innovation with world-class tech teams We’ll match you to an entire remote team of incredible freelance talent for all your software development needs."
            ]
        ],
        // Segundo elemento: Misión de la empresa.
        [
            "titulo" => [
                "esp" => "Misión",
                "eng" => "Mission"
            ],
            "descripcion" => [
                "esp" => "Nuestra misión es ofrecer soluciones digitales innovadoras y de alta calidad que impulsen el éxito de nuestros clientes, ayudándolos a alcanzar sus objetivos empresariales a través de la tecnología y la creatividad.",
                "eng" => "Our mission is to deliver high-quality, innovative digital solutions that drive our clients' success, helping them achieve their business goals through technology and creativity."
            ]
        ],
        // Tercer elemento: Visión de la empresa.
        [
            "titulo" => [
                "esp" => "Visión",
                "eng" => "Vision"
            ],
            "descripcion" => [
                "esp" => "Nos visualizamos como líderes en el campo de la consultoría y desarrollo de software, reconocidos por nuestra excelencia en el servicio al cliente, nuestra capacidad para adaptarnos a las necesidades cambiantes del mercado y nuestra contribución al crecimiento y la transformación digital de las empresas.",
                "eng" => "We see ourselves as leaders in the field of software consulting and development, recognized for our excellence in customer service, our ability to adapt to changing market needs and our contribution to the growth and digital transformation of companies."
            ]
        ]
    ]
];

// Se convierte el array de datos a formato JSON y se envía como respuesta, con soporte para caracteres especiales.
echo json_encode($data, JSON_UNESCAPED_UNICODE);

