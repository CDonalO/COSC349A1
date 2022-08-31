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
        $errMsg = "";//store error messages

        $display = array(
            'fName' => '',
            'lName' => '',
            'Email' => '',
            'Password1' => '',
            'Password2' => ''
        );
        // Check if the POST request has been sent
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["create"])) {
                if ($_POST["Password1"] != $_POST["Password2"]) {
                    $errMsg .= "<p class='err'>Please ensure both passwords match.</p>";
                } else {
                    $fname = $_POST["fName"];
                    $lname = $_POST["lName"];
                    $email = $_POST["Email"];
                    $password = $_POST["Password1"];
                    $sql = "INSERT INTO Users (fname,lname,email,pass_word,is_admin) VALUES('$fname','$lname','$email','$password',false)";
                    $result = $conn->query($sql);
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
            <h2>Create an account.</h2>
            <p>You be signed into an account if you wish to book a house.</p>
            <p>All fields are required.</p>
            <?php
            if (!empty($errMsg)) {
                ?>
                <div class="note">Error: <?php echo $errMsg; ?></div>
                <?php
            }
            ?>
            <ul id="userInfoList">
                <li><label>First Name: <input type="text" name="fName" maxlength="30"
                                              value="<?php echo $display['fName']; ?>" required/></label></li>
                <li><label>Last Name: <input type="text" name="lName" maxlength="30"
                                             value="<?php echo $display['lName']; ?>" required/></label></li>
                <li><label>Email Address: <input type="email" name="Email" maxlength="40"
                                                 value="<?php echo $display['Email']; ?>" required/></label></li>
                <li><label>Password: <input type="password" name="Password1" maxlength="40"
                                            value="<?php echo $display['Password1']; ?>" required/></label></li>
                <li><label>Confirm Password: <input type="password" name="Password2" maxlength="40"
                                                    value="<?php echo $display['Password2']; ?>" required/></label>
                </li>
            </ul>
            <p class="buttonSet">
                <input id="createButton" type="submit" name="create" value="Create Account"/></p>
        </form>

    </main>
<?php
include("footer.php");
?>