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
composer-update:
	docker exec getmobil bash -c "composer update"
data:
	docker exec getmobil bash -c "php artisan migrate"
	docker exec getmobil bash -c "php artisan db:seed"