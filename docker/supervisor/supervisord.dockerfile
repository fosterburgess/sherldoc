FROM php:8.3-fpm
ENV WEB_DOCUMENT_ROOT=/app/public
ENV COMPOSER_ALLOW_SUPERUSER=1
#ENV GITHUB_OAUTH=
# ARG would allow passing in from external env
# ARG GITHUB_OAUTH

# install system updates
RUN apt-get update
RUN apt-get install -y procps htop vim zip unzip libzip-dev libicu-dev libpq-dev libpng-dev git curl supervisor

# install php docker extensions
RUN \
  docker-php-ext-configure intl && \
  docker-php-ext-install intl pcntl zip pdo pdo_pgsql gd opcache exif

# Get latest Composer
COPY --from=composer:2.6.6 /usr/bin/composer /usr/bin/composer
# if needing to pass in github oauth
#RUN composer config -g github-oauth.github.com $GITHUB_OAUTH

WORKDIR /app

CMD ["/usr/bin/supervisord", "-n", "-c",  "/etc/supervisor/supervisord.conf"]
