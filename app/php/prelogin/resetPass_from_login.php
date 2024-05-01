<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../../js/index.js"></script>
    <link rel="stylesheet" href="../../css/main/main.css">
    <link rel="stylesheet" href="../../css/main/resetPass_from_login.css">
    <title>Reset password</title>
</head>

<body>
    <header id="loginHeader">
        <div id="logo">
            <img src="../../../img/logo/eye_white_inline_circle_blue.png" alt="">
        </div>
        <div id="menu">
            <ul id="menuRLOptions">
                <li><a href="../index.php">Login</a></li>
                <li></li>
                <li><a href="support_from_login.html">Support contact</a></li>
            </ul>
        </div>
    </header>

    <div id="register">
        <div id="title">
                <h2>I forgot my password</h2>
            </div>
        <form action="" name="login-user" method="post" id="formRegister">
            <div class="textbox">
                <p>Username</p>
                <input type="text" name="userField" id="userField" placeholder="Username" require>
                <div class="passwordFields">
                    <p>New password</p>
                    <input type="password" class="textfield" name="passfield" id="passfield" placeholder="Create your password" require>
                    <p>Confirm password</p>
                    <input type="password" class="textfield" name="repassfield" id="repassfield" placeholder="Confirm your password" require>
                </div>
                <input type="submit" value="Confirm new password" name="changePassButton" id="changePassButton" class="buttonSend">
            </div>
            </div>
        </form>
    </div>
    <footer class="footerGen">
        <div id="subFooter">
            <div class="legal">
                <a href="#">Privacy</a>
                <a href="#">Terms</a>
                <a href="#">Cookies</a>
            </div>
            <div class="logos">
                <img src="../../../img/footer/miguelherrero_logo.png" alt="ies miguel herrero logo">
                <img src="../../../img/footer/uc_logo.png" alt="university of cantabra logo">
                <img src="../../../img/footer/nurialiano_logo.png" alt="developer logo">
            </div>
        </div>
        <div class="develop">
            <p>&copy; Nuria Liaño</p>
        </div>
    </footer>
    <?php
    include_once '../db/db_connection.php';
    include_once '../validations/validator.php';
    $dbObject = new DB(); //create object for DB
    if(isset($_POST['changePassButton'])){
        $username = $_POST['userField'];
        $password = $_POST['passfield'];
        $repassword = $_POST['repassfield'];
        if($dbObject->checkIFUserExists($username)){
            if($password == $repassword){
                print("las password coinciden");
                if (checkPassword($password)) {
                    $encryptedPass = md5($password);
                    if($dbObject->resetPassword($username, $encryptedPass)){
                        echo "The password has been changed";
                        header("Location: ../index.php");
                    }else{
                        echo "The password has not been changed";
                    }
                }
            }else{
                   echo "Passwords are not the same";
            }
        }else{
            echo "The user doesn't exist";
        }
    }

?>
</body>

</html>