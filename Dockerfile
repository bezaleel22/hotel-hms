FROM php:7.4-apache AS base

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    net-tools \
    netcat \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd mysqli pdo pdo_mysql \
    && a2enmod rewrite \
    && echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Copy custom configurations
COPY docker-config/apache.conf /etc/apache2/sites-available/000-default.conf
COPY docker-config/php.ini /usr/local/etc/php/php.ini
COPY docker-config/entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/entrypoint.sh

# Set working directory
WORKDIR /var/www/html

FROM base AS dev
# Dev stage is used with volume mounts, no need to copy code

FROM base AS prod
# Copy application code and set permissions in one layer
COPY --chown=www-data:www-data . .
RUN chmod -R 755 /var/www/html \
    && mkdir -p application/logs \
       application/cache \
       application/cache/temp \
       application/config \
    && chmod -R 777 application

# Expose port 80
EXPOSE 80

# Use entrypoint script
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]