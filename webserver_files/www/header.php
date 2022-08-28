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
            <div id="login">
                <form id="loginForm" action="login.php" method="post">
<!--                    <label for="loginEmail">Email: </label>-->
<!--                    <input type="text" name="loginEmail" id="loginEmail"><br>-->
<!--                    <label for="loginPassword">Password: </label>-->
<!--                    <input type="password" name="loginPassword" id="loginPassword"><br>-->
                    <input type="submit" id="loginSubmit" value="Sign in">
                </form>
                <form id="accountForm" action="createAccount.php" method="post">
                    <input type="submit" id="createAccount" value="Create Account">
                </form>
            </div>
    </div>

</header>