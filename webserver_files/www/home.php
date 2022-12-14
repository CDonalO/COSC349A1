<?php
if (session_id() === "") {
    session_start();
}
/* set up variables to be used when connecting to the database */
require("dbconnection.php");

include("header.php");
/* sets a session variable containing the id of the
 * selected house to book and navigates to the booking page
 */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    print_r("aa");
    if (isset($_POST["book"])) {
        $_SESSION["houseId"] = $_POST["book"];
        header('Location:' . 'book.php');
        exit;
    }
}
?>
    <main>
        <form action="home.php" method="post">
            <?php
            /* gets all approved houses */
            $sql = "SELECT * FROM Houses where(approved=true)";
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

                /* displays the images associated with each house */
                while ($o = $res->fetch_assoc()) {
                    if ($o != "") {
                        echo "<li><div class='slide fade'><img class='$c' src=$o[path] width='360' height='240'></div></li>";
                        $c += 1;
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
                echo "<li>$obj->city, $obj->country</li>";
                echo "<li><button type='submit' value='$obj->house_id' name='book'>Book Me</button></li>";
                echo "</ul>";
                $obj = $result->fetch_object();
                $o = $res->fetch_object();
                $count++;
            }

            ?>
        </form>
    </main>
    <script src="slideshow.js"></script>
<?php
include("footer.php");
?>