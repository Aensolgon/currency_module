# Currency Converter Module (Laravel + Docker)

Проект на **Laravel**, содержащий:
- Модуль конвертации валют (загрузка курсов с [freecurrencyapi.com](https://freecurrencyapi.com)).
- Сервис для конвертации цен (`CurrencyConverter`).
- Админка с авторизацией и просмотром курсов валют.
- Автоматическое обновление курсов 1 раз в сутки (через планировщик).
- Готовая инфраструктура на Docker.
- Makefile для удобного управления.

---

## Требования
- Docker & Docker Compose
- Make (установлен на macOS/Linux)
- Для macOS: установленный Homebrew, PHP и Composer (если хотите запускать без Docker)

---

## Установка и запуск

1. **Склонируйте проект и перейдите в директорию:**
    ```bash
    git clone https://github.com/Aensolgon/currency_module
    cd currency_module
    ```

2. **Соберите и запустите контейнеры:**
    ```bash
    make build
    make up
    ```

3. **Настройте `.env`:**
   Скопируйте `.env.example` в `.env` и измените при необходимости:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=db
    DB_PORT=3306
    DB_DATABASE=laravel
    DB_USERNAME=laravel
    DB_PASSWORD=laravel

    FREECURRENCY_API_KEY=ВАШ_API_KEY
    CURRENCY_BASE=USD
    ```

4. **Примените миграции и сидеры:**
    ```bash
    make migrate
    # или
    make seed
    ```

5. **Исправьте права и очистите кеши (если нужно):**
    ```bash
    make fix-perms
    ```

6. **Откройте проект в браузере:**
   [http://localhost:8000](http://localhost:8000)

---

## Использование Makefile

Основные команды:
```bash
make build        # Собрать Docker-образы
make up           # Поднять контейнеры
make down         # Остановить контейнеры
make restart      # Перезапустить контейнеры
make install      # Установить Laravel и зависимости
make migrate      # Применить миграции
make seed         # Миграции + сидеры
make artisan <cmd> # Выполнить artisan команду, например: make artisan route:list
make fix-perms    # Исправить права и очистить кеши
make logs         # Просмотр логов контейнеров
