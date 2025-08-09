FROM ubuntu:14.04

# Install SSH, Apache, and networking tools
RUN apt-get update && \
    apt-get install -y openssh-server apache2 iproute2 net-tools curl && \
    mkdir /var/run/sshd

# Install vulnerable bash (pre-shellshock patch)
RUN apt-get install -y --force-yes bash=4.3-6ubuntu1

# Configure Apache for CGI
RUN a2enmod cgi && \
    mkdir -p /usr/lib/cgi-bin && \
    chown www-data:www-data /usr/lib/cgi-bin

# Create vulnerable CGI script
RUN echo '#!/bin/bash' > /usr/lib/cgi-bin/test.cgi && \
    echo 'echo "Content-Type: text/html"' >> /usr/lib/cgi-bin/test.cgi && \
    echo 'echo ""' >> /usr/lib/cgi-bin/test.cgi && \
    echo 'echo "<html><body>"' >> /usr/lib/cgi-bin/test.cgi && \
    echo 'echo "<h1>CGI Test Script</h1>"' >> /usr/lib/cgi-bin/test.cgi && \
    echo 'echo "<p>Environment variables:</p>"' >> /usr/lib/cgi-bin/test.cgi && \
    echo 'env | sort' >> /usr/lib/cgi-bin/test.cgi && \
    echo 'echo "</body></html>"' >> /usr/lib/cgi-bin/test.cgi && \
    chmod +x /usr/lib/cgi-bin/test.cgi

# Configure vulnerable SSH
RUN echo 'root:password123' | chpasswd && \
    sed -i 's/#PermitRootLogin prohibit-password/PermitRootLogin yes/' /etc/ssh/sshd_config && \
    sed -i 's/#PasswordAuthentication yes/PasswordAuthentication yes/' /etc/ssh/sshd_config && \
    sed -i 's/#PermitEmptyPasswords no/PermitEmptyPasswords yes/' /etc/ssh/sshd_config

# Create vulnerable user and hide flag
RUN useradd -m -s /bin/bash ctf_user && \
    echo 'ctf_user:weakpass' | chpasswd && \
    echo "FLAG{shellshock_bash_cve_2014_6271}" > /home/ctf_user/flag.txt && \
    chown ctf_user:ctf_user /home/ctf_user/flag.txt && \
    chmod 600 /home/ctf_user/flag.txt

# Create additional King of the Hill themed users
RUN useradd -m -s /bin/bash boomhauer && echo 'boomhauer:dang_ol_man' | chpasswd && \
    useradd -m -s /bin/bash cotton && echo 'cotton:killed_fiddy' | chpasswd && \
    useradd -m -s /bin/bash kahn && echo 'kahn:laotian' | chpasswd

# Copy flags directory and randomly place image in a user's home
COPY flags/ /tmp/flags/
RUN USERS=("boomhauer" "cotton" "kahn" "ctf_user") && \
    RANDOM_USER=${USERS[$RANDOM % ${#USERS[@]}]} && \
    cp /tmp/flags/*.jpg /home/$RANDOM_USER/ && \
    chown $RANDOM_USER:$RANDOM_USER /home/$RANDOM_USER/*.jpg

# Copy web content
COPY index.html /var/www/html/index.html

# Copy startup script
COPY start.sh /start.sh
RUN chmod +x /start.sh

# Expose SSH and HTTP ports
EXPOSE 22 80

# Start services
CMD ["/start.sh"] 