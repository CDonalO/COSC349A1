<?php
$currentPage = basename($_SERVER['PHP_SELF']);
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

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['loginUser'];
    $password = $_POST['loginPassword'];

    $sql = "SELECT * FROM Users where (email = '$username' AND pass_word = '$password')";
//    $sql = "SELECT * FROM Users";
    $result = $conn->query($sql);
    if($result->num_rows != 1){
//        print_r("aaaaa");
    }else{
        $a = $result->fetch_object();
        $_SESSION['authenticatedUserId'] = $a->users_id;
        $_SESSION['authenticatedUser'] = $a->fname;
        header('Location:' . 'home.php');
        exit;
    }
}


?>


    <main>

        <div id="login">
            <form id="loginForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                  enctype="multipart/form-data">
                <label for="loginUser">Email: </label>
                <input type="text" name="loginUser" id="loginUser"><br>
                <label for="loginPassword">Password: </label>
                <input type="password" name="loginPassword" id="loginPassword"><br>
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