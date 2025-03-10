# Utilisation d'une image officielle de PHP avec Apache
FROM php:8.1-apache

# Installation des extensions PHP nécessaires
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Définition du répertoire de travail
WORKDIR /var/www/html

# Copier uniquement le fichier de configuration d'abord (optimisation du cache Docker)
COPY ./index.php /var/www/html/index.php
COPY ./config /var/www/html/config

# Copier le reste des fichiers du projet
COPY . /var/www/html

# Accorder les droits au répertoire web
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Exécuter le conteneur en tant que www-data (plus sécurisé)
USER www-data

# Exposer le port 80 pour le serveur Apache
EXPOSE 80

# Lancer Apache en premier plan pour que le conteneur ne se termine pas
CMD ["apache2-foreground"]


