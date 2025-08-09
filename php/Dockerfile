FROM ubuntu:20.04

# Prevent interactive prompts during package installation
ENV DEBIAN_FRONTEND=noninteractive

# Install Apache, PHP, MySQL and networking tools
RUN apt-get update && \
    apt-get install -y apache2 php php-mysql mariadb-server iproute2 net-tools && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# Start MySQL and create database
RUN service mysql start && \
    mysql -e "CREATE DATABASE ctf_db;" && \
    mysql -e "CREATE TABLE ctf_db.users (id INT, username VARCHAR(50), password VARCHAR(50));" && \
    mysql -e "INSERT INTO ctf_db.users VALUES (1, 'admin', 'admin123');"

# Copy website files
COPY website/ /var/www/html/

# Copy hidden image
COPY exif_images/error_report.jpg /var/log/apache2/

# Create flag file
RUN echo "FLAG{sqli_vulnerable_php}" > /var/www/html/flag.txt && \
    chmod 644 /var/www/html/flag.txt

# Copy startup script
COPY start.sh /start.sh
RUN chmod +x /start.sh

# Expose ports
EXPOSE 80 3306

# Start services with routing
CMD ["/start.sh"] 