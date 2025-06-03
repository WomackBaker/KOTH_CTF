FROM ubuntu:20.04

# Prevent interactive prompts during package installation
ENV DEBIAN_FRONTEND=noninteractive

# Install Java and Tomcat
RUN apt-get update && \
    apt-get install -y default-jdk tomcat9 && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# Create necessary directories
RUN mkdir -p /usr/share/tomcat9/conf && \
    mkdir -p /usr/share/tomcat9/temp

# Copy configuration files
COPY server.xml /usr/share/tomcat9/conf/server.xml
COPY tomcat-users.xml /usr/share/tomcat9/conf/tomcat-users.xml

# Copy web application
COPY webapp/ /var/lib/tomcat9/webapps/ROOT/

# Create flag file
RUN echo "FLAG{ghostcat_vulnerability}" > /var/lib/tomcat9/flag.txt && \
    chmod 644 /var/lib/tomcat9/flag.txt

# Expose ports
EXPOSE 8009 8080

# Start Tomcat
CMD ["/usr/share/tomcat9/bin/catalina.sh", "run"] 