<?php
session_start();
require("dbconnection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST['email'];
    $passwd = $_POST['password'];
    $sql = "SELECT * FROM `Users` where `is_admin` = TRUE and email = '$email' and pass_word = '$passwd'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $_SESSION["admin"] = true;
        header("Location:admin.php");
        exit();
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Skybnb - Admin</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<main>
    <form action="index.php" method="post">
        <label>Skybnb Admin Login</label>
        <label for="email">Email: <input type="email" name="email" id="email"></label>
        <label for="password">Password: <input type="password" name="password" id="password"></label>
        <label><input type="submit" value="Submit"></label>
    </form>
</main>
</body>
</html>
