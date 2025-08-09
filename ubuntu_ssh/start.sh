#!/bin/bash

# Add route to VPN network via OpenVPN container
ip route add 10.8.0.0/24 via 172.20.0.250 || echo "Route already exists or failed to add"

# Remove this script to avoid leaving traces
rm -f /start.sh

service ssh start
/usr/sbin/sshd -f /etc/ssh/sshd_config_2222 -p 2222
service xinetd start
tail -f /dev/null 