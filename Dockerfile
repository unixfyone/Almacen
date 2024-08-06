FROM php:7.4-apache

# Instala las extensiones necesarias para PHP
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd mysqli pdo pdo_mysql

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia el contenido del repositorio en el directorio raíz del servidor web
COPY . /var/www/html/whpa

# Establece permisos adecuados para el directorio de la aplicación
RUN chown -R www-data:www-data /var/www/html

# Expone el puerto 80
EXPOSE 80

# Configura el documento raíz de Apache (opcional)
# RUN echo "DocumentRoot /var/www/html/public" >> /etc/apache2/sites-available/000-default.conf

# Habilita módulos de Apache (opcional)
RUN a2enmod rewrite