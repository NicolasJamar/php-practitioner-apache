# Lamp-docker

This is a little Lamp stack with Docker. 


## The environment

Have a look at this folder. You have these files and folders :
- docker-compose.yml
- Dockerfile
- .env
- www
- conf

The `docker-compose.yml` and `Dockerfile` are the configurations file in order to run your containers. 

The `www` folder is your work environment folder where you will code your PHP files. There is already a `index.php` in it. 

The `conf` directory contains files to configure your Apache server (`apache.conf`, `vhost.conf`) or PHP (`php.ini`).

For working, you can paste this repo in your computer, rename it as you want and follow the instructions below. 


## Run `docker`🐳

When starting your env for the first time, run the following command in your repo:

	docker-compose build
	
> **NOTE:** thus you don't need to run this command each time, it may be useful to *re*build your services when you change the configuration of your services.

Then, simply run the following command to get started:

    docker-compose up -d

The details for all your services is detailed bellow.

## Your services

### Langage: PHP 8.1 🐘

#### What is PHP?

PHP is a server-side scripting language designed for web development, but which can also be used as a general-purpose programming language. PHP can be added to straight HTML or it can be used with a variety of templating engines and web frameworks. PHP code is usually processed by an interpreter, which is either implemented as a native module on the web-server or as a common gateway interface (CGI).

* **Website:** [php.net](http://php.net)
* **Documentation:** [php.net/docs.php](http://php.net/docs.php)

#### Container

* **Image used:** [library/php:8.1-apache](https://hub.docker.com/_/php/)

##### Usage

Place your PHP files in `./www` folder, access it with your browser at address [localhost](http://localhost).

##### PHP extensions

If you need to install some PHP extensions, you can add & configure them in the `Dockerfile`. 
For infos, I recommend to follow the instructions on the Docker image for PHP : https://hub.docker.com/_/php


* * *

### Database: MariaDB 🦭

#### What is MariaDB?

MariaDB is a community-developed fork of MySQL intended to remain free under the GNU GPL.

* **Website:** [mariadb.org](https://mariadb.org)
* **Documentation:** [mariadb.org/learn](https://mariadb.org/learn/)

#### Container

* **Image used:** [library/mariadb](https://hub.docker.com/_/mariadb/)

##### Usage

> **NOTE:** from dev POV, using MariaDB is strictly the same as using MySQL.

**IMPORTANT:** the first startup of this container is long : the db server needs to be initialized.

**NOTE:** the container don't create a database at startup - create it within your code (or with phpMyAdmin)

###### Access from another container

You can access the database **from another container** with the following informations:

* **host:** `mysql`
* **port:** `3306`
* **user:** `root`
* **pass:** `root`

###### Access from your host

You can access the database  **from you host** with the following informations:

* **host:** `localhost`
* **port:** `3306`
* **user:** `root`
* **pass:** `root`


* * *

### Tool: phpMyAdmin 🗂️

#### What is phpMyAdmin?

A web interface for MySQL and MariaDB.

* **Website:** [phpmyadmin.net](https://www.phpmyadmin.net/)
* **Documentation:** [phpmyadmin.net/docs](https://www.phpmyadmin.net/docs/)

#### Container

* **Image used:** [phpmyadmin/phpmyadmin](https://hub.docker.com/r/phpmyadmin/phpmyadmin/)

##### Usage

The container is already configured to use the MySQL/MariaDB credentials.  
Access **phpMyAdmin** with your browser at address [localhost:8001](http://localhost:8001).

***

### (optional) Tool: composer 🎼

#### What is composer ? 

Composer is a package manager for PHP. It allows you to declare the libraries your project depends on and it will manage (install/update) them for you. It's the *npm* for PHP. 
You can check on packagist.org to download a composer's package. 

* **Website:** [getcomposer.org](https://getcomposer.org/doc/00-intro.md)
* **Packagist:** [packagist.org](https://packagist.org/)

#### Installation

Add these lines in the Dockerfile right after the installation of Apache.

```
# Install composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer --version
```

#### Usage

You can access to composer from the Apache server. 
To access to the Apache server : `docker exec -it container-id sh`

To check if composer is installed : `composer --version`

***

### (optional) Tool: MailHog 📨

#### What is MailHog?

MailHog is an email testing tool which allows you to install & configure an e-mail server locally.

* **Website:** [github.com/mailhog/MailHog](https://github.com/mailhog/MailHog)
* **Explanations:** [mailtrap.io's blog](https://mailtrap.io/blog/mailhog-explained/)
* **More explainations:** [kinsta's blog](https://kinsta.com/blog/mailhog/)

#### Installation

In the `docker-compose.yml` file, add these lines: 
```
mail:
  image: "mailhog/mailhog:latest"
  restart: "always"
  ports:
    - "1025:1025"
    - "8025:8025"
```

In the `Dockerfile`, uncomment these lines : 
```
#RUN curl -LkSso /usr/bin/mhsendmail 'https://github.com/mailhog/mhsendmail/releases/download/v0.2.0/mhsendmail_linux_amd64'&& \
#   chmod 0755 /usr/bin/mhsendmail
```

In the `conf/php.ini` file, you have to uncomment this line : 
```
# sendmail_path = "/usr/bin/mhsendmail --smtp-addr=mail:1025"
```

#### Container

* **Image used:** [mailhog/mailhog](https://hub.docker.com/r/mailhog/mailhog/)

##### Usage

Access **MailHog's web interface** with your browser at address [localhost:8025](http://localhost:8025).

Access **MailHog's SMTP interface** on port `1025`. 