<?php
session_start();

$servername = "192.168.12.42";
$username = "adminprivilege";
$password = "password1239";
$dbname = "skybnb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    print_r("Error");
}
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST["delete"])){
        $delete_ids = json_decode($_COOKIE["bdelete"]);
        foreach ($delete_ids as $del_id) {
            $sqlb = "DELETE FROM `Booking` where `booking_id` = '$del_id'";
            $conn->query($sqlb);
        }
        unset($_COOKIE['bdelete']);
    }
}
$id = $_SESSION["selectedId"];
$sql_house = "SELECT * FROM `Houses` where `house_id` = '$id'";
$sql_bookings = "SELECT * FROM `Booking` where `booking.house_id` = '$id' INNER JOIN `Users` ON `Booking.users_id` = `Users.users.id`";
$result_house = $conn->query($sql_house);
$result_bookings = $conn->query($sql_bookings);
print_r($result_bookings)
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Skybnb - Admin panel</title>
    <link type="text/css" rel="stylesheet" href="styleMain.css">
    <script src="script.js"></script>
</head>
<body>
<?php include"header.php" ?>
<main>
    <h1>Skybnb admin panel</h1>
    <form action="bookings.php" method="post">
        <ul>
            <li>Bookings</li>
            <?php
            while($row = $result_house->fetch_assoc()) {
                echo "<ul>";
                echo "<li>" .$row["address"]. ", ". $row["city"]. ", ". $row["country"]. "</li>";
                while($booking = $result_bookings->fetch_assoc()){
                    echo "<ul>";
                    echo "<li>" . $booking["check_in_date"]. "</li>";
                    echo "<li>" . "Delete: "."<input type='checkbox' onclick='addHouseToCookie(".$row["house_id"].',"bdelete"'.")'>"."</li>";
                    echo "</ul>";
                }
                echo "</ul>";
            }

            ?>
            <li><input type="submit" value="Delete selected" name="delete"></li>
        </ul>
    </form>
</main>
<?php include"footer.php" ?>
</body>
</html>
