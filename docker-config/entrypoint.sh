#!/bin/bash

# Load environment variables from .env file into runtime
set -a
source /var/www/html/.env
set +a

# Wait for database to be ready
echo "Waiting for database..."
until nc -z -v -w30 $DB_HOST 3306
do
  echo "Waiting for database connection..."
  sleep 5
done
echo "Database is up!"

# Start Apache
apache2-foreground