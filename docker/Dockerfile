ARG PHP_VERSION_SELECTED=8.2

FROM php:${PHP_VERSION_SELECTED}-apache

# Install system dependencies
RUN apt-get update && apt-get install -y --no-install-recommends \
    nano \
    libmcrypt-dev \
    openssl \
    libpng-dev \
    libonig-dev \
    libzip-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    curl \
    git \
    zip \
    unzip \
    libxml2-dev \
    && rm -r /var/lib/apt/lists/*

# Enable Apache modules
RUN a2enmod rewrite && a2enmod ssl

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        gd \
        pdo_mysql \
        mysqli \
        zip \
    && docker-php-ext-enable mysqli

# Install Node.js
RUN curl -sL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g n \
    && n stable

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files first
COPY composer.json ./

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-progress

# Copy application files (vendor directory excluded in .dockerignore)
COPY . .

# Ensure vendor directory exists and has correct permissions
RUN if [ ! -d "vendor" ]; then \
        composer install --no-dev --optimize-autoloader --no-interaction --no-progress; \
    fi

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && find /var/www/html -type d -exec chmod 755 {} \; \
    && find /var/www/html -type f -exec chmod 644 {} \;

# Expose ports
EXPOSE 80
EXPOSE 443

CMD ["apache2-foreground"]
