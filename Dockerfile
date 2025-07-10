FROM php:8.2-apache

# Instala a extensão pdo_pgsql necessária para conectar ao PostgreSQL
RUN docker-php-ext-install pdo_pgsql

# Habilita mod_rewrite (opcional, caso vá usar URLs amigáveis)
RUN a2enmod rewrite

# Copia os arquivos do projeto para a pasta padrão do Apache
COPY . /var/www/html/

# Expõe a porta 80
EXPOSE 80