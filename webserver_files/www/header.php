<?php
if (session_id() === "") {
    session_start();
}
/* sets the last page variable for any page that's not the logout page as it shouldn't be redirected to*/
$temp = basename($_SERVER['PHP_SELF']);
if ($temp != 'logout.php') {
    $_SESSION['lastPage'] = $_SERVER['PHP_SELF'];
}
/* if the user is logged in and tries to access the createAccount of login page they will be redirected. */
if(isset($_SESSION['authenticatedUser'])){
    if($temp == 'login.php' || $temp == 'createAccount.php' ){
        header('Location:' . 'home.php');
        exit;
    }
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
        <?php
        /* displays the logout form if the user is logged in */
        if (isset($_SESSION['authenticatedUser'])) {
            $name = $_SESSION['authenticatedUser'];
        ?>
            <div id="logout">
                <form id="logoutForm" action="logout.php" method="post">
                    <?php echo "<p> Welcome, " . $name . "<span id='logoutUser'></span></p>" ?>
                    <input type="submit" id="logoutSubmit" value="Logout">
                </form>
            </div>
        <?php } ?>
    </div>

    <nav>

        <ul>
            <?php
            /* navigation links to other pages */
            if(!isset($currentPage)){
                $currentPage = '';
            }
            if ($currentPage === 'home.php') {
                echo "<li>Home</li>";
            } else{
                echo "<li> <a href='home.php'>Home</a>";
            }
            if ($currentPage === 'createHouse.php') {
                echo "<li>Submit a House</li>";
            } else{
                echo "<li> <a href='createHouse.php'>Submit a House</a>";
            }
            /* if the user is not logged in, the login and createAccount nav links are displayed */
            if (!isset($_SESSION['authenticatedUser'])) {
                if ($currentPage === 'createAccount.php') {
                    echo "<li>Create Account</li>";
                } else{
                    echo "<li> <a href='createAccount.php'>Create Account</a>";
                }
                if ($currentPage === 'login.php') {
                    echo "<li>Login</li>";
                } else{
                    echo "<li> <a href='login.php'>Login</a>";
                }
            }
            ?>

        </ul>
    </nav>

</header>