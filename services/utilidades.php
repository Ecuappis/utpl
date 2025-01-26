<?php
define("CLAVE_TOKEN", "Cl4v3T0k3n2*2A**Utpl");

function generarToken($usuario)
{
  //Horas de Duracion del Token
  $horas = 1;
  $tiempoExpiracion = time() + ($horas * 60 * 60);

  $payload = [
    'usuario' => $usuario,
    'exp' => $tiempoExpiracion
  ];

  $header = json_encode(['alg' => 'HS256', 'typ' => 'JWT']);
  $headerBase64 = base64_encode($header);
  $payloadBase64 = base64_encode(json_encode($payload));
  $firma = hash_hmac('SHA256', $headerBase64 . '.' . $payloadBase64, CLAVE_TOKEN, true);
  $firmaBase64 = base64_encode($firma);
  $token = $headerBase64 . '.' . $payloadBase64 . '.' . rtrim(strtr($firmaBase64, '+/', '-_'), '=');
  return $token;
}

function decifrarToken($token)
{
  $partes = explode('.', $token);

  if (count($partes) !== 3) {
    return ['respuesta' => false, 'mensaje' => 'Token mal formado'];
  }

  list($headerBase64, $payloadBase64, $firmaBase64) = $partes;

  // Decodificar las partes del token
  $header = json_decode(base64_decode($headerBase64), true);
  $payload = json_decode(base64_decode($payloadBase64), true);
  $firma = base64_decode(strtr($firmaBase64, '-_', '+/'));

  // Verificar que el payload y el header sean válidos
  if (!$header || !$payload) {
    return ['respuesta' => false, 'mensaje' => 'Token inválido'];
  }

  // Recalcular la firma y compararla con la firma original
  $firmaCalculada = hash_hmac('SHA256', $headerBase64 . '.' . $payloadBase64, CLAVE_TOKEN, true);

  if (!hash_equals($firmaCalculada, $firma)) {
    return ['respuesta' => false, 'mensaje' => 'Firma inválida'];
  }

  // Verificar si el token ha expirado
  if (isset($payload['exp']) && $payload['exp'] < time()) {
    return ['respuesta' => false, 'mensaje' => 'El token ha expirado'];
  }

  // Si todo es válido, retornar el contenido del payload
  return ['respuesta' => true, 'payload' => $payload];
}