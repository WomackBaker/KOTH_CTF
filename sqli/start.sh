#!/bin/bash

# Add route to VPN network via OpenVPN container
ip route add 10.8.0.0/24 via 172.20.0.250 || echo "Route already exists or failed to add"
ip route add 192.168.255.0/24 via 172.20.0.250 || echo "Route already exists or failed to add"

# Start cron service
service cron start

# Start SSH daemon
service ssh start

# Remove this script to avoid leaving traces
rm -f /start.sh

# Start Apache
apache2ctl -D FOREGROUND
