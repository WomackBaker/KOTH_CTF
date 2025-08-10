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

RUN echo "FLAG{BWAAHAA}" > /root/flag.txt && \
    chmod 644 /root/flag.txt
# Configure SSH to allow root login
RUN mkdir /var/run/sshd && \
    echo 'PermitRootLogin yes' >> /etc/ssh/sshd_config && \
    echo 'PasswordAuthentication yes' >> /etc/ssh/sshd_config && \
    sed -i 's/#PermitRootLogin prohibit-password/PermitRootLogin yes/' /etc/ssh/sshd_config

# Create King of the Hill themed users
RUN useradd -m -s /bin/bash hank && echo 'hank:propane123' | chpasswd && \
    useradd -m -s /bin/bash dale && echo 'dale:conspiracy' | chpasswd && \
    useradd -m -s /bin/bash bill && echo 'bill:army' | chpasswd

# Copy flags directory and randomly place image in a user's home
COPY flags/ /tmp/flags/
RUN /bin/bash -c 'USERS=("hank" "dale" "bill") && \
    RANDOM_USER=${USERS[$RANDOM % ${#USERS[@]}]} && \
    cp /tmp/flags/*.jpg /home/$RANDOM_USER/ && \
    chown $RANDOM_USER:$RANDOM_USER /home/$RANDOM_USER/*.jpg'

RUN echo "FLAG{root_access_enabled}" > /root/flag.txt && \
    chmod 644 /root/flag.txt

# Copy startup script
COPY start.sh /start.sh
RUN chmod +x /start.sh

# Expose ports
EXPOSE 80 22

# Start both SSH and Apache with routing
CMD ["/start.sh"]