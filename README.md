# Sistema de Boletos Bancários

Sistema orientado a objetos para geração de boletos bancários em PHP.

## 🚀 Instalação

```bash
# Instalar dependências
composer install

# Executar exemplo
php examples/exemplo_uso.php

# Executar testes
composer test
```

## 📋 Características

- ✅ Arquitetura baseada em interfaces e classes abstratas
- ✅ Princípios SOLID aplicados
- ✅ Suporte a múltiplos bancos (BB, Itaú)
- ✅ Sistema de juros extensível
- ✅ Testes automatizados
- ✅ PSR-4 autoloading

## 💻 Uso Básico

```php
use SistemaBoletos\Boletos\BoletoBancoBrasil;

$boleto = new BoletoBancoBrasil(150.00, '2025-12-31');
echo $boleto->gerarCodigoBarras();
echo $boleto->renderizar('html');
```

## 🏗️ Estrutura

```
src/
├── Interfaces/     # Contratos
├── Abstract/       # Classes base
├── Boletos/        # Implementações por banco
└── Services/       # Serviços auxiliares
```
