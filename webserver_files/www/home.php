<?php
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
        <?php
        $sql = "SELECT * FROM Houses where(approved='false')";
        $result = $conn->query($sql);
        $obj = $result->fetch_object();
        while($obj != ""){
            echo "<ul class='house'>";
//            echo "<li><img src="$obj->image" width='240' height='180'></li>";
            echo "<li> $obj->bedrooms bedrooms</li>";
            echo "<li>$obj->beds beds</li>";
            echo "<li>$obj->guest_limit guest maximum</li>";
            echo "<li>$obj->bathrooms bathrooms</li>";
            echo "<li>$$obj->price_per_day per day</li>";
            echo "<li>$$obj->cleaning_fee for cleaning</li>";
            echo "<li>$obj->description</li>";
            echo "<li>Located at $obj->address, $obj->city $obj->country</li>";
            echo "</ul>";
            $obj = $result->fetch_object();
        }

        ?>
    </main>
<?php
include("footer.php");
?>