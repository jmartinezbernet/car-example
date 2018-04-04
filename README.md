# Car example app
A sample of a php dockerized application.

## How to run the app
This demo app provides docker files to properly build images to run within docker containers.

Also a docker-compose.yml file has been created to make easy the deployment. 

Feel free to choose the deploy method you prefer.

***

## Deploy using docker-compose
To deploy the app using docker-compose you just need to run this command.

```
docker-compose up -d
```

Then run composer within the php app container
```
docker exec -ti carexample_php_1 bash -c  "cd /var/www/html; php ./composer.phar update"
```

Then you can go to _http://0.0.0.0:8080/public_ to use the client app, and _http://0.0.0.0:8081/status_ to see if api
 server is running.
 
To properly test or use the application with test data you will need to make some migration in the database. Run 
these commands to do that. (first command will prompt a shell within the container, the second one does the migration)

```
ocker exec -ti carexample_php_1 bash -c "/var/www/html/bin/phpmig migrate -b /var/www/html/Car/src/Infrastructure/Ui/Console/PhpMig/phpmig.php"
```

To stop the containers running use this command.

```
docker-compose down -v
```

***

## Deploy using Dokerfiles
### Build images
Run the following commands to build the images.

**PHP**
```
docker build -t php_docker -f docker/php/Dockerfile .
```

**App**
```
docker build -t my_app -f docker/app/Dockerfile .
```

**Nginx with client side app**
```
docker build -t my_frontend_nginx -f docker/frontendNginx/Dockerfile .
```

**Nginx with api**
```
docker build -t my_backend_nginx -f docker/backendNginx/Dockerfile .
```

Note: The Dockerfile for both Nginx is ready to use with docker-compose. You will need to open both Dockerfiles and 
replace these lines:

from 'COPY ./nginx.conf /etc/nginx/conf.d/default.conf' to 'COPY ./docker/frontendNginx/nginx.conf /etc/nginx/conf.d/default.conf'

from 'COPY ./nginx.conf /etc/nginx/conf.d/default.conf' to 'COPY ./docker/backendNginx/nginx.conf /etc/nginx/conf
.d/default.conf'


***

### Run containers
Type the following commands to run the app.

**Run Mysql**
```
docker run --rm --name mysqlserver -v /var/lib/mysql -e MYSQL_DATABASE=demo -e MYSQL_ROOT_PASSWORD=demo mysql
```

This command starts an instance of mysql initialized with a database called demo and set the root password for that 
database to 'demo'.

To open a bash terminal within this container use the following command in a new terminal.
```
docker exec -ti mysqlserver /bin/bash
```

Mysql take a time to be configured, wait a few seconds 

**Initialize database tables and data**
```
docker run --rm --name php --link mysqlserver:mysqlserver  -v `pwd`:/var/www/html -w /var/www/html my_app bin/phpmig migrate -b Status/src/Infrastructure/Ui/Console/PhpMig/phpmig.php
```

The last command uses _my_app_ docker image to run a container where execute the migration command. In this case I used 
PhpMig
 to manage migrations.
 
**Run the php app**
``` 
docker run --rm --name php --link mysqlserver:mysqlserver  -v `pwd`:/var/www/html my_app
```
The above command run our app within a container called _php_. Also this container is linked to mysql container runned 
before.

This container is the one which can execute php code.

**Run client side app**
```
docker run --rm --name client -p 8080:80 --link="php" -v `pwd`/public:/var/www/html my_frontend_nginx
```
With the last command we can start a container with a nginx server ready to serve the client application.

Once this container is running you can go to the url: _http://0.0.0.0:8080/public_ to start using the client.

**Run api**
```
docker run --rm --name api -p 8081:80 --link="php" -v `pwd`:/var/www/html my_backend_nginx
```
This command runs a container with a nginx that executes the api for the app.

You can go to the url _http://0.0.0.0:8081/status_ to test if the api is running.

Note that every one of our nginx works in a different port.

***

## Test the app

You can test the app from different ways.

* From the client
* From a restlet client
* PHPUnit

### Available api urls

### How to execute phpunit tests
