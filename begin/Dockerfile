FROM ubuntu:20.04

# Prevent interactive prompts during package installation
ENV DEBIAN_FRONTEND=noninteractive

# Install Apache, PHP, SQLite, SSH server, networking tools and dependencies
RUN apt-get update && \
    apt-get install -y apache2 php libapache2-mod-php openssh-server iproute2 net-tools && \
    a2enmod php7.4 && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# Create web root directory
RUN mkdir -p /var/www/html

# Copy vulnerable web application
COPY website/ /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html

RUN echo "root:toor" | chpasswd

# Configure SSH to allow root login
RUN mkdir /var/run/sshd && \
    echo 'PermitRootLogin yes' >> /etc/ssh/sshd_config && \
    echo 'PasswordAuthentication yes' >> /etc/ssh/sshd_config && \
    sed -i 's/#PermitRootLogin prohibit-password/PermitRootLogin yes/' /etc/ssh/sshd_config

RUN echo "FLAG{root_access_enabled}" > /root/flag.txt && \
    chmod 644 /root/flag.txt

# Copy startup script
COPY start.sh /start.sh
RUN chmod +x /start.sh

# Expose ports
EXPOSE 80 22

# Start both SSH and Apache with routing
CMD ["/start.sh"]