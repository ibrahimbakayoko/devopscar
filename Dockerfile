# Utilisation de l'image officielle de PHP avec Apache
FROM php:8.1-apache

# Installation des extensions PHP nécessaires
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Définition du répertoire de travail
WORKDIR /var/www/html

# Copier tous les fichiers du projet dans le conteneur
COPY . /var/www/html

# Accorder les droits au répertoire web
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Exposer le port 80 pour le serveur Apache
EXPOSE 80

# Lancer Apache en premier plan pour que le conteneur reste actif
CMD ["apache2-foreground"]


