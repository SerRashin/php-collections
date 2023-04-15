.PHONY: phpunit
phpunit:
	./vendor/bin/phpunit

.PHONY: phpstan
phpstan:
	./vendor/bin/phpstan analyse tests

.PHONY: psalm
psalm:
	./vendor/bin/psalm

.PHONY: code-check
code-check: phpunit phpstan psalm

