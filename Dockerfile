FROM php:8.1-apache

# Instala extensiones necesarias
RUN apt-get update && apt-get install -y \
    libicu-dev libonig-dev libzip-dev zip unzip \
    && docker-php-ext-install intl mbstring pdo pdo_mysql zip \
    && a2enmod rewrite

# Cambiar DocumentRoot a public/
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!/var/www/html/public!g' /etc/apache2/apache2.conf

# Evita la advertencia del ServerName
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Copia todo el proyecto
COPY . /var/www/html

# Asignar permisos
RUN chown -R www-data:www-data /var/www/html

# Establecer el directorio de trabajo
WORKDIR /var/www/html