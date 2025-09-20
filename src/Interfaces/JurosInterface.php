<?php

namespace SistemaBoletos\Interfaces;

interface JurosInterface
{
    public function aplicarJuros(float $taxa): float;
    public function getValorOriginal(): float;
}
