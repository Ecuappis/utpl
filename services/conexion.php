<?php

class Conexion
{
  // Propiedades para la conexión
  private $host = "localhost";       // Dirección del servidor de la base de datos
  private $usuario = "root";         // Usuario de MySQL
  private $clave = "";               // Contraseña de MySQL (vacía en tu caso)
  private $baseDeDatos = "utplbd";   // Nombre de la base de datos
  public $conexion;                  // Instancia de la conexión

  // Constructor de la clase
  public function __construct()
  {
    $this->conectar();
  }

  // Método para establecer la conexión a la base de datos
  public function conectar()
  {
    // Creación de la conexión usando la clase mysqli
    $this->conexion = new mysqli($this->host, $this->usuario, $this->clave, $this->baseDeDatos);

    // Verificar si hay errores en la conexión
    if ($this->conexion->connect_error) {
      // Si ocurre un error, mostramos el mensaje y terminamos la ejecución
      die("Error de conexión: " . $this->conexion->connect_error);
      $this->cerrar();
      exit();
    }
  }

  // Método para cerrar la conexión
  public function cerrar()
  {
    if ($this->conexion) {
      $this->conexion->close();
    }
  }
}