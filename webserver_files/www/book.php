<?php
if (session_id() === "") {
    session_start();
}
$servername = "192.168.12.42";
$username = "adminprivilege";
$password = "password1239";
$dbname = "skybnb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    print_r("Error");
}

$id = $_SESSION["houseId"];
$sql = "SELECT * FROM `Houses` where `house_id` = '$id'";
$result = $conn->query($sql);

include("header.php");

?>
<main>
    <?php
    $obj = $result->fetch_object();
    $s = "SELECT * FROM House_image where(house_id = $obj->house_id)";
    $res = $conn->query($s);
    echo "<ul class='house'>";
    echo "<li><h3>$obj->address</h3></li>";
    echo "<div class='container' id='0'>";
    $c = 0;
    while ($o = $res->fetch_assoc()) {
        if ($o != "") {
            echo "<li><div class='slide fade'><img class='$c' src=$o[path] width='360' height='240'></div></li>";
            $c += 1;
        }
    }
    echo "<a class='prev' onclick='plusSlides(-1,0)'>&#10094;</a>";
    echo "<a class='next' onclick='plusSlides(1,0)'>&#10095;</a></div>";
    echo "<li> $obj->bedrooms bedrooms</li>";
    echo "<li>$obj->beds beds</li>";
    echo "<li>$obj->guest_limit guest maximum</li>";
    echo "<li>$obj->bathrooms bathrooms</li>";
    echo "<li>$$obj->price_per_day per day</li>";
    echo "<li>$$obj->cleaning_fee for cleaning</li>";
    echo "<li>$obj->description</li>";
    echo "<li>$obj->city, $obj->country</li>";
    echo "</ul>";


    $errMsg = "";//store error messages

    $display = array(
        'checkIn' => '',
        'checkOut' => '',
        'numPeople' => '',
    );

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["book"])) {
            if(!isset($_SESSION['authenticatedUser'])){
                header('Location:' . 'createAccount.php');
                exit;
            }
            $d1 = new DateTime($_POST["checkIn"]);
            $d2 = new DateTime($_POST["checkOut"]);
            $today = new DateTime();
            if($d2 <= $d1){
                $errMsg .= "<p class='err'>checkout date must be after the check in date.</p>";
            } else if($d1 < $today){
                print_r("check in date must be tomorrow or farther in the future.");
            }

            foreach ($_POST as $key => $value) {
                if (isset($display[$key])) {
                    $display[$key] = htmlspecialchars($value);
                }
            }
        }
    }
    ?>

    <form id="bookForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
          enctype="multipart/form-data">
        <h2>Place a booking for <?php echo $obj->address ?>.</h2>
        <p>Make sure you have an account and are signed in before booking.</p>
        <p>All fields are required.</p>
        <?php
        if (!empty($errMsg)) {
            ?>
            <div class="note">Error: <?php echo $errMsg; ?></div>
            <?php
        }
        ?>
        <ul id="userInfoList">
            <li><label>Arrive On: <input type="Date" name="checkIn"
                                         value="<?php echo $display['checkIn']; ?>" required/></label></li>
            <li><label>Leave On: <input type="date" name="checkOut"
                                        value="<?php echo $display['checkOut']; ?>" required/></label></li>
            <li><label>Number of People: <input type="number" name="numPeople" min="1"
                                                max="<?php echo $obj->guest_limit ?>"
                                                value="<?php echo $display['numPeople']; ?>" required/></label></li>
            </li>
        </ul>
        <p class="buttonSet">
            <input id="bookButton" type="submit" name="book" value="Book House"/></p>
    </form>

</main>
<script src="slideshow.js"></script>

<?php
include("footer.php");
?>

