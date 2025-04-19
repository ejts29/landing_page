// Selecciona los botones para el modo oscuro y claro, y el elemento <body>
const darkModeBtn = document.querySelector('#btn-dark-mode');
const lightModeBtn = document.querySelector('#btn-light-mode');
const body = document.body;

// Obtiene el tema guardado en localStorage o asigna 'light' como valor por defecto
const storedTheme = localStorage.getItem('theme') || 'light';

// Espera que todo el DOM esté cargado
document.addEventListener('DOMContentLoaded', function() {
    // -------- MENÚ MÓVIL --------
    const btnMenu = document.getElementById('btn-menu');
    const menu = document.getElementById('menu');
   
    btnMenu.addEventListener('click', function() {
        // Alterna la visibilidad del menú
        menu.classList.toggle('active');

        // Cambia el valor del atributo aria-expanded (para accesibilidad)
        const expanded = btnMenu.getAttribute('aria-expanded') === 'true';
        btnMenu.setAttribute('aria-expanded', !expanded);
    });

    // -------- MODO OSCURO / CLARO --------

    // Selecciona el botón de modo oscuro y claro desde un contenedor específico
    const darkModeBtn = document.querySelector('#botones-adicionales button:nth-child(3)');
    const lightModeBtn = document.querySelector('#botones-adicionales button:nth-child(4)');
    const body = document.body;

    // Función para aplicar el tema guardado o seleccionado
    function applyTheme(theme) {
        if (theme === 'dark') {
            document.body.classList.add('dark-mode'); // Aplica clase al body
            darkModeBtn.textContent = 'Modo Claro';   // Cambia texto del botón
        } else {
            document.body.classList.remove('dark-mode');
            darkModeBtn.textContent = 'Modo Oscuro';
        }
    }

    // Aplica el tema guardado
    const storedTheme = localStorage.getItem('theme') || 'light';
    applyTheme(storedTheme);

    // Cambia el tema cuando se hace clic en el botón
    darkModeBtn.addEventListener('click', function() {
        const newTheme = document.body.classList.contains('dark-mode') ? 'light' : 'dark';
        applyTheme(newTheme);
        localStorage.setItem('theme', newTheme); // Guarda la preferencia
    });

    // -------- VALIDACIÓN DEL FORMULARIO --------

    const form = document.getElementById('formContacto');

    form.addEventListener('submit', function(e) {
        // Si el formulario no es válido, muestra una alerta
        if (!form.checkValidity()) {
            e.preventDefault(); // Evita el envío
            e.stopPropagation(); // Detiene la propagación del evento
            form.classList.add('was-validated'); // Clase para estilos de error
            alert('Por favor, completa correctamente todos los campos del formulario.');
        } else {
            // Si el formulario es válido
            e.preventDefault(); // Aquí podrías hacer envío AJAX
            alert('Formulario enviado correctamente.');
            form.reset(); // Limpia los campos
            form.classList.remove('was-validated'); // Quita clase de validación
        }
    });

    // -------- EFECTO EN ENCABEZADO PRINCIPAL (h1) --------
    const header = document.querySelector('h1');
    if (header) {
        header.addEventListener('mouseover', function() {
            this.style.color = '#32c95e'; // Cambia el color al pasar el mouse
        });
        header.addEventListener('mouseout', function() {
            this.style.color = ''; // Vuelve al color original
        });
    }
});

// -------- EFECTO EN ENCABEZADOS h2 a h6 --------
document.addEventListener("DOMContentLoaded", function () {
    const headers = document.querySelectorAll("h2, h3, h4, h5, h6");

    headers.forEach(function(header) {
        header.addEventListener("mouseover", function() {
            header.style.color = "#32c95e"; // Cambia color al pasar el mouse
        });
        header.addEventListener("mouseout", function() {
            header.style.color = ""; // Vuelve al color original
        });
    });
});

// -------- API: CARGAR SERVICIOS --------
const API_SERVICIOS = 'http://landing_page/backend/v1/services/';
const API_NOSOTROS = 'http://landing_page/backend/v1/about-us/';
const TOKEN = 'ciisa'; // Token de autenticación (puede estar protegido)
const idioma = 'esp'; // Idioma para mostrar contenido

// Solicita los servicios desde la API
fetch(API_SERVICIOS, {
    method: 'GET',
    headers: {
        'Authorization': `Bearer: ${TOKEN}` // Encabezado con token
    }
})
.then(response => response.json()) // Convierte la respuesta a JSON
.then(data => {
    const contenedor = document.getElementById('contenedor-servicios');
    data.data.forEach(item => {
        if (item.activo) { // Solo si el servicio está activo
            const card = document.createElement('div');
            card.className = 'card-servicio';
            card.innerHTML = `
                <h3>${item.titulo[idioma]}</h3>
                <p>${item.descripcion[idioma]}</p>
            `;
            contenedor.appendChild(card); // Agrega la tarjeta al DOM
        }
    });
})
.catch(error => console.error('Error cargando servicios:', error));

// -------- API: CARGAR INFORMACIÓN "NOSOTROS" --------
fetch(API_NOSOTROS, {
    method: 'GET',
    headers: {
        'Authorization': `Bearer: ${TOKEN}`
    }
})
.then(response => response.json())
.then(data => {
    const contenedor = document.getElementById('contenedor-nosotros');
    data.data.forEach(item => {
        const card = document.createElement('div');
        card.className = 'card-nosotros';
        card.innerHTML = `
            <h3>${item.titulo[idioma]}</h3>
            <p>${item.descripcion[idioma]}</p>
        `;
        contenedor.appendChild(card); // Agrega al contenedor
    });
})
.catch(error => console.error('Error cargando nosotros:', error));
