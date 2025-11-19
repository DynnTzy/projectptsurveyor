FROM php:8.1-apache

# Install PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy project files
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html

# Install composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Set CI4 writable permissions
RUN chown -R www-data:www-data /var/www/html/writable
RUN chmod -R 0777 /var/www/html/writable

# Expose port
EXPOSE 8080

# Start Apache
CMD ["apache2-foreground"]
