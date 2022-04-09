install-dev:
	cp .env.dev .env
	docker-compose build

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