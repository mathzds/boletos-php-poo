<?php

namespace SistemaBoletos\Services;

use SistemaBoletos\Interfaces\BoletoInterface;
use SistemaBoletos\Interfaces\JurosInterface;

class ProcessadorJuros
{
    public static function aplicarJurosSeSuportado(BoletoInterface $boleto, float $taxa): ?float
    {
        if ($boleto instanceof JurosInterface) {
            return $boleto->aplicarJuros($taxa);
        }
        
        return null;
    }

    public static function suportaJuros(BoletoInterface $boleto): bool
    {
        return $boleto instanceof JurosInterface;
    }
}
