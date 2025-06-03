FROM ubuntu:18.04

# Install SSH
RUN apt-get update && \
    apt-get install -y openssh-server && \
    mkdir /var/run/sshd

# Configure vulnerable SSH
RUN echo 'root:password123' | chpasswd && \
    sed -i 's/#PermitRootLogin prohibit-password/PermitRootLogin yes/' /etc/ssh/sshd_config && \
    sed -i 's/#PasswordAuthentication yes/PasswordAuthentication yes/' /etc/ssh/sshd_config && \
    sed -i 's/#PermitEmptyPasswords no/PermitEmptyPasswords yes/' /etc/ssh/sshd_config

# Create vulnerable user
RUN useradd -m -s /bin/bash ctf_user && \
    echo 'ctf_user:weakpass' | chpasswd && \
    echo "FLAG{weak_ssh_config}" > /home/ctf_user/flag.txt && \
    chown ctf_user:ctf_user /home/ctf_user/flag.txt && \
    chmod 600 /home/ctf_user/flag.txt

# Expose SSH port
EXPOSE 22

# Start SSH
CMD ["/usr/sbin/sshd", "-D"] 