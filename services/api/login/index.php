<?php

//Conexion a la base de datos
require_once '../../conexion.php';
require_once '../../utilidades.php';

// Usar el espacio de nombres de phpseclib
use phpseclib3\Crypt\AES;

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

  // Incluir el autoloader de Composer
  require '../../../vendor/autoload.php';

  // Definir la clave secreta
  $claveSecreta = 'T@ny4UTPL2@2A**x';

  // Obtener los datos JSON del cuerpo de la solicitud
  $data = json_decode(file_get_contents('php://input'), true);

  // Validar si se recibieron los datos "user" y "pass"
  if (empty($data['user']) || empty($data['pass'])) {
    echo json_encode(['respuesta' => false, 'mensaje' => 'Datos requeridos incorrectos', 'resultado' => '']);
    exit;
  }

  // Descifrar el texto del usuario
  $usuarioResult = descifrarTexto(trim($data['user']));
  if (isset($usuarioResult['error'])) {
    echo json_encode(['respuesta' => false, 'mensaje' => 'Usuario Incorrecto', 'resultado' => 'user']);
    exit;
  }

  // Descifrar el texto de la contraseña
  $claveResult = descifrarTexto(trim($data['pass']));
  if (isset($claveResult['error'])) {
    echo json_encode(['respuesta' => false, 'mensaje' => 'Password Incorrecto', 'resultado' => 'pass']);
    exit;
  }

  // Crear una instancia de la clase Conexion
  $conexion = new Conexion();

  //validar con la base de datos
  $sql = "SELECT * FROM usuarios WHERE username = '" . $usuarioResult['resultado'] . "'";
  $resultado = $conexion->conexion->query($sql);

  if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();

    if ($fila["estado"] == 0) {
      echo json_encode(['respuesta' => false, 'mensaje' => 'Usuario suspendido', 'resultado' => 'pass']);
      exit;
    }

    if (password_verify($claveResult['resultado'], $fila["pass"])) {

      $token = generarToken(base64_encode($fila["id"]));

      // Respuesta exitosa
      echo json_encode([
        'respuesta' => true,
        'mensaje' => 'Logueado Correctamente',
        'resultado' => [
          'token' => $token
        ]
      ]);
    } else {
      echo json_encode(['respuesta' => false, 'mensaje' => 'Password Incorrecto', 'resultado' => 'pass']);
    }
  } else {
    echo json_encode(['respuesta' => false, 'mensaje' => 'Usuario Incorrecto', 'resultado' => 'user']);
  }
  $conexion->cerrar();
} catch (Exception $e) {
  // Capturar excepciones generales
  header('HTTP/1.1 500 Internal Server Error');
  echo json_encode(['respuesta' => false, 'mensaje' => $e->getMessage()]);
}

// Función para descifrar texto cifrado
function descifrarTexto($textoCifrado)
{
  $claveSecreta = 'T@ny4UTPL2@2A**x';

  // Verificar si el texto cifrado está en el formato correcto
  if (strpos($textoCifrado, ":") === false) {
    return ['error' => 'El texto cifrado tiene un formato incorrecto'];
  }

  // Separar el IV (en Base64) del texto cifrado
  list($ivBase64, $textoCifradoBase64) = explode(":", $textoCifrado);

  // Decodificar el IV y el texto cifrado de Base64
  $iv = base64_decode($ivBase64);
  $textoCifradoBinario = base64_decode($textoCifradoBase64);

  // Verificar que la decodificación fue exitosa
  if ($textoCifradoBinario === false || $iv === false) {
    return ['error' => 'Error al decodificar el texto cifrado o IV'];
  }

  // Crear una instancia de AES en modo CBC
  $aes = new AES('cbc');
  $aes->setKey($claveSecreta);
  $aes->setIV($iv);

  // Descifrar el texto
  $textoDescifrado = $aes->decrypt($textoCifradoBinario);

  // Verificar si el descifrado fue exitoso
  if ($textoDescifrado === false) {
    return ['error' => 'Error al descifrar el texto'];
  }

  return ['resultado' => $textoDescifrado];
}