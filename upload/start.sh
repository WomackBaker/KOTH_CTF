#!/bin/bash

# Add route to VPN network via OpenVPN container
ip route add 10.8.0.0/24 via 172.20.0.250 || echo "Route already exists or failed to add"
ip route add 192.168.255.0/24 via 172.20.0.250 || echo "Route already exists or failed to add"

echo 'root:1234567' | chpasswd
# Allow root login via SSH
sed -i 's/^#*PermitRootLogin .*/PermitRootLogin yes/' /etc/ssh/sshd_config
service ssh restart
echo "fcea920f7412b5da7be0cf42b8c93759" > /home/connie/hash.txt

# Hidden hint: There's a King of the Hill service waiting to be discovered
echo "Psst... Hank Hill left something special in /var/www/kingofthehill/" > /home/minh/hint.txt

# Remove this script to avoid leaving traces
rm -f /start.sh

# Start Apache
exec apache2ctl -D FOREGROUND
