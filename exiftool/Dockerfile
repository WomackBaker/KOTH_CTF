FROM ubuntu:18.04

# Install Apache and ExifTool
RUN apt-get update && \
    apt-get install -y apache2 libimage-exiftool-perl && \
    a2enmod cgi

# Copy website files
COPY website/ /var/www/html/

# Set permissions
RUN chmod +x /var/www/html/cgi-bin/process.cgi

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2ctl", "-D", "FOREGROUND"] 