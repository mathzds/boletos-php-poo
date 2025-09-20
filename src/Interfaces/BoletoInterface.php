<?php

namespace SistemaBoletos\Interfaces;

interface BoletoInterface
{
    public function gerarCodigoBarras(): string;
    public function validar(): bool;
    public function renderizar(string $formato): string;
}
