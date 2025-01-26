<?php

// Conexión a la base de datos
require_once '../../conexion.php';

$respuesta = ['respuesta' => false, 'mensaje' => 'Error al procesar la solicitud.', 'resultado' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
  $file = $_FILES['file'];

  // Validar si se subió el archivo correctamente
  if ($file['error'] !== UPLOAD_ERR_OK) {
    $respuesta['mensaje'] = 'Error al cargar el archivo.';
    echo json_encode($respuesta);
    exit;
  }

  // Validar la extensión del archivo
  $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
  if (strtolower($fileExtension) !== 'csv') {
    $respuesta['mensaje'] = 'El archivo debe ser un CSV.';
    echo json_encode($respuesta);
    exit;
  }

  $fileTmpPath = $file['tmp_name'];

  // Intentar abrir el archivo
  if (($handle = fopen($fileTmpPath, 'r')) !== false) {
    $data = [];

    // Leer el contenido del archivo CSV
    while (($row = fgetcsv($handle, 1000, ',')) !== false) {
      $data[] = $row;
    }

    fclose($handle);

    // Verificar si el archivo CSV estaba vacío
    if (empty($data)) {
      $respuesta['mensaje'] = 'El archivo CSV está vacío.';
    } else {
      //almacenar en la base de datos
      $respuesta['respuesta'] = true;
      $respuesta['mensaje'] = 'Archivo CSV procesado correctamente.';
      $respuesta['resultado'] = $data;
    }
  } else {
    http_response_code(400);
    $respuesta['mensaje'] = 'No se pudo abrir el archivo CSV.';
  }
} else {
  http_response_code(400);
  $respuesta['mensaje'] = 'No se recibió un archivo válido.';
}

// Configurar cabeceras de respuesta y devolver el resultado
header('Content-Type: application/json; charset=UTF-8');
echo json_encode($respuesta);