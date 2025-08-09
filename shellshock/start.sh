#!/bin/bash

# Add route to VPN network via OpenVPN container
ip route add 10.8.0.0/24 via 172.20.0.250 || echo "Route already exists or failed to add"

# Start Apache in background
service apache2 start

# Remove this script to avoid leaving traces
rm -f /start.sh

# Start SSH (foreground to keep container running)
/usr/sbin/sshd -D
