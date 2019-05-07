# Symfony 4 + Docker Compose
## nginx + php7 + mariadb

Clone this repo and run `docker-compose up -d` to build the containers.

Once the images get pulled run `docker ps` to see the containers are up and running

Check php version with `docker exec -it <php_container_id> php -v`

Install dependencies: `docker exec -it <php_container_id> composer update`

Open `http://localhost:3001`