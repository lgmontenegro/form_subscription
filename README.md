challenge
docker run -d -p 80:80 -v $PWD/conf/php7.0-fpm:/etc/php7.0/fpm/ -v $PWD/conf/nginx/sites-enabled:/etc/nginx/sites-enabled -v $PWD/src:/usr/share/nginx/html/ lemp
docker exec -i database_container mysql -h localhost -u root -ppassword < sql_dump/create_database_table.sql