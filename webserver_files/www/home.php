<?php
$servername = "192.168.12.42";
$username = "adminprivilege";
$password = "password1239";
$dbname = "skybnb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    print_r("Error");
}

$sql = "SELECT * FROM Houses";
$result = $conn->query($sql);
print_r($result);

include("header.php");
?>

<main>

<p>Hello</p>

</main>
<?php
include("footer.php");
?>