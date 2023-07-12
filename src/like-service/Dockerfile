FROM php:8.0-cli

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

RUN apt update

RUN apt -y install git

ENV COMPOSER_ALLOW_SUPERUSER=1

COPY . /var/www

#This is faster https://github.com/composer/composer/issues/8205#issuecomment-507256979
RUN php /usr/bin/composer config --global repos.packagist composer https://packagist.org

RUN php /usr/bin/composer install

EXPOSE 8000

#Fixes error while connecting since laravel requires a key
RUN php artisan --env=local key:generate

#Fixes error while accessing enviroment variables
RUN php artisan --env=local config:clear

RUN docker-php-ext-install mysqli pdo pdo_mysql;

CMD php artisan serve --host=0.0.0.0 --port=8000




#RUN php artisan migrate --force

CMD php artisan --env=local serve --host=0.0.0.0 --port=8000

CMD php artisan serve --host=0.0.0.0 --port=8000

#RUN php artisan make:database;
