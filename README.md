-- At this root

1) Create mysql/data directory
2) Create redis/data directory

run `docker compose up`
run `docker-compose exec -T app composer install`
run `docker-compose exec -T app php artisan migrate`

if you  want to run any install any dependencies or artisan command you can use this structure
docker-compose [OPTIONS] exec [SERVICE NAME] [COMMAND]

-- At src directory
run `npm install`