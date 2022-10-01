apt-get update
apt-get install -y apache2 php libapache2-mod-php php-mysql
cd /home/ubuntu/
git clone https://github.com/CDonalO/COSC349A1.git
cp COSC349A1/webserver_files/www/* /var/www/html/
rm /var/www/html/index.html
rm -r COSC349A1
usermod -a -G ubuntu www-data
service apache2 restart
