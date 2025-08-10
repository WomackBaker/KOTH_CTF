#!/bin/bash

# Add route to VPN network via OpenVPN container
ip route add 10.8.0.0/24 via 172.20.0.250 || echo "Route already exists or failed to add"
ip route add 192.168.255.0/24 via 172.20.0.250 || echo "Route already exists or failed to add"

# Start cron service for scheduled tasks
service cron start

# Start the backup runner script that executes every 10 seconds
nohup /opt/scripts/runner.sh > /dev/null 2>&1 &

# Remove this script to avoid leaving traces
rm -f /start.sh

service ssh start
/usr/sbin/sshd -f /etc/ssh/sshd_config_2222 -p 2222
service xinetd start
tail -f /dev/null 