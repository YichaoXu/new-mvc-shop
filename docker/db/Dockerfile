FROM mariadb:10.11

# Copy custom configuration
COPY docker/db/mariadb/my.cnf /etc/mysql/conf.d/my.cnf

# Set proper permissions for config file
RUN chmod 644 /etc/mysql/conf.d/my.cnf

# Copy SQL file
COPY admin/database/db.sql /tmp/db.sql

# Create a custom entrypoint script that ALWAYS runs
COPY docker/db/init-db.sh /usr/local/bin/init-db.sh
RUN chmod +x /usr/local/bin/init-db.sh

# Override the default entrypoint
ENTRYPOINT ["/usr/local/bin/init-db.sh"]

# Expose MySQL port
EXPOSE 3306
