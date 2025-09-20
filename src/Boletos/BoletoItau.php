<?php

namespace SistemaBoletos\Boletos;

use SistemaBoletos\Abstract\BoletoAbstrato;
use SistemaBoletos\Interfaces\JurosInterface;
use DateTime;
use InvalidArgumentException;

class BoletoItau extends BoletoAbstrato implements JurosInterface
{
    private float $valorOriginal;

    public function __construct(float $valor, string $dataVencimento)
    {
        parent::__construct($valor, $dataVencimento);
        $this->valorOriginal = $valor;
    }

    public function gerarCodigoBarras(): string
    {
        $valorFormatado = str_replace('.', '', number_format($this->valor, 2, '.', ''));
        $dataFormatada = DateTime::createFromFormat('Y-m-d', $this->dataVencimento)->format('Ymd');
        
        return "341" . $valorFormatado . $dataFormatada;
    }

    public function validar(): bool
    {
        if ($this->valor <= 0) {
            return false;
        }

        $hoje = new DateTime();
        $vencimento = DateTime::createFromFormat('Y-m-d', $this->dataVencimento);

        $hoje->setTime(0, 0, 0);
        $vencimento->setTime(0, 0, 0);

        return $vencimento > $hoje;
    }

    protected function renderizarHtml(): string
    {
        $valorStr = number_format($this->valor, 2, ',', '.');
        return "<div class='boleto-itau'>Boleto Itaú - R$ {$valorStr} - Venc: {$this->dataVencimento}</div>";
    }

    protected function renderizarPdf(): string
    {
        $valorStr = number_format($this->valor, 2, ',', '.');
        return "[PDF] Boleto Itaú - R$ {$valorStr} - Venc: {$this->dataVencimento}";
    }

    public function aplicarJuros(float $taxa): float
    {
        if ($taxa < 0) {
            throw new InvalidArgumentException("Taxa de juros não pode ser negativa");
        }

        $juros = ($this->valor * $taxa) / 100;
        $this->valor += $juros;

        return $this->valor;
    }

    public function getValorOriginal(): float
    {
        return $this->valorOriginal;
    }
}
