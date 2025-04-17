# Usamos la imagen oficial de PHP + Apache
FROM php:8.1-apache

# 1. Instala las librerías del sistema y extensiones PHP necesarias
RUN apt-get update \
    && apt-get install -y libicu-dev libonig-dev libzip-dev zip unzip \
    && docker-php-ext-install intl mbstring pdo pdo_mysql mysqli zip \
    && a2enmod rewrite

# 2. Ajusta el DocumentRoot de Apache a public/
RUN sed -ri \
        -e 's!DocumentRoot /var/www/html!DocumentRoot /var/www/html/public!g' \
        -e 's!<Directory /var/www/>!<Directory /var/www/html/public>!g' \
        /etc/apache2/sites-available/*.conf

# 3. Permitir que .htaccess funcione (AllowOverride All)
RUN printf "\n<Directory /var/www/html/public>\n    AllowOverride All\n</Directory>\n" \
    >> /etc/apache2/apache2.conf

# 4. Fija el ServerName para quitar la advertencia
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# 5. Cambia Apache para que escuche en el puerto 8080
RUN sed -i 's/Listen 80/Listen 8080/' /etc/apache2/ports.conf \
    && sed -i 's/<VirtualHost \*:80>/<VirtualHost *:8080>/' /etc/apache2/sites-available/000-default.conf

# 6. Copia el proyecto completo y crea la carpeta writable
COPY . /var/www/html
RUN mkdir -p /var/www/html/writable \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/writable

# 7. Establece el directorio de trabajo
WORKDIR /var/www/html

# 8. Expone el puerto que usamos
EXPOSE 8080

# 9. Comando por defecto: arranca Apache en primer plano
CMD ["apache2-foreground"]