apt-get update
apt-get install -y apache2 php libapache2-mod-php php-mysql
cd /home/ubuntu/
git clone https://github.com/CDonalO/COSC349A1.git
cp /COSC349A1/adminwebserver_files/www/* /var/www/html/
rm /var/www/html/index.html
service apache2 restart
