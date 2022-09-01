<?php
$currentPage = basename($_SERVER['PHP_SELF']);
$servername = "192.168.12.42";
$username = "adminprivilege";
$password = "password1239";
$dbname = "skybnb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    print_r("Error");
}

include("header.php");
?>
    <main>

    </main>
<?php
include("footer.php");
?>