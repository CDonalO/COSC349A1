<?php
//if ($_SESSION["admin"] != true){
//    header("Location:index.php");
//    exit();
//}

$servername = "192.168.12.42";
$username = "adminprivilege";
$password = "password1239";
$dbname = "skybnb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    print_r("Error");
}
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST["approve"])) {
        $approve_ids = json_decode($_COOKIE["approve"]);
        foreach ($approve_ids as $app_id) {
            $sql = "UPDATE `Houses` SET `approved` = TRUE where `house_id`= '$app_id'";
            $conn->query($sql);
        }
        unset($_COOKIE['approve']);
    } elseif (isset($_POST["delete"])){
        $delete_ids = json_decode($_COOKIE["delete"]);
        foreach ($delete_ids as $del_id) {
            $sqlb = "DELETE FROM `Booking` where `house_id` = '$del_id'";
            $conn->query($sqlb);
            $sqlh = "DELETE FROM `Houses` where `house_id` = '$del_id'";
            $conn->query($sqlh);
        }
        unset($_COOKIE['delete']);
    }
}
$sql_approved = "SELECT * FROM `Houses` where `approved` = TRUE";
$sql_not_approved = "SELECT * FROM `Houses` where `approved` = FALSE ";
$result_approved = $conn->query($sql_approved);
$result_not_approved = $conn->query($sql_not_approved);
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
        <form action="admin.php" method="post">
    <ul>
        <li id="unapproved_list">Unapproved houses</li>
        <?php
            while($row = $result_not_approved->fetch_assoc()) {
                echo "<ul>";
                echo "<li>" .$row["address"]. ", ". $row["city"]. ", ". $row["country"]. "</li>";
                echo "<li>" . $row["bedrooms"]. " bedrooms". "</li>";
                echo "<li>" . $row["beds"]. " beds". "</li>";
                echo "<li>" . $row["bathrooms"]. " bathrooms". "</li>";
                echo "<li>" . $row["guest_limit"]. " guests max". "</li>";
                echo "<li>" ."$" . $row["price_per_day"]. " per day". "</li>";
                echo "<li>" ."$" . $row["cleaning_fee"]. " cleaning fee". "</li>";
                echo "<li>" . "Approve: "."<input type='checkbox' onclick='addHouseToCookie(".$row["house_id"].',"approve"'.")'>"."</li>";
                echo "</ul>";
            }

            ?>
        <li><input type="submit" value="Approve selected" name="approve"></li>
    </ul>
        <ul>
        <li id="approved_list">Approved houses</li>
        <?php
            while($row = $result_approved->fetch_assoc()) {
                echo "<ul>";
                echo "<li>" .$row["address"]. ", ". $row["city"]. ", ". $row["country"]. "</li>";
                echo "<li>" . $row["bedrooms"]. " bedrooms". "</li>";
                echo "<li>" . $row["beds"]. " beds". "</li>";
                echo "<li>" . $row["bathrooms"]. " bathrooms". "</li>";
                echo "<li>" . $row["guest_limit"]. " guests max". "</li>";
                echo "<li>" ."$" . $row["price_per_day"]. " per day". "</li>";
                echo "<li>" ."$" . $row["cleaning_fee"]. " cleaning fee". "</li>";
                echo "<li>" . $row["description"]. "</li>";
                echo "<li>" . "Delete: "."<input type='checkbox' onclick='addHouseToCookie(".$row["house_id"].',"delete"'.")'>"."</li>";
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
