#!/bin/sh

# Install dependencies (optional: comment out if you want to control this manually)
composer install

# Copy .env if it doesn't exist
if [ ! -f .env ]; then
  cp .env.example .env
  php artisan key:generate
fi

# Ensure SQLite database file exists and is writable
if grep -q '^DB_CONNECTION=sqlite' .env; then
  # Get the first non-commented DB_DATABASE value
  DB_PATH=$(grep '^DB_DATABASE=' .env | head -n1 | cut -d '=' -f2- | xargs)
  if [ -n "$DB_PATH" ]; then
    DIR_PATH=$(dirname "$DB_PATH")
    if [ ! -f "$DB_PATH" ]; then
      mkdir -p "$DIR_PATH"
      touch "$DB_PATH"
    fi
    chmod 666 "$DB_PATH"
    chmod 777 "$DIR_PATH"
  fi
fi

php artisan storage:link

# Run migrations and seeders every time
php artisan migrate --force
php artisan db:seed --force

chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Start PHP-FPM (or your preferred process)
exec php-fpm
