# Utilisation d'une image officielle de PHP avec Apache
FROM php:8.1-apache

# Installation des extensions nécessaires
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Afficher les fichiers avant la copie (pour débogage)
RUN echo "Avant copie :"
RUN ls -la /var/www/html

# Copier les fichiers du projet dans le conteneur
COPY . /var/www/html

# Afficher les fichiers après la copie (pour débogage)
RUN echo "Après copie :"
RUN ls -la /var/www/html

# Accorder les droits au répertoire web
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Exposer le port 80 pour le serveur Apache
EXPOSE 80


