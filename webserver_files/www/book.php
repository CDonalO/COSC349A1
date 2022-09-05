<?php
if (session_id() === "") {
    session_start();
}
//set up variables to be used when connecting to the database
$servername = "192.168.12.42";
$username = "adminprivilege";
$password = "password1239";
$dbname = "skybnb";
/* connect to the database */
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    print_r("Error");
}
/* gets the house selected from the home page. */
$id = $_SESSION["houseId"];
$sql = "SELECT * FROM `Houses` where `house_id` = '$id'";
$result = $conn->query($sql);

include("header.php");

?>
<main>
    <?php
    /* displays the house details in the same way as the home page. */
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
    /* an array for storing input variables, so they persist after an input error */
    $display = array(
        'checkIn' => '',
        'checkOut' => '',
        'numPeople' => '',
    );
    /* method takes user information about a booking and checks if its valid(mostly)
     * and pushes it to the database.*/
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["book"])) {
            /* checks if the user is logged in, otherwise they can't book and will be
             * redirected to the createAccount page */
            if(!isset($_SESSION['authenticatedUser'])){
                header('Location:' . 'createAccount.php');
                exit;
            }
            $user_id = $_SESSION['authenticatedUserId'];
            $d1 = new DateTime($_POST["checkIn"]);
            $d2 = new DateTime($_POST["checkOut"]);
            $today = new DateTime();
            if($d2 <= $d1){
                $errMsg .= "<p class='err'>checkout date must be after the check in date.</p>";
            } else if($d1 < $today){
                print_r("check in date must be tomorrow or farther in the future.");
            }
            $num_days = $d2->diff($d1)->format("%a");
            $num_people = $_POST['numPeople'];
            $arriveDate = $d1->format('Y,m,d');
            if($errMsg == ""){
                $bookSql = "INSERT INTO Booking (house_id,number_of_people,check_in_date,days,users_id) VALUES('$obj->house_id','$num_people','$arriveDate','$num_days','$user_id')";
                $bookResult = $conn->query($bookSql);
                $d = "SELECT * FROM Booking";
                $dres = $conn->query($d);
                $abc = $dres->fetch_object();
                $ab = $dres->fetch_object();
                header('Location:' . 'home.php');
                exit;
            }
            /* displays all the input values if incorrect data is entered for quicker fixes to invalid data */
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

