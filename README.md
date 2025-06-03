# CTF Environment

This environment contains multiple machines with various challenges. Some information might be hidden in unexpected places.

## Connecting to the Network

To access the CTF environment, you'll need to connect to the VPN:

1. Download the OpenVPN configuration file:
   - After starting the environment, the client configuration will be available in the VPN container
   - Copy it from the container: `docker cp ctf_vpn_1:/etc/openvpn/client-configs/client1.ovpn ./`

2. Install OpenVPN client:
   - Windows: Download from [OpenVPN website](https://openvpn.net/community-downloads/)
   - Linux: `sudo apt-get install openvpn`
   - macOS: `brew install openvpn`

3. Connect to the VPN:
   - Windows: Right-click the .ovpn file and select "Start OpenVPN on this config file"
   - Linux/macOS: `sudo openvpn --config client1.ovpn`

4. Verify connection:
   - You should be able to ping 172.20.0.1
   - All CTF machines will be accessible in the 172.20.0.0/16 network

## Challenge Overview

1. Web Services
   - Multiple web servers running different versions
   - Some might have interesting configurations
   - Look for unusual file locations

2. Remote Access
   - Multiple SSH instances
   - Different authentication methods
   - Some services might be running on non-standard ports

3. Data Storage
   - Database instances
   - File storage systems
   - Backup locations

## Scoreboard

A scoreboard system is available to track your progress:
- Access the scoreboard at http://localhost:5000
- Submit flags to earn points
- View real-time rankings of all teams
- Track your progress through the challenges

### Point Values
- Basic challenges: 100 points
- Advanced challenges: 200 points

## Getting Started

1. Build the environment:
```
docker-compose up --build
```

2. Access the machines:
- Web Server 1: http://172.20.0.10
- Remote Access: 172.20.0.63 (ports 22, 2222, 23)
- Web Server 2: http://172.20.0.169
- Application Server: 172.20.0.189 (ports 8009, 8080)
- File Server: http://172.20.0.213
- Scoreboard: http://172.20.0.100:5000

## Hints
- Sometimes the most interesting information is in the details
- Don't overlook file metadata
- Check backup locations and system logs
- Look for configuration files in unusual places 