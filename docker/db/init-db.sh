#!/bin/bash
set -e

echo "=== Starting MariaDB with custom initialization ==="

# Start MariaDB in background
echo "Starting MariaDB server..."
docker-entrypoint.sh mariadbd &

# Wait for MariaDB to be ready
echo "Waiting for MariaDB to be ready..."
until mysql -u root -p$MYSQL_ROOT_PASSWORD -e "SELECT 1" >/dev/null 2>&1; do
    echo "Still waiting for MariaDB..."
    sleep 3
done

echo "MariaDB is ready! Starting database initialization..."

# Check if database already has tables
echo "Checking if database needs initialization..."
TABLE_COUNT=$(mysql -u root -p$MYSQL_ROOT_PASSWORD -s -N -e "SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = '$MYSQL_DATABASE'" 2>/dev/null || echo "0")

echo "Current table count: $TABLE_COUNT"

if [ "$TABLE_COUNT" -eq "0" ] || [ "$TABLE_COUNT" = "0" ]; then
    echo "Database is empty. Importing schema and data..."
    
    # Import the SQL file from /tmp
    echo "Executing SQL script: /tmp/db.sql"
    mysql -u root -p$MYSQL_ROOT_PASSWORD "$MYSQL_DATABASE" < /tmp/db.sql
    
    # Verify tables were created
    NEW_TABLE_COUNT=$(mysql -u root -p$MYSQL_ROOT_PASSWORD -s -N -e "SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = '$MYSQL_DATABASE'")
    echo "Database initialization completed successfully!"
    echo "Created $NEW_TABLE_COUNT tables."
else
    echo "Database already contains $TABLE_COUNT tables. Skipping initialization."
fi

echo "=== Database initialization finished. MariaDB is running. ==="

# Keep the container running by waiting for the MariaDB process
wait
