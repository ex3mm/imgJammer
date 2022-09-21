FROM php:7.2-fpm

WORKDIR "/var/www"

RUN apt-get update && apt-get install -y
RUN apt-get install -y libfreetype6-dev
RUN apt-get install -y libjpeg62-turbo-dev
RUN apt-get install -y libmcrypt-dev
RUN apt-get install -y libpng-dev

RUN apt-get install libmagickwand-dev libmagickcore-dev -y
RUN apt install libwebp-dev -y
RUN apt-get install libzip-dev -y
RUN docker-php-ext-install exif
RUN PHP_OPENSSL=yes
RUN pecl install imagick
RUN docker-php-ext-enable imagick
RUN docker-php-ext-install xml
RUN docker-php-ext-install zip
RUN docker-php-ext-install bcmath
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/
RUN docker-php-ext-install -j$(nproc) gd
RUN docker-php-ext-install intl
#RUN docker-php-ext-install filter
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install mysqli
RUN docker-php-ext-install pdo
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-enable pdo_mysql mysqli

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apt-get clean
RUN rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/* ~/.composer

COPY ./php.ini /etc/php/7.2/fpm/conf.d/90-php.ini
COPY ./php.ini /etc/php/7.2/cli/conf.d/90-php.ini

RUN usermod -u 1000 www-data
CMD  ["php-fpm"]
#ENTRYPOINT ["/docker-entrypoint.sh"] Запуск докера
EXPOSE 9000