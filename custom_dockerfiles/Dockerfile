FROM php:fpm
RUN apt-get update && apt-get install -y \
   libmcrypt-dev  \
   libicu-dev \
   mysql-client \
   && docker-php-source extract \
   && docker-php-ext-install pdo_mysql \
   && docker-php-ext-install mysqli \
   && docker-php-ext-configure mysqli \
   && docker-php-ext-enable mysqli \
   && docker-php-source delete
CMD ["php-fpm"]