DOCKER_COMPOSE := docker compose
# Собрать образы
build:
	$(DOCKER_COMPOSE) build

# Запустить контейнеры
up:
	$(DOCKER_COMPOSE) up -d

# Остановить контейнеры
down:
	$(DOCKER_COMPOSE) down

# Перезапуск
restart: down up

# Установить Laravel, если нет composer.json
install:
	@if [ ! -f composer.json ]; then \
		$(DOCKER_COMPOSE) run --rm app composer create-project laravel/laravel . ; \
	fi
	$(DOCKER_COMPOSE) run --rm app composer install

# Выполнить artisan команду
artisan:
	$(DOCKER_COMPOSE) run --rm app php artisan $(filter-out $@,$(MAKECMDGOALS))

# Запуск миграций
migrate:
	$(DOCKER_COMPOSE) run --rm app php artisan migrate

# Запуск миграций с сидерами
seed:
	$(DOCKER_COMPOSE) run --rm app php artisan migrate --seed

# Исправление прав и очистка кешей
fix-perms:
	$(DOCKER_COMPOSE) run --rm app ./fix_permissions.sh

# Просмотр логов
logs:
	$(DOCKER_COMPOSE) logs -f
