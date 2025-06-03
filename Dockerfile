# Use official PHP CLI image with version 8.3
FROM php:8.3-cli

# Install system dependencies needed for zip and composer
RUN apt-get update && apt-get install -y git unzip zip libzip-dev \
    && docker-php-ext-install zip

# Install Composer globally by copying from official composer image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory in container
WORKDIR /app

# Copy composer files and install PHP dependencies
COPY composer.json composer.lock /app/
RUN composer install --no-interaction --no-progress --prefer-dist

# Copy the rest of the project source code
COPY . /app

# Default command runs PHPUnit tests with color output
CMD ["./vendor/bin/phpunit", "--colors=always"]
