FROM ubuntu:20.04

# Prevent interactive prompts during package installation
ENV DEBIAN_FRONTEND=noninteractive

# Install SSH, Telnet and networking tools
RUN apt-get update && \
    apt-get install -y openssh-server telnetd xinetd iproute2 net-tools && \
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

# Expose ports
EXPOSE 22 2222 23

# Start services
COPY start.sh /start.sh
RUN chmod +x /start.sh
CMD ["/start.sh"] 