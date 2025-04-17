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

# Cambiar el puerto de escucha de Apache a 8080
RUN sed -i 's/Listen 80/Listen 8080/' /etc/apache2/ports.conf \
    && sed -i 's/<VirtualHost \*:80>/<VirtualHost *:8080>/' /etc/apache2/sites-available/000-default.conf

# Copia todo el proyecto
COPY . /var/www/html

# Asignar permisos
RUN chown -R www-data:www-data /var/www/html

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Exponer el puerto 8080
EXPOSE 8080

# Iniciar Apache en primer plano
CMD ["apache2-foreground"]
