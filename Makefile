CONTAINER_NAME_PHP=php
CONTAINER_NAME_NODE=node
PHP_CMD=docker exec $(CONTAINER_NAME_PHP)
NODE_CMD=docker exec $(CONTAINER_NAME_NODE)

bash-php:
	docker exec -it $(CONTAINER_NAME_PHP) bash

bash-node:
	docker exec -it $(CONTAINER_NAME_NODE)  sh

lint:
	php vendor/bin/php-cs-fixer fix
	php vendor/bin/phpstan analyse
	yarn eslint

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
	$(PHP_CMD) php php bin/console doctrine:migrations:migrate
	$(PHP_CMD) php php bin/console lexik:jwt:generate-keypair
	$(NODE_CMD) node  yarn install
	$(NODE_CMD) node  yarn build