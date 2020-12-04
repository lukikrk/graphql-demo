FROM php:7.4.3-fpm

WORKDIR /opt/app/

# CREATE WWW-DATA HOME DIRECTORY
RUN set -x \
    && mkdir /home/www-data \
    && chown -R www-data:www-data /home/www-data \
    && usermod -u 1000 --shell /bin/bash -d /home/www-data www-data \
    && groupmod -g 1000 www-data

# INSTALL ESSENTIALS LIBS TO COMPILE PHP EXTENSTIONS
RUN set -x \
    && apt-get update \
    && apt-get install --no-install-recommends --no-install-suggests -y \
        # for zip ext
        zlib1g-dev libzip-dev\
        # for pg_pgsql ext
        libpq-dev \
        # for soap and xml related ext
        libxml2-dev \
        # for xslt ext
        libxslt-dev \
        # for gd ext
        libjpeg-dev libpng-dev \
        # for intl ext
        libicu-dev openssl \
        # for mbstring ext
        libonig-dev \
        # openssl
        libssl-dev \
        # htop for resource monitoring
        htop \
        # for pkill
        procps \
        vim iputils-ping curl iproute2

# INSTALL PHP EXTENSIONS VIA docker-php-ext-install SCRIPT
RUN docker-php-ext-install \
  bcmath \
  calendar \
  ctype \
  dba \
  dom \
  exif \
  fileinfo \
  ftp \
  gettext \
  gd \
  #hash \
  iconv \
  intl \
  mbstring \
  opcache \
  pcntl \
  pdo \
  pdo_pgsql \
  pdo_mysql \
  posix \
  session \
  simplexml \
  soap \
  sockets \
  xsl \
  zip

  # INSTALL COMPOSER
  ENV COMPOSER_HOME /usr/local/composer
  # https://getcomposer.org/doc/03-cli.md#composer-allow-superuser
  ENV COMPOSER_ALLOW_SUPERUSER 1
  RUN set -x \
      && php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
      && php composer-setup.php --install-dir=/usr/bin --filename=composer \
      && rm composer-setup.php \
      && bash -c 'echo -e "{ \"config\" : { \"bin-dir\" : \"/usr/local/bin\" } }\n" > /usr/local/composer/composer.json' \
      && echo "export COMPOSER_HOME=/usr/local/composer" >> /etc/bash.bashrc \
      && composer global require "hirak/prestissimo:^0.3" --prefer-dist --no-progress --no-suggest --classmap-authoritative;
