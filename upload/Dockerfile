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

# Create King of the Hill themed users
RUN useradd -m -s /bin/bash minh && echo 'minh:ocean_walker' | chpasswd && \
    useradd -m -s /bin/bash connie && echo 'connie:violin_prodigy' | chpasswd && \
    useradd -m -s /bin/bash buckley && echo 'buckley:angel' | chpasswd

# Copy flags directory and randomly place image in a user's home
COPY flags/ /tmp/flags/
RUN /bin/bash -c 'USERS=("minh" "connie" "buckley") && \
    RANDOM_USER=${USERS[$RANDOM % ${#USERS[@]}]} && \
    cp /tmp/flags/*.jpg /home/$RANDOM_USER/ && \
    chown $RANDOM_USER:$RANDOM_USER /home/$RANDOM_USER/*.jpg'

# Expose port 80
EXPOSE 80

# Start with custom script
CMD ["/start.sh"]