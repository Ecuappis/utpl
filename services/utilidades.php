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