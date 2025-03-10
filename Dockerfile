# Utilisation d'une image officielle de PHP avec Apache
FROM php:8.1-apache

# Installation des extensions nécessaires pour MariaDB/MySQL
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Copier les fichiers du projet dans le conteneur
COPY . /var/www/html

# Définition du répertoire de travail
WORKDIR /var/www/html

# Accorder les droits au répertoire web et s'assurer que le serveur a accès aux fichiers
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html \
    && chmod -R 755 /var/www

# Activer le module de réécriture d'Apache (utile si besoin de réécriture d'URL)
RUN a2enmod rewrite

# Exposer le port 80 pour le serveur Apache
EXPOSE 80

# Lancer Apache en mode foreground
CMD ["apache2-foreground"]


