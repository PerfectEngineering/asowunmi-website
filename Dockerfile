FROM wordpress:4.9-php7.1-apache

# install pagespeed mod
RUN apt-get update && \
    curl -sLO https://dl-ssl.google.com/dl/linux/direct/mod-pagespeed-beta_current_amd64.deb && \
    dpkg -i mod-pagespeed-beta_current_amd64.deb && \
    apt-get -f install

RUN a2enmod pagespeed

COPY fonts /usr/src/wordpress/wp-content/fonts
COPY themes /usr/src/wordpress/wp-content/themes
COPY plugins /usr/src/wordpress/wp-content/plugins

RUN chown -R www-data:www-data /usr/src/wordpress/*