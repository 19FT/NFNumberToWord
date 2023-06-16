.PHONY: *

list:
	@grep -E '^[a-zA-Z%_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-24s\033[0m %s\n", $$1, $$2}'

check: lint cs phpstan test ## check lint, code style and static analysis using the PHP within Docker

lint:
	./vendor/bin/phplint NumberToWords.php test

cs:
	./vendor/bin/phpcs

phpstan:
	./vendor/bin/phpstan --configuration=phpstan.neon

test:
	XDEBUG_MODE=coverage php ./vendor/bin/phpunit --coverage-html coverage

