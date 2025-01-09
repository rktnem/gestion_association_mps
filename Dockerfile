FROM ubuntu/apache2:edge

RUN apt-get update && apt-get install -y \
    php8.2 libapache2-mod-php8.2 php8.2-cli php8.2-mysql php8.2-intl php8.2-opcache php8.2-xml php8.2-mbstring php8.2-zip unzip git curl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://get.symfony.com/cli/installer | bash

# Activer les modules Apache nécessaires
RUN a2enmod php8.2 rewrite

# Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app

COPY . .

RUN chown -R www-data:www-data /app

RUN composer install

EXPOSE 8000

