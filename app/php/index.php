<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/index.js"></script>
    <link rel="stylesheet" href="../css/main/main.css">
    <link rel="stylesheet" href="../css/main/login.css">
    <title>Log in</title>
</head>
<body>
    <header id="loginHeader">
        <div id="logo">
            <img src="../../img/logo/eye_white_inline_circle_blue.png" alt="">
        </div>
        <div id="menu">
            <ul id="menuRLOptions">
                <li><a href="prelogin/register_from_login.php">Register</a></li>
                <li></li>
                <li><a href="prelogin/support_from_login.html">Support contact</a></li>
            </ul>
        </div>
    </header>
    
    <div id="login">
        <form action="" name="login-user" method="post" id="formLogin">
            <div id="pictureU">
                <img src="../../img/login/user_white.png" alt="" id="userPicture">
            </div>
            <div id="title">
                <h2>Login</h2>
            </div>
            <div class="textbox">
                <input type="text" class="textfield" name="userfield" id="userfield" placeholder="Enter your username" require>
                <div class="passbox">
                    <input type="password"  name="passfield" id="passfield" placeholder="Enter your password" require>
                    <img src="../../img/show_password.png" alt="" id="toggleBtn" class="show">
                </div>
                        
            </div>
            <div class="buttons">
                <input type="submit" value="Log in" name="loginButton" id="loginButton" class="buttonSend">
            </div>
            <div class="links">
                <a href="prelogin/resetPass_from_login.php">Reset password</a>
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
                <img src="../../img/footer/miguelherrero_logo.png" alt="ies miguel herrero logo">
                <img src="../../img/footer/uc_logo.png" alt="university of cantabra logo">
                <img src="../../img/footer/nurialiano_logo.png" alt="developer logo">
            </div> 
        </div>
        <div class="develop">
            <p>&copy; Nuria Liaño</p>
        </div>
    </footer>
    <?php
        require_once 'db/db_connection.php';
        require_once 'objects/user.php';
        require_once 'objects/errorLog.php';

        //TODO: CHANGE PARAMS 
        $dbObject = new DB(); //create object for DB
        
        if(isset($_POST['loginButton'])){
            $usernameField = $_POST['userfield'];
            $passwordField = $_POST['passfield'];
            
            //echo "<script>".$_POST['userfield']."</script>";
            //encrytp password with md5
            $encryptedPass = md5($passwordField);
            //check if user is in the DB
            if($dbObject->autenticateUser($usernameField, $encryptedPass)){
                session_start();
                $_SESSION['username'] = $usernameField;
                header('Location:dash_index.php');
            }else{
                print("This user or password are wrong or not exists in DB ");
            }
           
        }
    ?>
</body>

</html>