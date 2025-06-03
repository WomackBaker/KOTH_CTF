FROM ubuntu:20.04

# Install OpenVPN and dependencies
RUN apt-get update && \
    apt-get install -y openvpn easy-rsa && \
    rm -rf /var/lib/apt/lists/*

# Copy configuration files
COPY server.conf /etc/openvpn/server.conf
COPY client-template.txt /etc/openvpn/client-template.txt
COPY generate-certs.sh /etc/openvpn/generate-certs.sh

# Make scripts executable
RUN chmod +x /etc/openvpn/generate-certs.sh

# Create directory for client configs
RUN mkdir -p /etc/openvpn/client-configs

# Generate certificates and keys
RUN /etc/openvpn/generate-certs.sh

# Expose OpenVPN port
EXPOSE 1194/udp

# Start OpenVPN
CMD ["openvpn", "--config", "/etc/openvpn/server.conf"] 