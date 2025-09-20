<?php

require_once __DIR__ . '/../vendor/autoload.php';

use SistemaBoletos\Boletos\BoletoBancoBrasil;
use SistemaBoletos\Boletos\BoletoItau;
use SistemaBoletos\Services\ProcessadorJuros;

echo "=== SISTEMA DE BOLETOS BANCÁRIOS ===\n\n";

try {
    $boletoBB = new BoletoBancoBrasil(150.75, '2025-12-31');
    echo "=== BANCO DO BRASIL ===\n";
    echo "Código de barras: " . $boletoBB->gerarCodigoBarras() . "\n";
    echo "Válido: " . ($boletoBB->validar() ? 'Sim' : 'Não') . "\n";
    echo $boletoBB->renderizar('html') . "\n";
    echo $boletoBB->renderizar('pdf') . "\n\n";

    $boletoItau = new BoletoItau(200.00, '2025-12-31');
    echo "=== ITAÚ ===\n";
    echo "Código de barras: " . $boletoItau->gerarCodigoBarras() . "\n";
    echo "Válido: " . ($boletoItau->validar() ? 'Sim' : 'Não') . "\n";
    echo "Valor original: R$ " . number_format($boletoItau->getValorOriginal(), 2, ',', '.') . "\n";
    
    $novoValor = $boletoItau->aplicarJuros(2.5);
    echo "Valor com juros (2,5%): R$ " . number_format($novoValor, 2, ',', '.') . "\n";
    
    echo $boletoItau->renderizar('html') . "\n\n";

    echo "=== TESTE POLIMÓRFICO ===\n";
    $boletos = [$boletoBB, $boletoItau];
    
    foreach ($boletos as $index => $boleto) {
        echo "Boleto " . ($index + 1) . " - " . get_class($boleto) . "\n";
        echo "Suporta juros: " . (ProcessadorJuros::suportaJuros($boleto) ? 'Sim' : 'Não') . "\n";
        echo "---\n";
    }

} catch (Exception $e) {
    echo "Erro: " . $e->getMessage() . "\n";
}
