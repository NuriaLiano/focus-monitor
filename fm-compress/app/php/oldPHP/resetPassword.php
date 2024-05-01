<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main/main.css">
    <title>Reset password</title>
</head>
<body>
    <div id="resetPassword">
        <div id="box">
            <form action="" name="reset-password" method="post">
                <div id="title">
                    <h2>Reset password</h2>
                </div>
                <div id="form">
                    <div class="textbox">
                        <div id="firstStep">
                            <input type="text" class="textfield" name="userfield" id="userfield" placeholder="Enter your username" require>
                            <input type="email" name="emailfield" id="emailfield" placeholder="usuario@unican.es" require>
                            <input type="submit" value="searchDB" name="searchButton" id="searchButton" class="buttonSend">
                        </div>
                        <div id="secondStep" style="visibility: hidden;"> <!-- only change visibility id search is true-->
                            <input type="password" class="textfield" name="passfield" id="passfield" placeholder="Create your password" require>
                            <input type="password" class="textfield" name="repassfield" id="repassfield" placeholder="Confirm your password" require>
                            <input type="submit" value="Change password" name="changePasswordButton" id="changePasswordButton" class="buttonSend">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <footer class="footerGen">
        <div class="legal">
            <a href="#">Privacy</a>
            <a href="#">Terms</a>
            <a href="#">Cookies</a>
        </div>
        <div class="logos">
            <img src="" alt="">
            <img src="" alt="">
            <img src="" alt="">
        </div>
        <div class="develop">
            <p>&copy; Nuria Liaño</p>
        </div>
    </footer>

    <?php
        include_once 'db/db_connection.php';
        $dbObject = new DB("localhost", "users", 3307, "root", "root"); //create object for DB

        if(isset($_POST['searchButton'])){
            $username = $_POST['userfield'];
            $email = $_POST['emailfield'];

            $infoUser = $dbObject->searchUser($username, $email);
            //$infoAdmin = $dbObject->isAdmin($username);
            //$dbObject->removeUser($username,$email,"admin");
            //print_r(count($infoAdmin));
            //print(count($infoUser));
            //check if user is in DB or not
            if (count($infoUser) == 0) {
                echo "No se ha encontrado ningún usuario";
                //header('Location: resetPassword.php'); //refresh the page
            }else{
                echo "se ha encontrado ningún usuario";
                echo "
                <script>
                    document.querySelector('#secondStep').style.visibility = 'visible';
                    document.querySelector('#firstStep').style.visibility = 'hidden';
                </script>";
                if(isset($_POST['changePasswordButton'])){
                    $password = $_POST['passfield'];
                    $repassword = $_POST['repassfield'];
                    if($password == $repassword){
                        $encryptedPass = md5($password);
                        if($dbObject->resetPassword($username, $email, $encryptedPass)){
                            echo "la contraseña se ha actualizado";
                            //header("Location: index.php");
                        }else{
                            echo "No se ha podido cambiar la contraseña";
                        }
                    }else{
                        echo "Las contraseñas no coinciden";
                    }
                }
            }
        }
    
    ?>


</body>
</html>