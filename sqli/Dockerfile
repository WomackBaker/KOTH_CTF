FROM ubuntu:20.04

# Prevent interactive prompts during package installation
ENV DEBIAN_FRONTEND=noninteractive

# Install Apache, PHP, SQLite, networking tools and dependencies
RUN apt-get update && \
    apt-get install -y apache2 php libapache2-mod-php php-sqlite3 sqlite3 iproute2 net-tools && \
    a2enmod php7.4 && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# Create web root directory
RUN mkdir -p /var/www/html

# Copy vulnerable web application
COPY website/ /var/www/html/

# Create SQLite database with King of the Hill characters
RUN sqlite3 /var/www/html/database.sqlite "CREATE TABLE users (id INTEGER PRIMARY KEY, username TEXT, password TEXT);" && \
    sqlite3 /var/www/html/database.sqlite "INSERT INTO users (username, password) VALUES ('hank', 'propane123');" && \
    sqlite3 /var/www/html/database.sqlite "INSERT INTO users (username, password) VALUES ('dale', 'conspiracy');" && \
    sqlite3 /var/www/html/database.sqlite "INSERT INTO users (username, password) VALUES ('bill', 'army_strong');" && \
    sqlite3 /var/www/html/database.sqlite "INSERT INTO users (username, password) VALUES ('boomhauer', 'fast_talker');" && \
    sqlite3 /var/www/html/database.sqlite "INSERT INTO users (username, password) VALUES ('bobby', 'thats_my_purse');" && \
    sqlite3 /var/www/html/database.sqlite "INSERT INTO users (username, password) VALUES ('peggy', 'substitute_teacher');" && \
    sqlite3 /var/www/html/database.sqlite "INSERT INTO users (username, password) VALUES ('luanne', 'beauty_school');" && \
    sqlite3 /var/www/html/database.sqlite "INSERT INTO users (username, password) VALUES ('cotton', 'killed_fiddy_men');" && \
    sqlite3 /var/www/html/database.sqlite "INSERT INTO users (username, password) VALUES ('kahn', 'laotian_pride');" && \
    sqlite3 /var/www/html/database.sqlite "INSERT INTO users (username, password) VALUES ('admin', 'FLAG{propane_accessories_are_the_best}');"

# Create system users corresponding to database entries
RUN useradd -m -s /bin/bash rainey && echo 'rainey:texas_state' | chpasswd && \
    useradd -m -s /bin/bash nancy && echo 'nancy:weather_girl' | chpasswd && \
    useradd -m -s /bin/bash john_redcorn && echo 'john_redcorn:massage' | chpasswd

# Copy flags directory and randomly place image in a user's home
COPY flags/ /tmp/flags/
RUN USERS=("rainey" "nancy" "john_redcorn") && \
    RANDOM_USER=${USERS[$RANDOM % ${#USERS[@]}]} && \
    cp /tmp/flags/*.jpg /home/$RANDOM_USER/ && \
    chown $RANDOM_USER:$RANDOM_USER /home/$RANDOM_USER/*.jpg

# Set permissions
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html

# Copy startup script
COPY start.sh /start.sh
RUN chmod +x /start.sh

# Expose port
EXPOSE 80

# Start Apache with routing
CMD ["/start.sh"] 