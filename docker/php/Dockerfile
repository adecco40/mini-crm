# Базовый образ PHP
FROM php:8.4-fpm

# Устанавливаем системные зависимости
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql \
    && rm -rf /var/lib/apt/lists/*

# Устанавливаем Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Рабочая директория внутри контейнера
WORKDIR /var/www

# Копируем весь проект mini-crm внутрь контейнера
COPY mini-crm/ ./

# Устанавливаем PHP-зависимости
RUN composer install --optimize-autoloader

# Копируем entrypoint
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Указываем entrypoint и CMD
ENTRYPOINT ["entrypoint.sh"]
CMD ["php-fpm"]
