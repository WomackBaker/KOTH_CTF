#!/bin/bash

# King of the Hill Service - This service is not started by default
# Users need to discover and start it manually to find the flag

echo "King of the Hill service starting on port 8080..."
echo "I tell you what, this is one fine web service, I tell you what."

# Change to the King of the Hill directory
cd /var/www/kingofthehill

# Start a simple Python HTTP server on port 8080
python3 -m http.server 8080 --bind 0.0.0.0

echo "King of the Hill service stopped. Dang it, Bobby!"
