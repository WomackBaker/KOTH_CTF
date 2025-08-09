#!/bin/bash
echo "Content-type: text/html"
echo ""
echo "<html><head><title>Test CGI</title></head><body>"
echo "<h1>Test CGI Script</h1>"
echo "<p>Current time: $(date)</p>"
echo "<p>Environment variables:</p>"
echo "<pre>"
env
echo "</pre>"
echo "</body></html>" 