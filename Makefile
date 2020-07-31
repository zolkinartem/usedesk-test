SHELL=/bin/bash -e

.DEFAULT_GOAL := help

ifeq ($(test -f ./.env) && echo '1',1)
include .env
endif

## Actions with containers

build: ## Build\rebuild all containers
	@docker-compose build --build-arg user_uid=$$(id -u) db
	@docker-compose build --build-arg user_uid=$$(id -u) app
	@docker-compose build --build-arg user_uid=$$(id -u) web

up: ## Up containers
	@docker-compose up -d --remove-orphans

down: ## Down containers
	@docker-compose down

restart: down up

## Actions with Laravel

prepare-app: composer-install key-generate prepare-db init-hook ## Run common project settings
	@echo -e "Make: App is completed. \n"

update-app: composer-autoload composer-install db-migrate db-seed optimize ## Update app

refresh-app: composer-autoload composer-install db-fresh optimize ## Refresh app

key-generate: ## Generate laravel app key
	@docker-compose exec -T app sudo -u www-data php artisan key:generate

optimize: ## Clear cache, routes, views
	@docker-compose exec -T app sudo -u www-data php artisan optimize:clear

test: ## Запуск тестов
	@docker-compose exec -T app sudo -u www-data vendor/bin/phpunit --testdox -v --log-junit tests/logs/logfile.xml ${args}

## Actions with DB

prepare-db: db-migrate db-seed ## Run migrate and seeds

db-migrate: ## Migrate database
	@docker-compose exec -T app sudo -u www-data php artisan migrate --force

db-seed: ## Database seeding
	@docker-compose exec -T app sudo -u www-data php artisan db:seed --force

db-fresh: ## Fresh database with seeds
	@docker-compose exec -T app sudo -u www-data php artisan migrate:fresh --seed --force

db-seeder: ## Run needed seeder. Example make db-seeder class=BlockCategoriesTableSeeder
	@docker-compose exec -T app sudo -u www-data php artisan db:seed --class=${class}

db-migrate-rollback: ## Rollback last migration
	@docker-compose exec -T app sudo -u www-data php artisan migrate:rollback

## Actions with composer

composer-install: ## Install composer dependecies
	@docker-compose exec -T app sudo -u www-data composer install --optimize-autoloader -d /var/www/html

composer-update: ## Update composer dependecies
	@docker-compose exec -T app sudo -u www-data composer update -d /var/www/html

composer-autoload: ## Update classes cache
	@docker-compose exec -T app sudo -u www-data composer dump-autoload

## Another actions

bash: ## Run app console
	@docker-compose exec -T app sudo -u www-data bash

env: ## Copy env file
	cp .env.example .env

init-hook:
	sh -c "cp scripts/pre-commit.sh .git/hooks/pre-commit && chmod +x .git/hooks/pre-commit"

phpcbf: ## Run Code Sniffer
	@docker-compose exec -T app sudo -u www-data ./vendor/bin/phpcbf --standard=./phpcs.xml --colors ./app ./config ./database ./routes ./tests

phpstan: ## Running phpstan
	@docker-compose exec -T app sudo -u www-data ./vendor/bin/phpstan analyze app tests -l max -c phpstan.neon

pre-commit: phpcbf phpstan test ## Pre-commit code test

help: ## This help
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

default: help
