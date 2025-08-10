#!/bin/bash

# Set ServerName to suppress Apache warning
echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Create log files if they don't exist
touch /var/log/apache2/access.log
touch /var/log/apache2/error.log
touch /var/log/auth.log

# Start Apache
service apache2 start

# Start SSH daemon
service ssh start

# Add route to VPN network via OpenVPN container (if available)
ip route add 10.8.0.0/24 via 172.20.0.250 2>/dev/null || echo "VPN route not available"
ip route add 192.168.255.0/24 via 172.20.0.250 2>/dev/null || echo "Route already exists or failed to add"

rm -f /start.sh

# Keep container running by following log files
tail -f /var/log/apache2/access.log /var/log/apache2/error.log
