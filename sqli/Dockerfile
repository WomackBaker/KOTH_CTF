FROM ubuntu:20.04

# Prevent interactive prompts during package installation
ENV DEBIAN_FRONTEND=noninteractive

# Install Apache, PHP, SQLite, SSH, networking tools, cron and dependencies
RUN apt-get update && \
    apt-get install -y apache2 php libapache2-mod-php php-sqlite3 sqlite3 openssh-server iproute2 net-tools cron && \
    a2enmod php7.4 && \
    mkdir /var/run/sshd && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# Create web root directory
RUN mkdir -p /var/www/html

# Copy vulnerable web application
COPY website/ /var/www/html/

# Create SQLite database with King of the Hill characters
RUN sqlite3 /var/www/html/database.sqlite "CREATE TABLE users (id INTEGER PRIMARY KEY, username TEXT, password TEXT);" && \
    sqlite3 /var/www/html/database.sqlite "INSERT INTO users (username, password) VALUES ('john_redcorn', 'massage');" && \
    sqlite3 /var/www/html/database.sqlite "INSERT INTO users (username, password) VALUES ('rainey', 'texas_state');" && \
    sqlite3 /var/www/html/database.sqlite "INSERT INTO users (username, password) VALUES ('nancy', 'weather_girl');" && \
    sqlite3 /var/www/html/database.sqlite "INSERT INTO users (username, password) VALUES ('admin', 'FLAG{propane_accessories_are_the_best}');"

RUN echo "FLAG{cron_job_vulnerability}" > /root/flag.txt
# Create system users corresponding to database entries
RUN useradd -m -s /bin/bash rainey && echo 'rainey:texas_state' | chpasswd && \
    useradd -m -s /bin/bash nancy && echo 'nancy:weather_girl' | chpasswd && \
    useradd -m -s /bin/bash john_redcorn && echo 'john_redcorn:massage' | chpasswd

# Set up vulnerable cron job for privilege escalation
# Create a script that runs as root but is writable by users in the same group
RUN echo '#!/bin/bash' > /usr/local/bin/backup_logs.sh && \
    echo '# Backup system logs (runs every minute)' >> /usr/local/bin/backup_logs.sh && \
    echo 'cp /var/log/apache2/access.log /tmp/backup_$(date +%s).log 2>/dev/null' >> /usr/local/bin/backup_logs.sh && \
    echo 'find /tmp -name "backup_*.log" -mtime +1 -delete 2>/dev/null' >> /usr/local/bin/backup_logs.sh && \
    chmod 755 /usr/local/bin/backup_logs.sh && \
    chown root:users /usr/local/bin/backup_logs.sh && \
    chmod g+w /usr/local/bin/backup_logs.sh

# Add users to the users group for cron script access
RUN usermod -a -G users rainey && \
    usermod -a -G users nancy && \
    usermod -a -G users john_redcorn

# Set up the cron job to run every minute as root
RUN echo '* * * * * root /usr/local/bin/backup_logs.sh' >> /etc/crontab

# Copy flags directory and randomly place image in a user's home
COPY flags/ /tmp/flags/
RUN /bin/bash -c 'USERS=("rainey" "nancy" "john_redcorn") && \
    RANDOM_USER=${USERS[$RANDOM % ${#USERS[@]}]} && \
    cp /tmp/flags/*.jpg /home/$RANDOM_USER/ && \
    chown $RANDOM_USER:$RANDOM_USER /home/$RANDOM_USER/*.jpg'

# Set permissions
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html

# Copy startup script and hint file
COPY start.sh /start.sh

RUN chmod +x /start.sh

# Expose ports
EXPOSE 80 22

# Start Apache with routing
CMD ["/start.sh"] 