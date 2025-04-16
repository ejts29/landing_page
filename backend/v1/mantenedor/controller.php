<?php

// Se define la clase Controlador que maneja la lógica de interacción con la base de datos.
class Controlador{

    // Variable privada que almacenará la lista de elementos obtenidos de la base de datos.
    private $lista;

    // Constructor de la clase. Inicializa la lista como un array vacío.
    public function __construct()
    {
        $this->lista = [];
    }

    // Método que obtiene todos los registros de la tabla 'mantenedor'.
    public function getAll(){
        // Se crea una nueva instancia de la clase Conexion para establecer la conexión a la base de datos.
        $con = new Conexion();
        
        // Se define la consulta SQL que selecciona los campos 'id', 'nombre' y 'activo' de la tabla 'mantenedor'.
        $sql = "SELECT id, nombre, activo FROM mantenedor;";

        // Se ejecuta la consulta utilizando la conexión obtenida con la clase Conexion.
        $rs = mysqli_query($con->getConnection(), $sql);

        // Si la consulta se ejecuta correctamente, se procesa el resultado.
        if ($rs){
            // Se recorre cada fila de los resultados utilizando un bucle.
            while ($tupla = mysqli_fetch_assoc($rs)){
                // Se convierte el valor de 'activo' a un valor booleano (true o false) dependiendo de si es 1 o 0.
                $tupla['activo'] = $tupla['activo'] == 1 ? true : false;
                
                // Se agrega cada fila procesada (tupla) al array '$lista'.
                array_push($this->lista, $tupla);
            }
            // Después de recorrer todos los resultados, se libera el recurso de la consulta.
            mysqli_free_result($rs);
        }
        
        // Se cierra la conexión con la base de datos.
        $con->closeConnection();
        
        // Se devuelve la lista de resultados obtenida.
        return $this->lista;
    }

}