# COSC349A2
Assignment 1 and 2 for cosc349
By Cordell O'Leary and Jacob Rowe

Vagrant Version Application design:
We have three VMs that handle the processing and general usage of our site.
The first is a web page which users of our service would interact with the site and be able to book a house, submit their own house for potential bookings, and create and sign-in to an account. The second VM contains the admin web page and is used by authenticated users to approve user submitted houses and delete/view houses and bookings. The third VM contains the database which stores information on users, bookings, and houses. The two web pages access the database to display the information they need.

How to run old vagrant version:
- Install vagrant and virtual box onto computer.
- links: 
- https://www.vagrantup.com/downloads 
- https://www.virtualbox.org/wiki/Downloads
- git clone the repository
- open a terminal and navigate to the folder COSC349A1 which contains the repository
- run "vagrant destroy" to make sure no other vms are running
- run "vagrant up" to build and run the application
- go to http://127.0.0.1:8080/home.php to access the user site
- go to http://127.0.0.1:8081/index.php to access the admin site
- admin login: Email="admin@cooladmin.com" Password="admin"

Cloud based version Application design:
We have two EC2 instances that host our webservers as well as an RDS database and and SES email service. The two EC2 instances both interact with database, but only the instance with the user site interacts with the SES service. The EC2 instances don't interact with eachother to maintain the separation between users and admins. The sites and database still have the same functions as with the vagrant versions apart from an SES email notification being sent to the user's email address on a successful booking. 


How to run on the cloud:
- You will need an AWS account to set up the environment for this application.
- Create an identity with the aws SES service just using your email and verify it.
- Create security group to use
- Create two EC2 instances on the AWS cloud running ubuntu
- Add inbound rules that allow for http, ssh, mysql/aurora into security group
- Create RDS MySQL database and use MySQL Workbench or equivilant to cofigure it using sql from setup-database-ec2 text file.
- ssh into EC2 instances and run script in the associated web server script file to setup webservers (make sure it is run in sudo and the script is given permissions with sudo chmod +x scriptname)
- for the non admin ec2 instance you will need to set Access Key ID and Secret Access Key in the file /.aws/credentials you can find these in your aws account information. You will also need to change the sender email in /var/www/html/book.php to the email you setup earlier and may need to change the region
- change to /var/www/html/ directory
- update database connection information on dbconnection php pages with the relevant endpoint
