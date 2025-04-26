<?php

require_once '../../conexion.php';

$respuesta = ['respuesta' => false, 'mensaje' => 'Error al procesar la solicitud.', 'resultado' => ''];

try {
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];

    if ($file['error'] !== UPLOAD_ERR_OK) {
      $respuesta['mensaje'] = 'Error al cargar el archivo.';
      echo json_encode($respuesta);
      exit;
    }

    $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
    if (strtolower($fileExtension) !== 'csv') {
      $respuesta['mensaje'] = 'El archivo debe ser un CSV.';
      echo json_encode($respuesta);
      exit;
    }

    $fileTmpPath = $file['tmp_name'];

    if (($handle = fopen($fileTmpPath, 'r')) === false) {
      $respuesta['mensaje'] = 'No se pudo abrir el archivo CSV.';
      echo json_encode($respuesta);
      exit;
    }

    $delimitador = detectarDelimitador($fileTmpPath);
    rewind($handle);

    $cabecera = [];
    $respuestas = [];
    $fila = 0;

    while (($row = fgetcsv($handle, 10000, $delimitador)) !== false) {
      $procesado = [];

      foreach ($row as $campo) {
        $campo = htmlspecialchars(trim($campo));

        if ($fila === 0) {
          // En la cabecera, no se divide por ; ni ,
          $procesado[] = $campo;
        } else {
          // En las respuestas, sí se puede dividir por ; o ,
          $partes = preg_split('/[;,]/', $campo);
          $limpio = array_map(function ($item) {
            return htmlspecialchars(trim($item));
          }, $partes);
          $procesado[] = $limpio;
        }
      }

      if ($fila === 0) {
        $cabecera = $procesado;
      } else {
        $respuestas[] = $procesado;
      }

      $fila++;
    }

    fclose($handle);

    if (empty($cabecera)) {
      $respuesta['mensaje'] = 'El archivo CSV está vacío.';
      echo json_encode($respuesta);
      exit;
    }

    $data = json_encode([
      'cabecera' => $cabecera,
      'respuestas' => $respuestas
    ]);
    $respuesta = analisisExploratorio($data);
  } else {
    http_response_code(400);
    $respuesta['mensaje'] = 'No se recibió un archivo válido.';
  }
} catch (Exception $e) {
  http_response_code(500);
  $respuesta['mensaje'] = 'Excepción capturada: ' . $e->getMessage();
}

header('Content-Type: application/json; charset=UTF-8');
echo json_encode($respuesta);

/**
 * Detecta el delimitador predominante en la primera fila del CSV
 */
function detectarDelimitador($filePath)
{
  $handle = fopen($filePath, 'r');
  $lineaConPuntoYComa = fgetcsv($handle, 10000, ';');
  rewind($handle);
  $lineaConComa = fgetcsv($handle, 10000, ',');
  fclose($handle);

  return (count($lineaConPuntoYComa) > count($lineaConComa)) ? ';' : ',';
}

/**
 * Llama al microservicio de Python para realizar el análisis exploratorio
 */
function analisisExploratorio($data)
{
  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://127.0.0.1:5000/procesar_encuesta',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $data,
    CURLOPT_HTTPHEADER => array(
      'Content-Type: application/json'
    ),
  ));

  $response = curl_exec($curl);
  curl_close($curl);

  // Verificar si la respuesta fue exitosa
  if ($response === false) {
    return [
      'respuesta' => false,
      'mensaje' => 'Error al comunicarse con el microservicio.',
      'resultado' => ''
    ];
  }

  // Intentar decodificar la respuesta JSON
  $responseData = json_decode($response, true);

  // Verificar si la respuesta es válida y contiene los datos esperados
  if (json_last_error() !== JSON_ERROR_NONE || !isset($responseData['respuesta'])) {
    return [
      'respuesta' => false,
      'mensaje' => 'Respuesta inesperada del microservicio.',
      'resultado' => ''
    ];
  }

  return $responseData;
}