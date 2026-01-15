# Mini-CRM Laravel Project

## Описание

Мини CRM на Laravel для тестовых целей.  
Проект запускается полностью через Docker: PHP-FPM, Nginx и PostgreSQL.

---

## 1. Установка и запуск

### 1.1 Клонируем репозиторий

```bash
git clone https://github.com/adecco40/mini-crm.git
```

### 1.2 Создать файл окружения

```bash
cp mini-crm/.env.example mini-crm/.env
```

### 1.3 Перейти в папку Docker

```bash
cd docker
```

### 1.4 Собрать и запустить контейнеры

```bash
docker compose up -d --build
```

## 2. Проверка работы

При первом запуске entrypoint.sh автоматически:

Ждёт готовности базы данных

Устанавливает Composer-зависимости (если их нет)

Генерирует APP_KEY

Делает миграции и сидеры (если RUN_SEEDERS=true)

-   Laravel доступен на: http://localhost:8000
-   PostgreSQL доступен на порту 5432 с данными из .env

### 2.1 Стандартные страницы

-   `/register` — регистрация пользователя

-   `/login` — вход

-   `/dashboard` — панель пользователя

-   `/leads` — список лидов

### 2.2 Тестовые пользователи (создаются сидерами)

| email             | password |
| ----------------- | -------- |
| user1@example.com | password |
| user2@example.com | password |
