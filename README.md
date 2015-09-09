Minimaliste poster quiz
========================


1) Installing
-------------

### Clone the repository

    git clone git@github.com:cthoret/MinimalistePosterQuiz.git

### Install vendor libraries with composer

At the root of the project :

    curl -s http://getcomposer.org/installer | php
    php composer.phar install

### Install less.css

Linux

    sudo apt-get install npm
    sudo npm install -g less@1.7.5

### Install uglify

    sudo npm install -g uglify-js
    sudo npm install -g uglifycss


 2) Server setup
----------------

    apt-get install nginx-extras php5-fpm php5-mysql php5-cli php-apc php5-intl php5-gd mysql-server git unison

```nginx

server {
    listen 80;
    server_name minimaliste-poster.fr;
    root /var/www/minimalistPostr/www/web;

    access_log /var/log/nginx/minimalistPostr-access-nginix.log;
    #error_log /var/log/nginx/minimalistPostr-error-nginix.log;

    client_max_body_size 1024M;

    #    strip app.php/ prefix if it is present
    rewrite ^/app_dev.php/?(.*)$ /$1 permanent;

    #    Do not log access to robots.txt, to keep the logs cleaner
    #location = /robots.txt { access_log off; log_not_found off; }

    #    Do not log access to the favicon, to keep the logs cleaner
    #location = /favicon.ico { access_log off; log_not_found off; }

    location / {
        #index app_dev.php;
        try_files $uri @rewriteapp;
    }
    location @rewriteapp {
        rewrite ^(.*)$ /app_dev.php/$1 last;
    }

    #    pass the PHP scripts to FastCGI server listening on 127.0.0.1:9000
    location ~ ^/(app|app_dev|config)\.php(/|$) {
        fastcgi_pass unix:/var/run/php5-fpm.sock;
        fastcgi_split_path_info ^(.+.php)(/.*)$;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_param HTTPS off; #on;
    }
}

```


3) Setup directories
--------------------

``` bash
mkdir -p app/tmp app/files web/upload/
sudo setfacl -R -m u:www-data:rwX -m u:`whoami`:rwX app/cache app/logs app/tmp app/files web/upload/
sudo setfacl -dR -m u:www-data:rwx -m u:`whoami`:rwx app/cache app/logs app/tmp app/files web/upload/
```
Replace `www-data` with the user running the web server
