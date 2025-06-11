FROM php:8.3-fpm

# Install system dependencies and PHP extensions
RUN apt-get update \
    && apt-get install -y libicu-dev libzip-dev zip unzip \
    && docker-php-ext-install intl pdo_mysql zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy application code (including entrypoint and .env.example)
COPY . /var/www

# Make entrypoint executable
RUN chmod +x /var/www/docker/entrypoint.sh
