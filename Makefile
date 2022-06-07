.env:
	cp .env.example .env

.PHONY: up
up: .env
	docker-compose up --build -d
	docker-compose exec app composer install --quiet --no-ansi --no-interaction --no-scripts --no-suggest --no-progress --prefer-dist
	docker-compose exec app npm ci
	docker-compose exec app npm run dev

stop:
	docker-compose stop

node_modules:
	docker-compose exec app npm ci

.PHONY: front
front: node_modules
	docker-compose exec app npm run dev

.PHONY: test
test:
	docker-compose exec app php artisan test
