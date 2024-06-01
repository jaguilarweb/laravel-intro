setup:
	@make build
	@make up
	@make composer-update

build:
	docker-compose build --no-cache --force-rm
stop:
	docker-compose stop
up:
	docker-compose up -d
down:
	docker-compose down
composer-update:
	docker exec laravel-docker-intro bash -c "composer update"
data:
	docker exec laravel-docker-intro bash -c "php artisan migrate --seed && php artisan db:seed"
