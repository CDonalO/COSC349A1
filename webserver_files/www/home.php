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
        $count = 0;
        while ($obj != "") {
            $s = "SELECT * FROM House_image where(house_id = $obj->house_id)";
            $res = $conn->query($s);
            echo "<ul class='house'>";
            echo "<li><h3>$obj->address</h3></li>";
            echo "<div class='container' id='$count'>";
            $c = 0;
            while ($o = $res->fetch_assoc()) {
                if ($o != "") {
                    echo "<li><div class='slide fade'><img class='$c' src=$o[path] width='360' height='240'></div></li>";
                    $c+=1;
                }
            }
            echo "<a class='prev' onclick='plusSlides(-1,$count)'>&#10094;</a>";
            echo "<a class='next' onclick='plusSlides(1,$count)'>&#10095;</a></div>";
            echo "<li> $obj->bedrooms bedrooms</li>";
            echo "<li>$obj->beds beds</li>";
            echo "<li>$obj->guest_limit guest maximum</li>";
            echo "<li>$obj->bathrooms bathrooms</li>";
            echo "<li>$$obj->price_per_day per day</li>";
            echo "<li>$$obj->cleaning_fee for cleaning</li>";
            echo "<li>$obj->description</li>";
            echo "<li>$obj->city $obj->country</li>";
            echo "</ul>";
            $obj = $result->fetch_object();
            $o = $res->fetch_object();
            $count ++;
        }

        ?>
    </main>
    <script src="slideshow.js"></script>
<?php
include("footer.php");
?>