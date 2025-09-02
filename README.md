# Currency Converter Module (Laravel + Docker)

Проект на **Laravel**, содержащий:
- Модуль конвертации валют (загрузка курсов с [freecurrencyapi.com](https://freecurrencyapi.com)).
- Сервис для конвертации цен (`CurrencyConverter`).
- Админка с авторизацией и просмотром курсов валют.
- Автоматическое обновление курсов 1 раз в сутки (через планировщик).
- Готовая инфраструктура на Docker.
- Makefile для удобного управления.

---

Обновление курсов происходит **1 раз в сутки (08:00)**, через планировщик.

Обновление происходит на основе валют находящихся в таблице **currencies**, которая предзаполнена валютами из ([CurrencySeeder.php](database/seeders/CurrencySeeder.php)).
В случае отсутствия валют в этой таблице, при автоматическом обновлении курсов, будут обновлены все доступные курсы валют из ([freecurrencyapi.com](https://freecurrencyapi.com)).

При необходимости можно обновить курсы не дожидаясь планировшика, через команду:
```bash
 make currency-refresh
```
Для тестирования конвертации валюты предусмотрен запрос:
```angular2html
POST http://localhost:8000/api/currency/convert

Body:
 {
    "amount": 123,
    "from": "USD",
    "to": "EUR"
 }
```
В папке **postman** находиться файл ([CURRENCY_CONVERTER.postman_collection.json](postman/CURRENCY_CONVERTER.postman_collection.json)) с предзаполненными данными.

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

    CURRENCY_BASE=USD
    FREECURRENCYAPI_KEY=ВАШ_API_KEY
    ```

4. **Примените миграции и сидеры:**
    ```bash
    make migrate-seed
    ```
   
5. **Сгенерировать ключ:**
    ```bash
    make generate-key
    ```

6. **Выполнить npm install:**
    ```bash
    make npm-install
    ```

7. **Выполнить composer install:**
    ```bash
    make composer-install
    ```
   
8. **Собрать фронт приложения:**
    ```bash
    make vite-build
    ```
   
9. **Откройте проект в браузере:**
   [http://localhost:8000](http://localhost:8000)

---

## Использование Makefile

Основные команды:
```bash
make build        # Собрать Docker-образы
make up           # Поднять контейнеры
make down         # Остановить контейнеры
make restart      # Перезапустить контейнеры
make npm-install  # Выполнить npm install
make vite-build   # Собрать фронт
make migrate-seed # Применить миграции и сиды
make currency-refresh # Выполнить artisan команду на обновление курсов
make logs         # Просмотр логов контейнеров
