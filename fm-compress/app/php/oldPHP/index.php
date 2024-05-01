<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/validations.js"></script>
    <script src="../js/index.js"></script>
    <link rel="stylesheet" href="../css/main/main.css">
    <link rel="stylesheet" href="../css/main/login.css">
    <title>Log in | Register</title>
</head>
<body>
    <header id="loginHeader">
        <div id="logo">
            <img src="../../img/logo/eye_white_inline_circle_blue.png" alt="">
        </div>
        <div id="menu">
            <ul id="menuRLOptions">
                <li><a href="register_from_login.php">Register</a></li>
                <li></li>
                <li><a href="support_from_login.html">Support contact</a></li>
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
                    <img src="../../img/show_password.png" alt="" id="toggleBtn" class="show" onclick="onload">
                </div>
                        
            </div>
            <div class="buttons">
                <input type="submit" value="Log in" name="loginButton" id="loginButton" class="buttonSend">
            </div>
            <div class="links">
                <a href="resetPass_from_login.php">Reset password</a>
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
        require_once 'user.php';

        //TODO: CHANGE PARAMS 
        $dbObject = new DB("localhost", "users", 3307, "root", "root"); //create object for DB
        
        if(isset($_POST['loginButton'])){
            $usernameField = $_POST['userfield'];
            $passwordField = $_POST['passfield'];
            
            //echo "<script>".$_POST['userfield']."</script>";
            //encrytp password with md5
            $encryptedPass = md5($passwordField);

            //check if user is in the DB
            $allUsers = $dbObject->autenticateUser();
            foreach($allUsers as $key){
                $checkUser = new User ($key->username, $key->password, $key->email, $key->emailEmergency, $key->name, $key->lastname, $key->role);
                //echo "<script>".$usernameField."</script>";
                
                //TODO: check id each user
                if($usernameField == $checkUser->getUsername() && $encryptedPass == $checkUser->getPassword()){
                    echo "<script>alert('va bien')</script>";
                    session_start();
                    //TODO: CHECK SESSION INFO
                    $_SESSION['username'] = $usernameField;
                    //header('Location: dashboard.php');
                }else{
                    //TODO: pop up para registro 
                    echo "<script>
                        window.open('https://www.google.com', 'prueba', 'width=120,height=300,scrollbars=NO')
                    </script>";
                }
            }
        }
    ?>
</body>
</html>