# Utilisation d'une image officielle de PHP avec Apache
FROM php:8.1-apache

# Installation des extensions nécessaires
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Copier les fichiers du projet dans le conteneur
COPY . /var/www/html

# Définition du répertoire de travail
WORKDIR /var/www/html

# Exposer le port 80 pour le serveur Apache
EXPOSE 80
