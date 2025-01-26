<?php

require_once(__DIR__ . '/../conexion.php');
require_once(__DIR__ . '/../interfaces/usuarioInterface.php');
require_once(__DIR__ . '/../utilidades.php');

class UsuarioService implements UsuarioInterface
{

  private function validarToken(string $token): ?int
  {
    $respuesta = 0;
    try {
      $respuestaDecifrado = decifrarToken($token);
      if ($respuestaDecifrado['respuesta']) {
        $usuario = (int) base64_decode($respuestaDecifrado['payload']['usuario']);
        // Crear una instancia de la clase Conexion
        $conexion = new Conexion();
        $sql = 'SELECT username FROM usuarios WHERE estado = 1 AND id = ' . $usuario;
        $resultado = $conexion->conexion->query($sql);
        if ($resultado->num_rows > 0) {
          $respuesta = $usuario;
        }
        $conexion->cerrar();
      }
    } catch (Exception $e) {
      $respuesta = 0;
    }
    return $respuesta;
  }

  public function obtenerFichaPersonal(string $token): ?array
  {
    $respuesta = ['respuesta' => false, 'mensaje' => 'Error al obtener datos de usuario', 'resultado' => ''];
    try {
      $usuario = $this->validarToken($token);
      if ($usuario > 0) {
        $datos = array();
        $conexion = new Conexion();
        $sql = "SELECT p.nombres, p.apellido_paterno, p.apellido_materno, CASE WHEN p.genero = 'F' THEN 'FEMENINO' WHEN p.genero = 'M' THEN 'MASCULINO' ELSE 'NO DEFINIDO' END AS genero, p.ciudad, r.nombre AS rol, u.username FROM persona p INNER JOIN usuarios u ON u.id = p.usuario INNER JOIN rol r ON r.id = p.rol WHERE p.usuario = " . $usuario;
        $resultado = $conexion->conexion->query($sql);
        if ($resultado->num_rows > 0) {
          $datos = $resultado->fetch_assoc();
          $respuesta['respuesta'] = true;
          $respuesta['mensaje'] = 'Datos de usuario obtenidos exitosamente.';
          $respuesta['resultado'] = $datos;
        } else {
          $respuesta['mensaje'] = 'No existe datos de usuario';
        }
      } else {
        $respuesta['mensaje'] = 'Acceso Denegado a Usuario';
      }
    } catch (Exception $e) {
      header('HTTP/1.1 500 Internal Server Error');
      echo json_encode(['respuesta' => false, 'mensaje' => $e->getMessage()]);
    }
    return $respuesta;
  }

