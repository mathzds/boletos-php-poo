<?php

namespace SistemaBoletos\Abstract;

use SistemaBoletos\Interfaces\BoletoInterface;
use InvalidArgumentException;

abstract class BoletoAbstrato implements BoletoInterface
{
    protected float $valor;
    protected string $dataVencimento;

    public function __construct(float $valor, string $dataVencimento)
    {
        $this->valor = $valor;
        $this->dataVencimento = $dataVencimento;
    }

    public function getValor(): float
    {
        return $this->valor;
    }

    public function getDataVencimento(): string
    {
        return $this->dataVencimento;
    }

    public function renderizar(string $formato): string
    {
        if ($formato === 'html') {
            return $this->renderizarHtml();
        } elseif ($formato === 'pdf') {
            return $this->renderizarPdf();
        }
        throw new InvalidArgumentException("Formato não suportado");
    }

    abstract protected function renderizarHtml(): string;
    abstract protected function renderizarPdf(): string;
}
