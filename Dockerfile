# Use an official PHP-FPM image as the base image
FROM php:8.1-fpm

# Set the working directory in the container
WORKDIR /var/www/html

# Copy your Laravel application code into the container
COPY . /var/www/html

# Install dependencies and extensions
RUN apt-get update && \
    apt-get install -y wget && \
    wget https://getcomposer.org/composer-stable.phar -O /usr/local/bin/composer && \
    chmod +x /usr/local/bin/composer && \
    apt-get install -y libzip-dev zip unzip && \
    docker-php-ext-install zip pdo pdo_mysql
    
# Install and enable Redis extension
RUN pecl install redis && docker-php-ext-enable redis

# Expose port 9000
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
