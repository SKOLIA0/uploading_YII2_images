# Dockerfile
FROM php:7.4-apache

# Установка зависимостей
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Установка Yii2
RUN composer create-project --prefer-dist yiisoft/yii2-app-basic /var/www/html

# Копирование конфигов
COPY config/db.php /var/www/html/config/db.php
COPY config/web.php /var/www/html/config/web.php

# Настройка Apache: установка DocumentRoot на папку web
RUN sed -i 's|/var/www/html|/var/www/html/web|g' /etc/apache2/sites-available/000-default.conf /etc/apache2/apache2.conf

# Настройка прав доступа и включение модуля rewrite для Apache
RUN chown -R www-data:www-data /var/www/html \
    && a2enmod rewrite

# Создание директории /uploads и запуск Apache
CMD mkdir -p /var/www/html/web/uploads && chmod -R 777 /var/www/html/web/uploads && apache2-foreground
