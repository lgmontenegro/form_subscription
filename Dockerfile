FROM ubuntu:latest
ENV DEBIAN_FRONTEND noninteractive
RUN apt-get update
RUN apt-get install -y nginx && apt-get install -y php7.0-fpm && apt-get install -y php7.0-curl php7.0-gd php7.0-intl php7.0-json php7.0-mcrypt php7.0-mysqlnd php7.0-readline
RUN echo "mysql-server mysql-server/root_password password toor" | debconf-set-selections && \
  echo "mysql-server mysql-server/root_password_again password toor" | debconf-set-selections 
RUN apt-get install -y mysql-server
RUN apt-get install -y supervisor
RUN chown -R www-data. /usr/share/nginx/html/ && \
  chmod -R 755 /usr/share/nginx/html/
ADD supervisor/php7.0-fpm.conf /etc/supervisor/conf.d/php7.0-fpm.conf
ADD supervisor/nginx.conf /etc/supervisor/conf.d/nginx.conf
ADD supervisor/mysql.conf /etc/supervisor/conf.d/mysql.conf
WORKDIR /usr/share/nginx/html/
VOLUME /etc/nginx/sites-enabled/
VOLUME /etc/php/7.0/fpm/
VOLUME /usr/share/nginx/html/
RUN mkdir /run/php
RUN mkdir /run/mysqld
EXPOSE 80
CMD ["/usr/bin/supervisord", "--nodaemon", "-c", "/etc/supervisor/supervisord.conf"]