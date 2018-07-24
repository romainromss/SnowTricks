DOCKER = docker
ENV_PHP = $(DOCKER) exec snowtricks_php-fpm

##
migration-delete: src/Migrations
	    $(ENV_PHP) rm -rf src/Migrations/*

schema-validate: config/mapping
	    $(ENV_PHP) php bin/console d:s:v --env=$(ENV)

migration-diff: src/Migrations
	    	    $(ENV_PHP) php bin/console d:m:d --env=$(ENV)

migration-migrate: src/Migrations
	    	    $(ENV_PHP) php bin/console d:m:m --env=$(ENV)

cache-delete: var/cache
	    rm -rf var/cache/*

docker-compose: /
	    docker-compose up -d --build