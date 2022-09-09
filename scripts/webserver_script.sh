apt-get update
apt-get install -y apache2 php libapache2-mod-php php-mysql
usermod -a -G vagrant www-data

cp /vagrant/user-website.conf /etc/apache2/sites-available/

a2ensite user-website
a2dissite 000-default
service apache2 restart
