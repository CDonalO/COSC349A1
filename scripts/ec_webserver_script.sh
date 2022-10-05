apt-get update
apt-get install -y apache2 php libapache2-mod-php php-mysql php7.0-xml
cd /home/ubuntu/

php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === '55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
mv composer.phar /usr/local/bin/composer
composer require aws/aws-sdk-php

mkdir .aws

git clone https://github.com/CDonalO/COSC349A1.git
cp COSC349A1/webserver_files/www/* /var/www/html/
cp COSC349A1/credentials .aws
rm /var/www/html/index.html
rm -r COSC349A1
usermod -a -G ubuntu www-data
service apache2 restart
