# Utilisation de l'image PHP avec Apache
FROM php:8.1-apache

# Installation des extensions nécessaires
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Copier les fichiers du projet dans le conteneur
COPY ProjetKarl/.  /var/www/html

# Copier la configuration Apache personnalisée
COPY ProjetKarl/my_custom_apache.conf /etc/apache2/sites-available/000-default.conf

# Activer le module de réécriture pour Apache (si nécessaire)
RUN a2enmod rewrite

# Définir les droits sur le répertoire web
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Exposer le port 80 pour Apache
EXPOSE 80


