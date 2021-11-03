FROM php:7.3.3-apache


# mysql
RUN docker-php-ext-install -j$(nproc) pdo_mysql
RUN docker-php-ext-install mysqli

COPY . /var/www/html
COPY ./conf/ports.conf /etc/apache2/ports.conf
COPY ./conf/apache.conf /etc/apache2/sites-enabled/000-default.conf

# psql
#RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_pgsql