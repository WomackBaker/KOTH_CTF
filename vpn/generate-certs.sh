#!/bin/bash

# Set up the PKI
mkdir -p /etc/openvpn/easy-rsa/
cp -r /usr/share/easy-rsa/* /etc/openvpn/easy-rsa/
cd /etc/openvpn/easy-rsa/

# Initialize PKI
./easyrsa init-pki

# Build CA
./easyrsa build-ca nopass

# Generate server certificate and key
./easyrsa build-server-full server nopass

# Generate client certificate and key
./easyrsa build-client-full client1.domain.tld nopass

# Generate DH parameters
./easyrsa gen-dh

# Copy certificates and keys to OpenVPN directory
cp pki/ca.crt /etc/openvpn/
cp pki/issued/server.crt /etc/openvpn/
cp pki/private/server.key /etc/openvpn/
cp pki/dh.pem /etc/openvpn/dh2048.pem

# Generate client config
cd /etc/openvpn
cp client-template.txt client-configs/client1.ovpn
sed -i "s/SERVER_IP/$(hostname -I | awk '{print $1}')/" client-configs/client1.ovpn

# Add certificates to client config
echo "<ca>" >> client-configs/client1.ovpn
cat pki/ca.crt >> client-configs/client1.ovpn
echo "</ca>" >> client-configs/client1.ovpn

echo "<cert>" >> client-configs/client1.ovpn
cat pki/issued/client1.domain.tld.crt >> client-configs/client1.ovpn
echo "</cert>" >> client-configs/client1.ovpn

echo "<key>" >> client-configs/client1.ovpn
cat pki/private/client1.domain.tld.key >> client-configs/client1.ovpn
echo "</key>" >> client-configs/client1.ovpn 