FROM ubuntu:18.04

# Prevent interactive prompts during package installation
ENV DEBIAN_FRONTEND=noninteractive

# Install Java, wget, networking tools, and SSH
RUN apt-get update && \
    apt-get install -y default-jdk wget iproute2 net-tools openssh-server && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# Download and install a specific vulnerable Tomcat version
RUN cd /tmp && \
    wget https://archive.apache.org/dist/tomcat/tomcat-9/v9.0.30/bin/apache-tomcat-9.0.30.tar.gz && \
    tar xzf apache-tomcat-9.0.30.tar.gz && \
    mv apache-tomcat-9.0.30 /usr/share/tomcat9 && \
    rm apache-tomcat-9.0.30.tar.gz

# Create necessary directories and set up Tomcat structure
RUN mkdir -p /usr/share/tomcat9/conf && \
    mkdir -p /usr/share/tomcat9/temp && \
    mkdir -p /var/lib/tomcat9/webapps && \
    ln -sf /usr/share/tomcat9/webapps /var/lib/tomcat9/webapps

# Copy configuration files
COPY server.xml /usr/share/tomcat9/conf/server.xml
COPY tomcat-users.xml /usr/share/tomcat9/conf/tomcat-users.xml

# Copy web application
COPY webapp/ /usr/share/tomcat9/webapps/ROOT/

# Create flag file
RUN echo "FLAG{ghostcat_vulnerability}" > /var/lib/tomcat9/flag.txt && \
    chmod 644 /var/lib/tomcat9/flag.txt

# Configure SSH
RUN mkdir /var/run/sshd && \
    echo 'PermitRootLogin yes' >> /etc/ssh/sshd_config && \
    echo 'PasswordAuthentication yes' >> /etc/ssh/sshd_config && \
    sed -i 's/#Port 22/Port 22/' /etc/ssh/sshd_config

# Create King of the Hill themed users
RUN useradd -m -s /bin/bash bobby && echo 'bobby:thats_my_purse' | chpasswd && \
    useradd -m -s /bin/bash peggy && echo 'peggy:substitute' | chpasswd && \
    useradd -m -s /bin/bash luanne && echo 'luanne:beauty' | chpasswd

# Copy flags directory and randomly place image in a user's home
COPY flags/ /tmp/flags/
RUN USERS=("bobby" "peggy" "luanne") && \
    RANDOM_USER=${USERS[$RANDOM % ${#USERS[@]}]} && \
    cp /tmp/flags/*.jpg /home/$RANDOM_USER/ && \
    chown $RANDOM_USER:$RANDOM_USER /home/$RANDOM_USER/*.jpg

# Copy startup script
COPY start.sh /start.sh
RUN chmod +x /start.sh

# Expose ports
EXPOSE 8009 8080 22

# Start Tomcat with routing
CMD ["/start.sh"] 