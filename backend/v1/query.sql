-- Crea una nueva base de datos llamada "backend_v1"
CREATE DATABASE backend_v1;

-- Crea un nuevo usuario llamado "backend_v1" con contraseña "backend_v1" que solo puede conectarse desde localhost
CREATE USER 'backend_v1'@'localhost' IDENTIFIED BY 'backend_v1';

-- Otorga todos los privilegios sobre la base de datos "backend_v1" al usuario creado anteriormente
GRANT ALL PRIVILEGES ON backend_v1.* TO 'backend_v1'@'localhost';

-- Recarga los privilegios para que los cambios tomen efecto inmediatamente
FLUSH PRIVILEGES;

-- Selecciona la base de datos "backend_v1" para empezar a trabajar con ella
USE backend_v1;

-- Crea una tabla llamada "mantenedor" con tres columnas:
-- id: entero, clave primaria
-- nombre: texto de máximo 50 caracteres, no puede ser nulo y debe ser único
-- activo: valor booleano, no puede ser nulo y su valor por defecto es false
CREATE TABLE mantenedor (
    id INT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE, -- CONSTRAINT: obliga a que los nombres sean únicos y no nulos
    activo BOOLEAN NOT NULL DEFAULT FALSE
);

-- ====== CONSULTAS (GET) ======

-- Consulta todos los registros de la tabla "mantenedor"
-- (equivalente a un GET / en una API REST)
SELECT id, nombre, activo FROM mantenedor;

-- Consulta un solo registro de la tabla "mantenedor" donde el id sea igual a 3
-- (equivalente a un GET /:id en una API REST)
SELECT id, nombre, activo FROM mantenedor WHERE id = 3;

-- ====== INSERCIÓN DE DATOS (POST) ======

-- Inserta tres registros en la tabla "mantenedor"
-- (equivalente a un POST en una API REST)
INSERT INTO mantenedor (id, nombre) VALUES 
(1, 'Ejemplo 1'),
(2, 'Ejemplo 2'),
(3, 'Ejemplo 3');

-- ====== ACTUALIZACIÓN PARCIAL (PATCH) ======

-- Activa el registro con id 3 (cambia el valor de activo a true)
-- (equivalente a PATCH /:id/enable)
UPDATE mantenedor SET activo = true WHERE id = 3;

-- Desactiva el registro con id 3 (cambia el valor de activo a false)
-- (equivalente a PATCH /:id/disable)
UPDATE mantenedor SET activo = false WHERE id = 3;

-- ====== ACTUALIZACIÓN COMPLETA (PUT) ======

-- Actualiza el nombre del registro con id 3 a 'Example 3'
-- (equivalente a un PUT en una API REST)
UPDATE mantenedor SET nombre = 'Example 3' WHERE id = 3;

-- ====== ELIMINACIÓN (DELETE) ======

-- Elimina el registro con id 3 de la tabla
-- (equivalente a un DELETE /:id en una API REST)
DELETE FROM mantenedor WHERE id = 3;
