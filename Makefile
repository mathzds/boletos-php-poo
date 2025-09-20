.PHONY: install test example clean setup

install:
	composer install

test:
	./vendor/bin/phpunit

example:
	php examples/exemplo_uso.php

clean:
	rm -rf vendor/ composer.lock

setup: install
	composer dump-autoload
	@echo "✅ Projeto configurado!"
