<?php
include("header.php");
?>

<main>
    <?php
    // unsets the authenticated user session variable
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        unset($_SESSION['authenticatedUser']);
    }
    // if the user accessed this page from another page it will
    // redirect them to it or if not they will be redirected to the index page
    if (isset($_SESSION['lastPage'])) {
        $lastPage = $_SESSION['lastPage'];
        header('Location:' . $lastPage);
        exit;
    } else {
        header('Location:' . 'home.php');
        exit;
    }
    ?>

</main>
