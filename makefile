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

# Сгенерировать ключ
generate-key:
	$(DOCKER_COMPOSE) run --rm app php artisan key:generate

# Собрать фронт
vite-build:
	$(DOCKER_COMPOSE) run --rm app npm install npm run --build

# Перезапуск
restart: down up

# Выполнить artisan команду на обновление курсов
currency-refresh:
	$(DOCKER_COMPOSE) run --rm app php artisan currency:refresh

# Запуск миграций
migrate:
	$(DOCKER_COMPOSE) run --rm app php artisan migrate

# Запуск миграций с сидерами
seed:
	$(DOCKER_COMPOSE) run --rm app php artisan db:seed

# Исправление прав и очистка кешей
fix-perms:
	$(DOCKER_COMPOSE) run --rm app ./fix_permissions.sh

# Просмотр логов
logs:
	$(DOCKER_COMPOSE) logs -f
