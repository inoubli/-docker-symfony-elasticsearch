.PHONY: run stop start down db

run:
	docker-compose up -d && sleep 20 && docker-compose exec php php bin/console doctrine:schema:update --force 2>/dev/null; true
#     docker-compose exec php chown -R www-data:www-data app/cache && rm -rf app/cache/*
#     docker-compose exec php chown -R www-data:www-data app/logs
#     docker-compose exec php php bin/console cache:clear 2>/dev/null; true
#     docker-compose exec php php bin/console doctrine:fixture:load

wait:
	sleep 20
stop:
	docker-compose stop

down:
	docker-compose down
 
mysql:
	docker-compose exec mysql mysql -uroot -p"root"

clean:
	docker-compose down
	docker ps -a