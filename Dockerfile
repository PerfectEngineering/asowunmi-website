FROM wordpress:4.9-php7.1-apache

COPY themes /usr/src/wordpress/wp-content/themes
COPY plugins /usr/src/wordpress/wp-content/plugins

RUN chown -R www-data:www-data /usr/src/wordpress/*