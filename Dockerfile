FROM php:8.2-apache

# Instala dependências do sistema, incluindo libpq-dev para o PostgreSQL
RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pdo_pgsql

# Habilita mod_rewrite (opcional, caso use URLs amigáveis)
RUN a2enmod rewrite

# Copia os arquivos do projeto
COPY . /var/www/html/

# Expondo porta 80
EXPOSE 80
