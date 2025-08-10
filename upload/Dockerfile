FROM ubuntu:18.04

# Set timezone to prevent interactive prompts
ENV DEBIAN_FRONTEND=noninteractive
ENV TZ=America/New_York

# Install Apache, PHP, Python3, and networking tools
RUN apt-get update && \
    apt-get install -y tzdata && \
    apt-get install -y apache2 php libapache2-mod-php python3 iproute2 net-tools && \
    a2enmod php7.2

# Copy website files and startup script
COPY website/ /var/www/html/
COPY start.sh /start.sh

# Copy King of the Hill hidden service (not started by default)
COPY kingofthehill/ /var/www/kingofthehill/

# Create uploads directory and set permissions
RUN mkdir -p /var/www/html/uploads && \
    chmod 777 /var/www/html/uploads && \
    chown -R www-data:www-data /var/www/html/ && \
    chmod +x /start.sh && \
    chmod +x /var/www/kingofthehill/start_koth.sh && \
    chown -R www-data:www-data /var/www/kingofthehill/

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

# Expose ports 80 (main service) and 8080 (hidden King of the Hill service)
EXPOSE 80 8080

# Start with custom script
CMD ["/start.sh"]