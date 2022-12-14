<?php
require("dbconnection.php");

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
        /* takes user input and partially validates it and creates and pushes a new user to the database */
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["create"])) {
                $fname = $_POST["fName"];
                $lname = $_POST["lName"];
                $email = $_POST["Email"];
                $s = "SELECT * FROM Users where(email = '$email')";
                $res = $conn->query($s);
                $o = $res->fetch_object();
                if ($_POST["Password1"] != $_POST["Password2"]) {
                    $errMsg .= "<p class='err'>Please ensure both passwords match.</p>";
                } else if($res->num_rows != 0){
                    $errMsg .= "<p class='err'>Email address already in use.</p>";
                } else {
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
            <p>You must be signed into an account if you wish to book a house.</p>
            <p>All fields are required.</p>
            <?php
            if (!empty($errMsg)) {
                ?>
                <div class="note">Error: <?php echo $errMsg; ?></div>
                <?php
            }
            ?>
            <ul id="userInfoList">
                <li><label>First Name: <input class="formInput" type="text" name="fName" maxlength="30"
                                              value="<?php echo $display['fName']; ?>" required/></label></li>
                <li><label>Last Name: <input class="formInput" type="text" name="lName" maxlength="30"
                                             value="<?php echo $display['lName']; ?>" required/></label></li>
                <li><label>Email Address: <input class="formInput" type="email" name="Email" maxlength="40"
                                                 value="<?php echo $display['Email']; ?>" required/></label></li>
                <li><label>Password: <input class="formInput" type="password" name="Password1" maxlength="40"
                                            value="<?php echo $display['Password1']; ?>" required/></label></li>
                <li><label>Confirm Password: <input class="formInput" type="password" name="Password2" maxlength="40"
                                                    value="<?php echo $display['Password2']; ?>" required/></label>
                </li>
            </ul>
            <p class="buttonSet">
                <input id="createButton" type="submit" name="create" value="Create Account"/></p>
            <p>If you already have an account you can <a href="login.php">sign in instead.</a></p>
        </form>

    </main>
<?php
include("footer.php");
?>