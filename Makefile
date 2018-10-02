# Constants
DOCKER_COMPOSE = docker-compose
DOCKER = docker

## Environments
ENV_PHP = $(DOCKER) exec snowtricks_php-fpm
ENV_NODE = $(DOCKER) exec snowtricks_nodejs
ENV_BLACKFIRE = $(DOCKER) exec snowtricks_blackfire

# Tools
COMPOSER = $(ENV_PHP) composer

# Main
start-with-env: docker-compose.yml
	    $(ENV_PHP) cp .env.dist .env
	    $(DOCKER_COMPOSE) build --no-cache
	    $(DOCKER_COMPOSE) up -d --build --remove-orphans --force-recreate
	    make install
	    make cache-clear

start-without-env: docker-compose.yml
	    $(DOCKER_COMPOSE) build --no-cache
	    $(DOCKER_COMPOSE) up -d --build --remove-orphans --force-recreate
	    make install
	    make cache-clear

docker-compose: docker-compose.yml
	    docker-compose up -d --build

restart: docker-compose.yml
	    $(DOCKER_COMPOSE) up -d --build --remove-orphans --no-recreate
	    make install
	    make cache-clear

stop: docker-compose.yml
	    $(DOCKER_COMPOSE) stop

clean: ## Allow to delete the generated files and clean the project folder
	    $(ENV_PHP) rm -rf .env ./node_modules ./vendor


## doctrine
migration-delete: src/Migrations
	    $(ENV_PHP) rm -rf src/Migrations/*

schema-validate: config/mapping
	    $(ENV_PHP) php bin/console d:s:v --env=$(ENV)

migration-diff: src/Migrations
	    	    $(ENV_PHP) php bin/console d:m:d --env=$(ENV)

migration-migrate: src/Migrations
	    	    $(ENV_PHP) php bin/console d:m:m --env=$(ENV)


## PHP|Composer commands
install: composer.json
	     $(COMPOSER) install -a -o
	     $(COMPOSER) clear-cache
	     $(COMPOSER) dump-autoload --optimize --classmap-authoritative

update: composer.lock
	     $(COMPOSER) update -a -o

require: composer.json
	    $(COMPOSER) req $(PACKAGE) -a -o

require-dev: composer.json
	    $(COMPOSER) req --dev $(PACKAGE) -a -o

remove: composer.json
	    $(COMPOSER) remove $(PACKAGE) -a -o

autoload: composer.json
	    $(COMPOSER) dump-autoload -a -o

## Symfony commands
cache-clear: var/cache
	     $(ENV_PHP) rm -rf ./var/cache/*

router: config/routes
	    $(ENV_PHP) bin/console debug:router

## Tools commands
php-cs: ## Allow to use php-cs-fixer
	    $(ENV_PHP) php-cs-fixer fix $(FOLDER) --rules=@$(RULES)

deptrac: ## Allow to use the deptrac analyzer
	    $(ENV_PHP) deptrac

## Unit
unit: ## launch unit test
	    $(ENV_PHP) php bin/phpunit

## Blackfire
blackfire: ## launch performance test
	    $(ENV_BLACKFIRE) blackfire curl http://172.18.0.1:8080$(URL) --samples $(SAMPLES)

## Fixtures
fixture: src/Domain/DataFixtures
	$(ENV_PHP) bin/console d:f:l -n