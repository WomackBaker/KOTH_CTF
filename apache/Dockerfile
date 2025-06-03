FROM ubuntu:20.04

# Prevent interactive prompts during package installation
ENV DEBIAN_FRONTEND=noninteractive

# Install Apache, PHP, SQLite and dependencies
RUN apt-get update && \
    apt-get install -y apache2 php libapache2-mod-php php-sqlite3 sqlite3 && \
    a2enmod php7.4 && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# Create web root directory
RUN mkdir -p /var/www/html

# Copy vulnerable web application
COPY vulnerable_app/ /var/www/html/

# Create SQLite database with test user
RUN sqlite3 /var/www/html/database.sqlite "CREATE TABLE users (id INTEGER PRIMARY KEY, username TEXT, password TEXT);" && \
    sqlite3 /var/www/html/database.sqlite "INSERT INTO users (username, password) VALUES ('admin', 'password123');"

# Set permissions
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html

# Expose port
EXPOSE 80

# Start Apache
CMD ["apache2ctl", "-D", "FOREGROUND"] 