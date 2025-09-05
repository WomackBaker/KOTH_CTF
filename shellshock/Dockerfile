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
RUN echo '#!/bin/bash' > /usr/lib/cgi-bin/reservations.cgi && \
    echo 'echo "Content-Type: text/html"' >> /usr/lib/cgi-bin/reservations.cgi && \
    echo 'echo ""' >> /usr/lib/cgi-bin/reservations.cgi && \
    echo 'echo "<html><head><title>Nine Rivers Country Club - Reservations</title></head><body>"' >> /usr/lib/cgi-bin/reservations.cgi && \
    echo 'echo "<h2>Nine Rivers Country Club</h2>"' >> /usr/lib/cgi-bin/reservations.cgi && \
    echo 'echo "<h3>Dining Reservation System</h3>"' >> /usr/lib/cgi-bin/reservations.cgi && \
    echo 'echo "<p>Welcome to our reservation system. Please select your preferred dining time:</p>"' >> /usr/lib/cgi-bin/reservations.cgi && \
    echo 'echo "<form method=\"GET\">"' >> /usr/lib/cgi-bin/reservations.cgi && \
    echo 'echo "<select name=\"time\"><option>5:00 PM</option><option>6:00 PM</option><option>7:00 PM</option><option>8:00 PM</option></select><br><br>"' >> /usr/lib/cgi-bin/reservations.cgi && \
    echo 'echo "<input type=\"text\" name=\"name\" placeholder=\"Your Name\" required><br><br>"' >> /usr/lib/cgi-bin/reservations.cgi && \
    echo 'echo "<input type=\"text\" name=\"phone\" placeholder=\"Phone Number\" required><br><br>"' >> /usr/lib/cgi-bin/reservations.cgi && \
    echo 'echo "<input type=\"submit\" value=\"Make Reservation\">"' >> /usr/lib/cgi-bin/reservations.cgi && \
    echo 'echo "</form>"' >> /usr/lib/cgi-bin/reservations.cgi && \
    echo 'echo "<hr><small>System Status: $(date)</small>"' >> /usr/lib/cgi-bin/reservations.cgi && \
    echo 'echo "<br><small>Debug Info (Internal Use Only):</small><br>"' >> /usr/lib/cgi-bin/reservations.cgi && \
    echo 'echo "<div style=\"font-size:10px; color:#999; max-height:100px; overflow:auto;\">"' >> /usr/lib/cgi-bin/reservations.cgi && \
    echo 'env | sort | head -20' >> /usr/lib/cgi-bin/reservations.cgi && \
    echo 'echo "</div>"' >> /usr/lib/cgi-bin/reservations.cgi && \
    echo 'echo "</body></html>"' >> /usr/lib/cgi-bin/reservations.cgi && \
    chmod +x /usr/lib/cgi-bin/reservations.cgi

RUN echo "FLAG{suids_are_fun}" > /root/flag.txt
# Create additional King of the Hill themed users
RUN useradd -m -s /bin/bash boomhauer && echo 'boomhauer:dang_ol_man' | chpasswd && \
    useradd -m -s /bin/bash cotton && echo 'cotton:killed_fiddy' | chpasswd && \
    useradd -m -s /bin/bash kahn && echo 'kahn:laotian' | chpasswd

RUN echo "FLAG{shellshock_bash_cve_2014_6271}" > /home/kahn/flag.txt

# Set up SUID binary for privilege escalation
RUN chmod u+s /usr/bin/find

# Copy flags directory and randomly place image in a user's home
COPY flags/ /tmp/flags/
RUN /bin/bash -c 'USERS=("boomhauer" "cotton" "kahn") && \
    RANDOM_USER=${USERS[$RANDOM % ${#USERS[@]}]} && \
    cp /tmp/flags/*.jpg /home/$RANDOM_USER/ && \
    chown $RANDOM_USER:$RANDOM_USER /home/$RANDOM_USER/*.jpg'


# Copy web content
COPY index.html /var/www/html/index.html

# Allow kahn to run find as root without password
RUN echo "kahn ALL=(ALL) NOPASSWD: /usr/bin/find" >> /etc/sudoers

RUN echo "root ALL=(ALL) ALL" >> /etc/sudoers

RUN echo "Hello Kahn, We are pleased to inform you that you have been accepted into Nine Rivers Country Club. Please use the following password to view all of your reservations: laotian" > /home/kahn/welcome.txt
# Copy startup script and make it executable
COPY start.sh /start.sh
RUN chmod +x /start.sh

# Expose SSH and HTTP ports
EXPOSE 22 80

# Start services
CMD ["/bin/bash", "-c", "if [ -f /start.sh ]; then /start.sh; else tail -f /dev/null; fi"]