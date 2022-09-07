# COSC349A1
Assignment 1 for cosc349
By Cordell O'Leary and Jacob Rowe

Application design:
We have three VMs that handle the processing and general usage of our site.
The first is a web page which users of our service would interact with the site and be able to book a house, submit their own house for potential bookings, and create and sign-in to an account. The second VM contains the admin web page and is used by authenticated users to approve user submitted houses and delete/view houses and bookings. The third VM contains the database which stores information on users, bookings, and houses. The two web pages access the database to display the information they need.

How to run:
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
