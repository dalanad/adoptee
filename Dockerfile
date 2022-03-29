FROM php:7-apache
RUN docker-php-ext-install mysqli pdo pdo_mysql

COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
 
RUN a2enmod rewrite
RUN a2enmod headers

RUN apt-get update && apt-get install -y cron curl 

RUN echo "0 4 * * * root curl --silent http://localhost/main/run_task?task_name=expire_consultations &>/dev/null" >> /etc/crontab

# Copy application source
COPY ./ /var/www/
RUN chown -R www-data:www-data /var/www
RUN sed -i "s/Listen 80/Listen ${PORT:-80}/g" /etc/apache2/ports.conf
RUN sed -i "s/:80/:${PORT:-80}/g" /etc/apache2/sites-enabled/*


CMD bash -c "cron && apache2-foreground"
