FROM python:3.9-slim

# Install dependencies
RUN pip install flask flask-sqlalchemy

# Create app directory
WORKDIR /app

# Copy application files
COPY app.py /app/
COPY templates/ /app/templates/
COPY static/ /app/static/

# Create database directory
RUN mkdir -p /app/instance

# Expose port
EXPOSE 5000

# Start the application
CMD ["python", "app.py"] 