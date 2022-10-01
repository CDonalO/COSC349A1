<?php
$servername = "cosc349-test-db.cj61kamwxd67.us-east-1.rds.amazonaws.com";
$username = "adminprivilege";
$password = "password1239";
$dbname = "skybnb";
/* connect to the database */
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    print_r("Error");
}

include("header.php");
?>
    <main>
        <?php
        $errMsg = "";//store error messages

        $display = array(
            'bedrooms' => '',
            'beds' => '',
            'bathrooms' => '',
            'guest_limit' => '',
            'price_per_day' => '',
            'cleaning_fee' => '',
            'description' => '',
            'city' => '',
            'country' => '',
            'address' => ''
        );
        // Check if the POST request has been sent
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
            if (isset($_POST["apply"])) {
                $bedrooms = $_POST["bedrooms"];
                $beds = $_POST["beds"];
                $bathrooms = $_POST["bathrooms"];
                $guest_limit = $_POST["guest_limit"];
                $price_per_day = $_POST["price_per_day"];
                $cleaning_fee = $_POST["cleaning_fee"];
                $description = $_POST["description"];
                $city = $_POST["city"];
                $country = $_POST["country"];
                $address = $_POST["address"];
                $sql = "INSERT INTO Houses (bedrooms,beds,guest_limit,bathrooms,price_per_day,cleaning_fee,description,city,country,address,approved) VALUES('$bedrooms','$beds','$guest_limit','$bathrooms','$price_per_day','$cleaning_fee','$description','$city','$country','$address',false)";

                $result = $conn->query($sql);
                $newHouseId = $conn->insert_id;

                $imagePath = "images/";
                $allowTypes = array('jpg', 'png');
                $fileNames = $_FILES['houseImage']['name'];
                if (!empty($fileNames)) {
                    foreach ($_FILES['houseImage']['name'] as $key => $val) {
                        $target_file = $imagePath . basename($_FILES["houseImage"]["name"][$key]);
                        $fileType = pathinfo($target_file, PATHINFO_EXTENSION);
                        if (in_array($fileType, $allowTypes)) {
                            if (!file_exists($target_file)) {
                                if (move_uploaded_file($_FILES["houseImage"]["tmp_name"][$key], $target_file)) {
                                    print_r('./'.$target_file);
                                    $imageInsert = "INSERT INTO House_image (path,house_id) VALUES('$target_file', $newHouseId)";
                                    $imageResult = $conn->query($imageInsert);
                                } else {
                                    $errMsg .= "<p class='err'>Sorry, there was an error uploading your file :(</p>";
                                }
                            } else {
                                $filename = basename($target_file, $fileType);
                                $newFileName = $filename . time() . "." . $fileType;
                                if (move_uploaded_file($_FILES["houseImage"]["tmp_name"][$key], "images/" . $newFileName)) {
                                    $abc = 'images/' . $newFileName;
                                    $imageInsert = "INSERT INTO House_image (path,house_id) VALUES('$abc', $newHouseId)";
                                    $imageResult = $conn->query($imageInsert);
                                } else {
                                    $errMsg .= "<p class='err'>Sorry, there was an error uploading your file.</p>";
                                }
                            }
                        } else {
                            $errMsg .= "<p class='err'>File input incompatible. Must be png or jpg</p>";
                        }
                    }
                }
                if($errMsg == ""){
                    header('Location:' . 'home.php');
                    exit;
                }
                foreach ($_POST as $key => $value) {
                    if (isset($display[$key])) {
                        $display[$key] = htmlspecialchars($value);
                    }
                }
            }
        }
        ?>

        <form id="createForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
              enctype="multipart/form-data">
            <h2>House Application</h2>
            <p>Enter the details of the house an click submit to apply to add you house to our site.</p>
            <p>All fields are required.</p>
            <?php
            if (!empty($errMsg)) {
                ?>
                <div class="note">Error: <?php echo $errMsg; ?></div>
                <?php
            }
            ?>
            <ul id="userInfoList">
                <li><label>Number of Bedrooms: <input class="formInput" type="number" name="bedrooms" min="1"
                                                      value="<?php echo $display['bedrooms']; ?>" required/></label>
                </li>
                <li><label>Number of Beds: <input class="formInput" type="number" name="beds" min="1"
                                                  value="<?php echo $display['beds']; ?>" required/></label></li>
                <li><label>Number of Bathrooms: <input class="formInput" type="number" name="bathrooms" min="1"
                                                       value="<?php echo $display['bathrooms']; ?>" required/></label>
                </li>
                <li><label>Maximum Number of Guests: <input class="formInput" type="number" name="guest_limit" min="1"
                                                            value="<?php echo $display['guest_limit']; ?>"
                                                            required/></label></li>
                <li><label>Cost per Night: <input class="formInput" type="number" name="price_per_day" min="0"
                                                  value="<?php echo $display['price_per_day']; ?>" required/></label>
                </li>
                <li><label>Cleaning Fee: <input class="formInput" type="number" name="cleaning_fee" min="0"
                                                value="<?php echo $display['cleaning_fee']; ?>" required/></label></li>
                <li><label>Description: <input class="descriptionInput" type="text" name="description" maxlength="100"
                                               value="<?php echo $display['description']; ?>" required/></label></li>
                <li><label>City: <input class="formInput" type="text" name="city" maxlength="30"
                                        value="<?php echo $display['city']; ?>" required/></label></li>
                <li><label>Country: <input class="formInput" type="text" name="country" maxlength="30"
                                           value="<?php echo $display['country']; ?>" required/></label></li>
                <li><label>Address: <input class="formInput" type="text" name="address" maxlength="30"
                                           value="<?php echo $display['address']; ?>" required/></label></li>
                <label>Images of House: <input class="formInput" type="file" name="houseImage[]" id="houseImage"
                                               multiple
                                               required></label>

            </ul>
            <p class="buttonSet">
                <input id="houseButton" type="submit" name="apply" value="Apply"/></p>
        </form>
    </main>
<?php
include("footer.php");
?>