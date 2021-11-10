FROM php:7.3.3-apache

# mysql
RUN docker-php-ext-install mysqli

# Uncoment to deploy on heroku
#COPY . /var/www/html
#COPY ./conf/ports.conf /etc/apache2/ports.conf
#COPY ./conf/apache.conf /etc/apache2/sites-enabled/000-default.conf