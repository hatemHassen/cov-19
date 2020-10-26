#!make

TARGET_ARGV = `echo $(filter-out $@,$(MAKECMDGOALS))`

default: help
.PHONY: default

## Build Docker image: Alias docker-build
build:
	@make docker-build $(TARGET_ARGV)
.PHONY: build


## Build Docker image
docker-build: install
	@docker build -t $(TARGET_ARGV) .
.PHONY: docker-build


## Build Application dependencies (composer-install assets-install)
install: composer-install assets-install
.PHONY: install


## Run Composer install default  (EXECUTE inside container only)
composer-install:
	@composer -n install --no-interaction --prefer-dist --no-progress --no-suggest --no-scripts
.PHONY: composer-install


## Run Composer install with optimization for production environnement (EXECUTE inside container only)
composer-install-prod:
	@composer -n install --no-interaction --prefer-dist --no-dev --no-autoloader --no-scripts --no-progress --no-suggest
	@composer -n dump-autoload --classmap-authoritative --no-dev
.PHONY: composer-install-prod


## Run Composer install default  (EXECUTE inside container only)
composer-post-install:
	@composer -n run-script --no-dev post-install-cmd
.PHONY: composer-install


## Run Yarn/npm resource dependencies (EXECUTE inside container only)
assets-install:
	@yarn install --no-progress
	@yarn build --no-progress
.PHONY: assets-install


## Create database if not exists and run migrations
database-install:
	@php bin/console doctrine:database:create --no-interaction --if-not-exists
	@php bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration
.PHONY: database-install


## Create database if not exists and run migrations
cache-clear:
	@php bin/console cache:clear
.PHONY: cache-clea


## Initialize var dirrectories log , cache
init-dirs:
	@mkdir -p var/log/ var/cache
.PHONY: init-dirs


## Boostrap application
bootstrap: init-dirs composer-post-install cache-clear
.PHONY: bootstrap


%:
	@:

## This help screen
help:
	@printf "Available targets:\n\n"
	@awk '/^[a-zA-Z\-\_0-9%:\\]+/ { \
	  helpMessage = match(lastLine, /^## (.*)/); \
	  if (helpMessage) { \
		helpCommand = $$1; \
		helpMessage = substr(lastLine, RSTART + 3, RLENGTH); \
	gsub("\\\\", "", helpCommand); \
	gsub(":+$$", "", helpCommand); \
		printf "  \x1b[32;01m%-35s\x1b[0m %s\n", helpCommand, helpMessage; \
	  } \
	} \
	{ lastLine = $$0 }' $(MAKEFILE_LIST)
	@printf "\n"
