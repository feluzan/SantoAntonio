# Dockerfile
FROM php:7.4-apache

# Pacotes de sistema necessários
RUN apt-get update && apt-get install -y \
    libonig-dev \
    libldap2-dev \
    libzip-dev \
    libxml2-dev \
    unzip \
    git \
 && rm -rf /var/lib/apt/lists/*

# Extensões PHP necessárias (ldap, pdo_mysql, mbstring, xml, zip)
# Obs: o caminho lib/x86_64-linux-gnu/ funciona nas imagens Debian slim/bullseye
RUN docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu
RUN docker-php-ext-install -j$(nproc) ldap
RUN docker-php-ext-install -j$(nproc) pdo
RUN docker-php-ext-install -j$(nproc) pdo_mysql
RUN docker-php-ext-install -j$(nproc) mbstring
RUN docker-php-ext-install -j$(nproc) xml
RUN docker-php-ext-install -j$(nproc) zip

# (Opcional) GD, se seu app usar imagens
# RUN apt-get update && apt-get install -y libpng-dev libjpeg62-turbo-dev libfreetype6-dev \
#  && docker-php-ext-configure gd --with-freetype --with-jpeg \
#  && docker-php-ext-install -j$(nproc) gd

# Habilitar mod_rewrite (útil para Laravel)
RUN a2enmod rewrite

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Defina o docroot para /workspace/public se for Laravel
ENV APACHE_DOCUMENT_ROOT=/workspace/public
RUN sed -ri 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf /etc/apache2/apache2.conf /etc/apache2/sites-enabled/000-default.conf

WORKDIR /workspace