  public function obtenerDatosUsuario(string $token): ?array
  {
    $respuesta = ['respuesta' => false, 'mensaje' => 'Error al obtener datos de usuario', 'resultado' => ''];
    try {
      // Validar Token
      $usuario = $this->validarToken($token);
      if ($usuario > 0) {
        // Crear una instancia de la clase Conexion
        $conexion = new Conexion();
        // Realizar consulta de datos de usuario
        $sql = 'SELECT p.username AS nombres, p.genero, p.ciudad, r.nombre AS tipo, r.id AS rol FROM persona p INNER JOIN rol r ON r.id = p.rol WHERE p.usuario = ' . $usuario . ' LIMIT 1';
        $resultado = $conexion->conexion->query($sql);
        $datos = array();
        $menu = array();
        if ($resultado->num_rows > 0) {
          $datos = $resultado->fetch_assoc();
          // Realizar consulta de menu de usuario
          $sql = "SELECT b.icono, b.nombre, b.page, r.jerarquia FROM boton_rol br INNER JOIN boton b ON b.id = br.boton AND b.estado = 1 INNER JOIN rol r ON r.id = br.rol INNER JOIN seccion s ON s.id = b.seccion WHERE s.nombre = 'PANEL' AND br.rol = " . $datos['rol'] . " ORDER BY b.id ASC";
          $resultado = $conexion->conexion->query($sql);
          if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
              $menu[] = $fila;
            }
          }
          unset($datos['rol']);
          $respuesta['respuesta'] = true;
          $respuesta['mensaje'] = 'Datos de usuario obtenidos exitosamente.';
          $respuesta['resultado'] = array('usuario' => $datos, 'menu' => $menu);
        } else {
          $respuesta['mensaje'] = 'No existen datos del usuario.';
        }
        $conexion->cerrar();
      } else {
        $respuesta['mensaje'] = 'Acceso Denegado a Usuario';
      }
    } catch (Exception $e) {
      header('HTTP/1.1 500 Internal Server Error');
      echo json_encode(['respuesta' => false, 'mensaje' => $e->getMessage()]);
    }
    return $respuesta;
  }

  public function listaPreguntas(string $token): ?array
  {
    $respuesta = ['respuesta' => false, 'mensaje' => 'Error al obtener preguntas', 'resultado' => ''];
    try {
      $usuario = $this->validarToken($token);
      if ($usuario > 0) {
        $conexion = new Conexion();
        $listado = array();
        $sql = "SELECT p.id AS numero, p.pregunta, t.nombre AS tipo, COUNT(o.id) AS opciones FROM preguntas p INNER JOIN tipo t ON t.id = p.tipo LEFT JOIN opciones o ON o.pregunta = p.id AND o.estado = 1 WHERE p.estado = 1 GROUP BY p.id, p.pregunta, t.nombre";
        $resultado = $conexion->conexion->query($sql);
        if ($resultado->num_rows > 0) {
          while ($fila = $resultado->fetch_assoc()) {
            $listado[] = $fila;
          }
          $respuesta['respuesta'] = true;
          $respuesta['mensaje'] = 'Datos de usuario obtenidos exitosamente.';
          $respuesta['resultado'] = $listado;
        } else {
          $respuesta['mensaje'] = 'No existen preguntas registradas.';
        }
      } else {
        $respuesta['mensaje'] = 'Acceso Denegado a Usuario';
      }
    } catch (Exception $e) {
      header('HTTP/1.1 500 Internal Server Error');
      echo json_encode(['respuesta' => false, 'mensaje' => $e->getMessage()]);
    }
    return $respuesta;
  }

  public function listaOpcionesPregunta(int $numero, string $token): ?array
  {
    $respuesta = ['respuesta' => false, 'mensaje' => 'Error al obtener opciones', 'resultado' => ''];
    try {
      $usuario = $this->validarToken($token);
      if ($usuario > 0) {
        $conexion = new Conexion();
        $listado = array();
        $sql = "SELECT id AS numero, nombre FROM opciones WHERE estado = 1 AND pregunta = " . $numero . " ORDER BY id ASC";
        $resultado = $conexion->conexion->query($sql);
        if ($resultado->num_rows > 0) {
          while ($fila = $resultado->fetch_assoc()) {
            $listado[] = $fila;
          }
          $respuesta['respuesta'] = true;
          $respuesta['mensaje'] = 'Opciones de preguntas obtenidas exitosamente.';
          $respuesta['resultado'] = $listado;
        } else {
          $respuesta['mensaje'] = 'No existen opciones registradas.';
        }
      } else {
        $respuesta['mensaje'] = 'Acceso Denegado a Usuario';
      }
    } catch (Exception $e) {
      header('HTTP/1.1 500 Internal Server Error');
      echo json_encode(['respuesta' => false, 'mensaje' => $e->getMessage()]);
    }
    return $respuesta;
  }

  public function generarCSV(string $token)
  {
    $respuesta = ['respuesta' => false, 'mensaje' => 'Error al generar el csv', 'resultado' => ''];
    try {
      $usuario = $this->validarToken($token);
      if ($usuario > 0) {
        $data = array();
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
        } else {
          $respuesta['mensaje'] = 'No hay preguntas habilitadas';
        }
      } else {
        $respuesta['mensaje'] = 'Acceso Denegado a Usuario';
      }
    } catch (Exception $e) {
      header('HTTP/1.1 500 Internal Server Error');
      echo json_encode(['respuesta' => false, 'mensaje' => $e->getMessage()]);
    }
    return $respuesta;
  }
}