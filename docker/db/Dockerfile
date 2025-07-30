FROM mariadb:11.2

# Copy custom configuration
COPY ./docker/db/mariadb/my.cnf /etc/mysql/conf.d/my.cnf

# Set proper permissions for config file
RUN chmod 644 /etc/mysql/conf.d/my.cnf

# Expose MySQL port
EXPOSE 3306
