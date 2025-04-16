<?php
// Ruta: backend/conexion.php

// Definición de la clase Conexion que se encargará de manejar la conexión a la base de datos
class Conexion {
    // Propiedad privada que almacenará la conexión activa a la base de datos
    private $conexion;

    // Método constructor que se ejecuta automáticamente al crear un objeto de esta clase
    public function __construct()
    {
        // Se establece la conexión con la base de datos usando mysqli_connect
        // Parámetros: servidor, usuario, contraseña, nombre de la base de datos
        $this->conexion = mysqli_connect("localhost", "root", "", "bd_empresa");
    }

    // Método público que retorna la conexión actual para que pueda ser utilizada en otras partes del sistema
    public function getConnection(){
        return $this->conexion;
    }

    // Método público para cerrar la conexión con la base de datos
    public function closeConnection(){
        mysqli_close($this->conexion);
    }
}
