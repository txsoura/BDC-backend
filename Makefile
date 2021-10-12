pull:
	git pull origin develop

git:
	bash git-cli.sh

up:
	docker-compose -f docker-compose.yml up -d

down:
	docker-compose -f docker-compose.yml down

serve:
	docker-compose -f docker-compose.yml up -d mysql
	doppler run php artisan serve

tail:
	 tail -f storage/logs/laravel-`TZ=UTC date +'%Y-%m-%d'`.log

log:
	 cat storage/logs/laravel-`TZ=UTC date +'%Y-%m-%d'`.log

ide:
	composer run ide
