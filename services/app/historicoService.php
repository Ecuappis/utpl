<?php

require_once(__DIR__ . '/../conexion.php');
require_once(__DIR__ . '/../interfaces/historicoInterface.php');
require_once(__DIR__ . '/../utilidades.php');

class HistoricoService implements HistoricoInterface
{

  public function obtenerListaAreas(): ?array
  {
    $respuesta = ['respuesta' => false, 'mensaje' => 'Error al obtener listado de areas', 'resultado' => ''];
    try {
      $conexion = new Conexion();
      $listado = array();
      $sql = "SELECT nombre, nemonico FROM area WHERE estado = 1";
      $resultado = $conexion->conexion->query($sql);
      if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
          $fila['opciones'] = array();
          $respuestaPreguntas = $this->obtenerPreguntasPorArea($fila['nemonico']);
          if ($respuestaPreguntas['respuesta']) {
            $fila['opciones'] = $respuestaPreguntas['resultado'];
          }
          $listado[] = $fila;
        }
        $respuesta['respuesta'] = true;
        $respuesta['mensaje'] = 'Lista de areas obtenidas exitosamente.';
        $respuesta['resultado'] = $listado;
      } else {
        $respuesta['mensaje'] = 'No existen opciones registradas.';
      }
    } catch (Exception $e) {
      header('HTTP/1.1 500 Internal Server Error');
      echo json_encode(['respuesta' => false, 'mensaje' => $e->getMessage()]);
    }
    return $respuesta;
  }

  public function obtenerPreguntasPorArea(string $area): ?array
  {
    $respuesta = ['respuesta' => false, 'mensaje' => 'Error al obtener listado de preguntas', 'resultado' => ''];
    try {
      $conexion = new Conexion();
      $listado = array();
      $sql = "SELECT p.id AS numero, p.nombre, t.nombre AS tipo FROM preguntas p INNER JOIN area a ON a.id = p.area AND a.estado = 1 INNER JOIN tipo t ON t.id = p.tipo WHERE p.estado = 1 AND a.nemonico = '" . $area . "' ORDER BY numero ASC";
      $resultado = $conexion->conexion->query($sql);
      if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
          $fila['check'] = true;
          $listado[] = $fila;
        }
        $respuesta['respuesta'] = true;
        $respuesta['mensaje'] = 'Lista de preguntas obtenidas exitosamente.';
        $respuesta['resultado'] = $listado;
      } else {
        $respuesta['mensaje'] = 'No existen opciones registradas.';
      }
    } catch (Exception $e) {
      header('HTTP/1.1 500 Internal Server Error');
      echo json_encode(['respuesta' => false, 'mensaje' => $e->getMessage()]);
    }
    return $respuesta;
  }
}