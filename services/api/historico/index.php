<?php

header("Allow: POST");
header('Content-Type: application/json');

// Verificar que el método sea POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('HTTP/1.1 400 Bad Request');
  echo json_encode(['respuesta' => false, 'mensaje' => 'Acceso no autorizado', 'resultado' => '']);
  exit;
}

try {
  // Respuesta inicial
  $respuesta = ['respuesta' => false, 'mensaje' => 'Error al ingresar al sistema', 'resultado' => ''];

  // Obtener los datos JSON del cuerpo de la solicitud
  $data = json_decode(file_get_contents('php://input'), true);

  // Verificar si json_decode falla
  if (json_last_error() !== JSON_ERROR_NONE) {
    $respuesta['mensaje'] = 'Error al procesar JSON: ' . json_last_error_msg();
    echo json_encode($respuesta);
    exit;
  }

  require_once(__DIR__ . '/../../app/historicoService.php');
  $historicoService = new HistoricoService();

  switch ($data['op']) {
    case 'obtenerAreas':
      $respuesta = $historicoService->obtenerListaAreas();
      break;
    case 'obtenerPreguntas':
      $respuesta = $historicoService->obtenerPreguntasPorArea($data['area']);
      break;
    default:
      $respuesta['mensaje'] = 'Servicio Requerido inexistente.';
      break;
  }

  echo json_encode($respuesta);
} catch (Exception $e) {
  // Capturar excepciones generales
  header('HTTP/1.1 500 Internal Server Error');
  echo json_encode(['respuesta' => false, 'mensaje' => $e->getMessage()]);
}