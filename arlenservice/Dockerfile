FROM ubuntu:20.04

# Prevent interactive prompts during package installation
ENV DEBIAN_FRONTEND=noninteractive

# Install Apache, PHP, SSH, and networking tools
RUN apt-get update && \
    apt-get install -y apache2 php libapache2-mod-php openssh-server sudo \
                       net-tools iproute2 curl vim nano && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# Enable Apache modules
RUN a2enmod rewrite ssl php7.4

# Configure SSH
RUN mkdir /var/run/sshd && \
    echo 'PermitRootLogin yes' >> /etc/ssh/sshd_config && \
    echo 'PasswordAuthentication yes' >> /etc/ssh/sshd_config && \
    sed -i 's/#Port 22/Port 22/' /etc/ssh/sshd_config

# Create Arlen Service Center themed users
RUN useradd -m -s /bin/bash propane_tech && echo 'propane_tech:sweetlady' | chpasswd && \
    useradd -m -s /bin/bash strickland && echo 'strickland:propane123' | chpasswd && \
    useradd -m -s /bin/bash mechanic && echo 'mechanic:automotive' | chpasswd

# Create service center flag
RUN echo "FLAG{PROPANE_PURIST}" > /var/www/html/service_flag.txt && \
    chmod 644 /var/www/html/service_flag.txt

# Create additional flags for users
RUN echo "FLAG{HANKS_MANNERS}" > /home/propane_tech/flag.txt && \
    echo "FLAG{BILL_SAD_SONG}" > /home/strickland/flag.txt && \
    chown propane_tech:propane_tech /home/propane_tech/flag.txt && \
    chown strickland:strickland /home/strickland/flag.txt

# Copy website files
COPY website/ /var/www/html/

# Copy flag files
COPY flags/ /tmp/flags/
RUN if [ -d /tmp/flags ]; then \
        cp /tmp/flags/*.jpg /var/www/html/ 2>/dev/null || true; \
    fi

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html

# Copy startup script
COPY start.sh /start.sh
RUN chmod +x /start.sh

# Expose ports
EXPOSE 80 22

# Start services
CMD ["/start.sh"]
