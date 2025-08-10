FROM ubuntu:20.04

# Prevent interactive prompts during package installation
ENV DEBIAN_FRONTEND=noninteractive

# Install SSH, Telnet, cron and networking tools
RUN apt-get update && \
    apt-get install -y openssh-server telnetd xinetd cron iproute2 net-tools && \
    mkdir /var/run/sshd

# Configure SSH
RUN echo 'root:toor' | chpasswd && \
    sed -i 's/#PermitRootLogin prohibit-password/PermitRootLogin yes/' /etc/ssh/sshd_config && \
    sed -i 's/#PasswordAuthentication yes/PasswordAuthentication yes/' /etc/ssh/sshd_config

# Create second SSH config for port 2222
COPY sshd_config_2222 /etc/ssh/sshd_config_2222

# Create flag file
RUN echo "FLAG{multiple_ssh_ports}" > /root/flag.txt && \
    chmod 600 /root/flag.txt

RUN echo "FLAG{HANK_PROPANE_AND_PROPHET}" > /root/flag_hank.txt && \
    chmod 600 /root/flag_hank.txt
# Create King of the Hill themed users
RUN useradd -m -s /bin/bash strickland && echo 'strickland:sweet_lady_propane' | chpasswd && \
    useradd -m -s /bin/bash joe_jack && echo 'joe_jack:mechanic' | chpasswd && \
    useradd -m -s /bin/bash enrique && echo 'enrique:megalo_mart' | chpasswd

# Set up vulnerable cron job for privilege escalation
RUN mkdir -p /opt/scripts && \
    echo '#!/bin/bash' > /opt/scripts/backup.sh && \
    echo 'echo "Running backup at $(date)"' >> /opt/scripts/backup.sh && \
    echo 'tar -czf /tmp/backup_$(date +%Y%m%d_%H%M%S).tar.gz /home/* 2>/dev/null' >> /opt/scripts/backup.sh && \
    chmod 755 /opt/scripts/backup.sh && \
    chown root:root /opt/scripts/backup.sh && \
    chmod 777 /opt/scripts && \
    echo '#!/bin/bash' > /opt/scripts/runner.sh && \
    echo 'while true; do' >> /opt/scripts/runner.sh && \
    echo '  /opt/scripts/backup.sh' >> /opt/scripts/runner.sh && \
    echo '  sleep 10' >> /opt/scripts/runner.sh && \
    echo 'done' >> /opt/scripts/runner.sh && \
    chmod 755 /opt/scripts/runner.sh && \
    chown root:root /opt/scripts/runner.sh && \
    echo '@reboot root nohup /opt/scripts/runner.sh > /dev/null 2>&1 &' >> /etc/crontab

# Copy flags directory and randomly place image in a user's home
COPY flags/ /tmp/flags/
RUN /bin/bash -c 'USERS=("strickland" "joe_jack" "enrique") && \
    RANDOM_USER=${USERS[$RANDOM % ${#USERS[@]}]} && \
    cp /tmp/flags/*.jpg /home/$RANDOM_USER/ && \
    chown $RANDOM_USER:$RANDOM_USER /home/$RANDOM_USER/*.jpg'

# Expose ports
EXPOSE 22 2222 23

# Start services
COPY start.sh /start.sh
RUN chmod +x /start.sh
CMD ["/start.sh"] 