#!/bin/bash

# Start SSH service
service ssh start

# Start Apache
service apache2 start

# Keep container running
tail -f /var/log/apache2/access.log /var/log/apache2/error.log
