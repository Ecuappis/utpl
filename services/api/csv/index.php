<?php

// Conexión a la base de datos
require_once '../../conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $data = array();

  // Crear una instancia de la clase Conexion
  $conexion = new Conexion();
  $sql = "SELECT preguntas.pregunta FROM preguntas WHERE estado = 1";
  $resultado = $conexion->conexion->query($sql);
  if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
      $data[] = $fila['pregunta'];
    }

    // Cabeceras del archivo para forzar la descarga
    header('Content-Type: text/csv; charset=UTF-8');
    header('Content-Disposition: attachment; filename="encuesta.csv"');
    header('Pragma: no-cache');
    header('Expires: 0');

    // Abrir salida para escribir el CSV en memoria
    $output = fopen('php://output', 'w');

    // Escribir BOM para que Excel interprete correctamente UTF-8
    fwrite($output, "\xEF\xBB\xBF");

    // Escribir las preguntas como una sola fila (cabecera)
    fputcsv($output, $data);

    fclose($output);
    exit;
  } else {
    echo "No hay preguntas disponibles.";
  }
}