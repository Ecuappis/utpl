<?php

interface UsuarioInterface
{
  public function obtenerDatosUsuario(string $token): ?array;

  public function obtenerFichaPersonal(string $token): ?array;

  public function listaPreguntas(string $token): ?array;

  public function listaOpcionesPregunta(int $numero, string $token): ?array;
}