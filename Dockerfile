FROM php:8.2-apache

# Copia os arquivos do projeto para a pasta padrão do Apache
COPY . /var/www/html/

# Habilita mod_rewrite para URLs amigáveis (opcional)
RUN a2enmod rewrite

# Expõe a porta 80
EXPOSE 80