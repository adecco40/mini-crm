#!/bin/sh
set -e

echo "Starting Laravel application..."

echo "Waiting for database connection..."
until php -r "
try {
    \$pdo = new PDO(
        'pgsql:host=' . getenv('DB_HOST') . ';port=' . getenv('DB_PORT') . ';dbname=' . getenv('DB_DATABASE'),
        getenv('DB_USERNAME'),
        getenv('DB_PASSWORD')
    );
} catch (PDOException \$e) {
    exit(1);
}
exit(0);
"; do
  echo "Database is unavailable - sleeping"
  sleep 2
done

echo "Database is ready!"

# Генерация APP_KEY если нужно
if [ -z "$APP_KEY" ] || [ "$APP_KEY" = "base64:" ]; then
    echo "Generate APP_KEY..."
    php artisan key:generate --ansi --no-interaction
fi

# Миграции
echo "Running migrations..."
php artisan migrate --force

# Сидеры, если включено
if [ "$RUN_SEEDERS" = "true" ]; then
  echo "Running seeders..."
  php artisan db:seed --force
fi

# Очистка кэша
php artisan optimize:clear

echo "Application is ready!"

# Запуск php-fpm
exec "$@"
