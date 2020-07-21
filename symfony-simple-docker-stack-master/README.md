# symfony 4 lemp docker starter


A simple way to create a Symfony 4 application using Docker.

The stack contain :

 - Nginx

 - PHP-fpm

 - Mysql

 - Adminer

# usage

Take a look at the __apps__ folder :
 - copy paste your current application in there or init a new project with __symfony new APP_NAME__
 - update de __.env__ file and replace the : APP_NAME part with the name of your app...
 - build...
 - __docker-compose up -d__ 
 - check at http://localhost:90, your app should be running :-)
 
You can change the 90 port in the __.env__ file



Psst! It will also work without making a Symfony application.  ;-)


