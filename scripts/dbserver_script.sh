apt-get update

export MYSQL_PWD='Quack1nce4^'
echo "mysql-server mysql-server/root_password password $MYSQL_PWD" | debconf-set-selections 
echo "mysql-server mysql-server/root_password_again password $MYSQL_PWD" | debconf-set-selections
apt-get -y install mysql-server
service mysql start
echo "CREATE DATABASE skybnb;" | mysql
echo "CREATE USER 'webprivilege'@'%' IDENTIFIED BY 'password1230';" | mysql
echo "CREATE USER 'adminprivilege'@'%' IDENTIFIED BY 'password1239';" | mysql

echo "GRANT ALL PRIVILEGES ON skybnb.* TO 'webprivilege'@'%'" | mysql
echo "GRANT ALL PRIVILEGES ON skybnb.* TO 'adminprivilege'@'%'" | mysql

export MYSQL_PWD='password1239'

cat /vagrant/setup-database.sql | mysql -u adminprivilege skybnb

sed -i'' -e '/bind-address/s/127.0.0.1/0.0.0.0/' /etc/mysql/mysql.conf.d/mysqld.cnf

service mysql restart