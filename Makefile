CONTAINER_NAME_PHP=php
CONTAINER_NAME_NODE=node
PHP_CMD=docker exec $(CONTAINER_NAME_PHP)
NODE_CMD=docker exec $(CONTAINER_NAME_NODE)

bash-php:
	docker exec -it $(CONTAINER_NAME_PHP) bash

bash-node:
	docker exec -it $(CONTAINER_NAME_NODE)  sh

php-cs-fixer:
	$(PHP_CMD) vendor/bin/php-cs-fixer fix --verbose

phpcbf:
	$(PHP_CMD) vendor/bin/phpcbf src/ -v
	$(PHP_CMD) vendor/bin/phpcbf tests/ -v

fix-lint: phpcbf

lint:
	$(PHP_CMD) vendor/bin/phpcs
	$(PHP_CMD) vendor/bin/phpstan analyse
	$(NODE_CMD) yarn eslint

api-schema:
	$(PHP_CMD) php bin/console api:openapi:export  -o ./api.json
	$(NODE_CMD) node npx openapi-typescript api.json --output ./assets/schema/app-api-schema.ts
	$(PHP_CMD) rm -f api.json

start-prod:
	APP_ENV=prod docker-compose up -d

start-dev:
	APP_ENV=dev docker-compose up

build:
	$(PHP_CMD) php composer install
	$(PHP_CMD) bin/console doctrine:schema:create
	$(PHP_CMD) bin/console doctrine:migrations:migrate
	$(PHP_CMD) bin/console lexik:jwt:generate-keypair
	$(NODE_CMD) yarn install
	$(NODE_CMD) yarn build

test:
	$(PHP_CMD) bin/console --env=test doctrine:database:create
	$(PHP_CMD) bin/console --env=test doctrine:database:drop  --force
	$(PHP_CMD) bin/console --env=test doctrine:schema:create
	$(PHP_CMD) bin/console --env=test doctrine:migrations:migrate --no-interaction --allow-no-migration
	$(PHP_CMD) bin/console --env=test doctrine:fixtures:load --append
	$(PHP_CMD) bin/phpunit

fixture-load:
	$(PHP_CMD) bin/console doctrine:fixtures:load  --purge-with-truncate



