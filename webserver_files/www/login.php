<?php
//set up variables to be used when connecting to the database
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

<?php
$errMsg = "";//store error messages

$display = array(
    'loginUser' => '',
    'loginPassword' => '',

);
/* compares user input login data with existing users in the database to authenticate the user */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['loginUser'];
    $password = $_POST['loginPassword'];

    $sql = "SELECT * FROM Users where (email = '$username' AND pass_word = '$password')";
    $result = $conn->query($sql);
    if ($result->num_rows != 1) {
        $errMsg .= "<p class='err'>Account does not exist.</p>";
    } else {
        $a = $result->fetch_object();
        $_SESSION['authenticatedUserId'] = $a->users_id;
        $_SESSION['authenticatedUser'] = $a->fname;
        header('Location:' . 'home.php');
        exit;
    }
    foreach ($_POST as $key => $value) {
        if (isset($display[$key])) {
            $display[$key] = htmlspecialchars($value);
        }
    }
}

?>
    <main>

        <div id="login">
            <form id="loginForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                  enctype="multipart/form-data">
                <?php
                if (!empty($errMsg)) {
                    ?>
                    <div class="note">Error: <?php echo $errMsg; ?></div>
                    <?php
                }
                ?>
                <label for="loginUser">Email: </label>
                <input type="text" name="loginUser" id="loginUser" value="<?php echo $display['loginUser']; ?>"
                       required><br>
                <label for="loginPassword">Password: </label>
                <input type="password" name="loginPassword" id="loginPassword"
                       value="<?php echo $display['loginPassword']; ?>" required><br>
                <input type="submit" id="loginSubmit" value="Login">
            </form>
        </div>

        <form id="accountForm" action="createAccount.php" method="post">
            <input type="submit" id="createAccount1" value="Create Account">
        </form>

    </main>

<?php
include("footer.php");
?>