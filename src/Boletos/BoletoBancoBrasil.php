<?php

namespace SistemaBoletos\Boletos;

use SistemaBoletos\Abstract\BoletoAbstrato;
use DateTime;

class BoletoBancoBrasil extends BoletoAbstrato
{
    public function gerarCodigoBarras(): string
    {
        $valorFormatado = str_replace('.', '', number_format($this->valor, 2, '.', ''));
        $dataFormatada = DateTime::createFromFormat('Y-m-d', $this->dataVencimento)->format('Ymd');
        
        return "001" . $valorFormatado . $dataFormatada;
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
        return "<div>Boleto BB - R$ " . number_format($this->valor, 2, '.', '') . 
               " - Venc: " . $this->dataVencimento . "</div>";
    }

    protected function renderizarPdf(): string
    {
        return "[PDF] Boleto BB - R$ " . number_format($this->valor, 2, '.', '') . 
               " - Venc: " . $this->dataVencimento;
    }
}
