#!/bin/bash

# Start SSH service
service ssh start

# Start Apache
service apache2 start
ip route add 10.8.0.0/24 via 172.20.0.189 || echo "Route already exists or failed to add"
ip route add 192.168.255.0/24 via 172.20.0.189 || echo "Route already exists or failed to add"

# Keep container running
tail -f /var/log/apache2/access.log /var/log/apache2/error.log
