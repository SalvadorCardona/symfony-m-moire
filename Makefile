php-bash:
	docker exec -it php bash

node-bash:
	docker exec -it node  sh

lint:
	php vendor/bin/php-cs-fixer fix
	php vendor/bin/phpstan analyse
	yarn eslint

api-schema:
	docker exec php bin/console api:openapi:export  -o ./api.json
	docker exec node npx openapi-typescript api.json --output ./assets/schema/app-api-schema.ts
	rm -f api.json

start-prod:
	APP_ENV=prod docker-compose up -d

start-dev:
	APP_ENV=dev docker-compose up

build:
	docker exec php composer install
	docker exec php php bin/console doctrine:migrations:migrate
	docker exec php php bin/console lexik:jwt:generate-keypair
	docker exec node  yarn install
	docker exec node  yarn build