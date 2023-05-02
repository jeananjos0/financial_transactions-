# Dockerfile
FROM php:8.2-fpm

# Instale extensões do PHP e ferramentas de desenvolvimento
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libssl-dev \
    libzip-dev \
    libonig-dev \
    libjpeg-dev \
    curl \
    debconf \
    git \
    unzip

# Limpe o cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instale extensões do PHP
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl
RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/
RUN docker-php-ext-install gd

# Instale o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Defina o diretório de trabalho
WORKDIR /var/www

# Remova a pasta html padrão e adicione o código do Laravel
RUN rm -rf /var/www/html
COPY . /var/www

# Instale as dependências do Laravel


CMD composer install && php artisan migrate && php artisan serve --host=0.0.0.0 --port=8000

EXPOSE 8000