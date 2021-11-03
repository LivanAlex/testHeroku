FROM mysql:5.7

ENV MYSQL_ROOT_PASSWORD="root"
ENV MYSQL_DATABASE="wishlist"
ENV MYSQL_USER="phpuser"
ENV MYSQL_PASSWORD="password"

ADD sql/schema.sql /docker-entrypoint-initdb.d
