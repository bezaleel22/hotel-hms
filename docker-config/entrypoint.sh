#!/bin/bash
set -a
export $(grep -v '^#' /var/www/html/.env | xargs)
set +a

# Wait for database to be ready
echo "Waiting for database..."
until nc -z -v -w30 "$DB_HOST" 3306; do
  echo "Waiting for database connection..."
  sleep 5
done
echo "Database is up!"

# Start Apache
exec apache2-foreground
