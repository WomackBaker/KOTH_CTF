FROM ubuntu:18.04

# Set timezone to prevent interactive prompts
ENV DEBIAN_FRONTEND=noninteractive
ENV TZ=America/New_York

# Install Apache, PHP, and networking tools
RUN apt-get update && \
    apt-get install -y tzdata && \
    apt-get install -y apache2 php libapache2-mod-php iproute2 net-tools && \
    a2enmod php7.2

# Copy website files and startup script
COPY website/ /var/www/html/
COPY start.sh /start.sh

# Create uploads directory and set permissions
RUN mkdir -p /var/www/html/uploads && \
    chmod 777 /var/www/html/uploads && \
    chown -R www-data:www-data /var/www/html/ && \
    chmod +x /start.sh

# Expose port 80
EXPOSE 80

# Start with custom script
CMD ["/start.sh"]