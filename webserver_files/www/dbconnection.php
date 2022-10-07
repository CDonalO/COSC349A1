<?php
//set up variables to be used when connecting to the database
$servername = "cosc349-test-db.cj61kamwxd67.us-east-1.rds.amazonaws.com";
$username = "adminprivilege";
$password = "password1239";
$dbname = "skybnb";
/* connect to the database */
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    print_r("Error");
}
