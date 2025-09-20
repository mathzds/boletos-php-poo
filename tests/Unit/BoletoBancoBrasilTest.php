<?php

namespace SistemaBoletos\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SistemaBoletos\Boletos\BoletoBancoBrasil;

class BoletoBancoBrasilTest extends TestCase
{
    public function testGerarCodigoBarras()
    {
        $boleto = new BoletoBancoBrasil(15.50, '2025-06-30');
        $codigo = $boleto->gerarCodigoBarras();
        
        $this->assertEquals('001155020250630', $codigo);
    }

    public function testValidarBoletoValido()
    {
        $dataFutura = date('Y-m-d', strtotime('+30 days'));
        $boleto = new BoletoBancoBrasil(100.00, $dataFutura);
        
        $this->assertTrue($boleto->validar());
    }

    public function testRenderizarHtml()
    {
        $boleto = new BoletoBancoBrasil(15.50, '2025-06-30');
        $html = $boleto->renderizar('html');
        
        $this->assertStringContainsString('Boleto BB', $html);
    }
}
