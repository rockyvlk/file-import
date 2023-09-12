#!make

init: docker-clear docker-build docker-up composer-install wait-db migrate
up: docker-up
down: docker-down
rebuild: docker-down docker-build docker-up
restart: docker-down docker-up
migrate: migrate-mariadb migrate-postgres
rollback: rollback-mariadb rollback-postgres

docker-up:
	docker compose up -d

docker-down:
	docker compose down

docker-clear:
	docker compose down -v --remove-orphans

docker-build:
	docker compose build --pull

migrate-mariadb:
	docker compose run -T php bin/console doctrine:migrations:migrate --no-interaction --conn=mariadb

rollback-mariadb:
	docker compose run -T php bin/console doctrine:migrations:migrate prev --no-interaction --conn=mariadb

migrate-postgres:
	docker compose run -T php bin/console doctrine:migrations:migrate --no-interaction --conn=postgres

rollback-postgres:
	docker compose run -T php bin/console doctrine:migrations:migrate prev --no-interaction --conn=postgres

wait-db: wait-mariadb wait-postgres

wait-mariadb:
	docker-compose run -T php wait-for-it mariadb:3306 -t 60

wait-postgres:
	docker-compose run -T php wait-for-it postgres:5432 -t 60

composer-install:
	docker compose run -T php composer install

composer-update:
	docker compose run -T php composer update

