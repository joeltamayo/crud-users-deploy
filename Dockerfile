# 1) Usa una imagen oficial de PHP con Apache y extensiones necesarias
FROM php:8.1-apache

# 2) Instala dependencias para CodeIgniter + MySQL
RUN apt-get update \
 && apt-get install -y libicu-dev libonig-dev libzip-dev zip unzip \
 && docker-php-ext-install intl mbstring pdo pdo_mysql zip \
 && a2enmod rewrite

# 3) Copia el código al directorio de Apache
COPY . /var/www/html

# 4) Configura el DocumentRoot a /public
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf

# 5) Dale permisos (si los necesitas)
RUN chown -R www-data:www-data /var/www/html

# 6) Expone el puerto que usará Railway
EXPOSE 8080

# 7) Punto de entrada: Apache en foreground
CMD ["apache2-foreground"]
