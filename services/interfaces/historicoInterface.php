<?php

interface HistoricoInterface
{
  public function obtenerListaAreas(): ?array;
  public function obtenerPreguntasPorArea(string $area): ?array;
}