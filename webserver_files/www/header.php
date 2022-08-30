<?php
if (session_id() === "") {
    session_start();
}
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <title>SkyBNB</title>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

<header>
    <h1>SkyBNB</h1>

    <div id="user">
        <?php if (isset($_SESSION['authenticatedUser'])) {
        $name = $_SESSION['authenticatedUser'];
        ?>
            <div id="logout">
                <form id="logoutForm" action="logout.php" method="post">
                    <?php echo "<p> Welcome, " . $name . "<span id='logoutUser'></span></p>" ?>
                    <input type="submit" id="logoutSubmit" value="Logout">
                </form>
            </div>
        <?php } else { ?>
            <div id="login">
                <form id="loginForm" action="login.php" method="post">
                    <input type="submit" id="loginSubmit" value="Sign in">
                </form>
                <form id="accountForm" action="createAccount.php" method="post">
                    <input type="submit" id="createAccount" value="Create Account">
                </form>
            </div>
        <?php } ?>
    </div>


</header>