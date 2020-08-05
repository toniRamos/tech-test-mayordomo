FROM php:7
RUN apt-get update -y && apt-get install -y openssl zip unzip git mysql-client
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app
COPY . /app
RUN composer create-project --prefer-dist laravel/laravel

CMD php artisan serve --host=127.0.0.1 --port=8000 &
EXPOSE 8000
CMD ./start.sh