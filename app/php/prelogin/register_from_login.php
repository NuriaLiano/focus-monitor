<?php
require_once '../db/db_connection.php';
require_once '../objects/user.php';
require_once '../validations/validator.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/main/main.css">
    <link rel="stylesheet" href="../../css/main/register_from_login.css">
    <script src="../../js/prelogin_fun.js"></script>
    <script src="../../js/validators/prelogin_reg.js"></script>
    <title>Register</title>
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
            <h2>Register new user</h2>
        </div>
        <form action="" name="login-user" method="POST" id="formRegister" autocomplete="off" enctype="multipart/form-data">
            <div class="textbox">
                <p>Name</p>
                <input type="text" class="textfield required" name="namefield" id="namefield" placeholder="Enter your name" require autocomplete="off" maxlength="25">
                <p>Lastname</p>
                <input type="text" class="textfield required" name="lastnamefield" id="lastnamefield" placeholder="Enter your lastname" require autocomplete="off" maxlength="50">
                <p>Username</p>
                <input type="text" class="textfield required" name="userfield" id="userfield" placeholder="Create your username" require autocomplete="off" maxlength="25">
                <p>Password</p>
                <input type="password" class="textfield required" name="passfield" id="passfield" id="prelog" placeholder="Create your password" require autocomplete="off" maxlength="16">
                <p>Confirm password</p>
                <input type="password" class="textfield required" name="repassfield" id="repassfield" placeholder="Confirm your password" require autocomplete="off" maxlength="16">
                <p>Email </p>
                <input type="email" name="emailfield" id="emailfield" placeholder="usuario@domain" require autocomplete="off" maxlength="250">
                <p>Office number</p>
                <input type="number" name="officeNumberfield" id="officeNumberfield" placeholder="Office number" autocomplete="off">
                <p>Telephone number</p>
                <input type="tel" name="phoneNumberfield" id="phoneNumber" placeholder="Phone number" autocomplete="off">
                <p>Profile Picture</p>
                <input type="file" name="profilePicturefield" id="profilePicture">
                <p>Select your faculty</p>
                <select name="facultyfield" id="faculty">
                    <option value="economicas">Económicas y Empresariales</option>
                    <option value="derecho">Derecho</option>
                    <option value="educacion">Educación</option>
                    <option value="filosofia">Filosofía y Letras</option>
                    <option value="medicina">Medicina</option>
                    <option value="enfermeria">Enfermería</option>
                    <option value="ciencias">Ciencias</option>
                    <option value="caminos">ETS Ingenieros de Caminos, Canales y Puertos</option>
                    <option value="teleco">ETS Ingenieros Industriales y de Telecomunicación</option>
                    <option value="minas">Escuela Politécnica de Ingeniería de Minas y Energía</option>
                    <option value="nautica">Escuela Técnica Superior de Náutica</option>
                    <option value="turismo">Escuela Universitaria de Turismo Altamira</option>
                    <option value="fisio">Escuela Universitaria de Fisioterapia</option>
                    <option value="ciese">Centro Universitario CIESE-Comillas</option>
                    <option value="ifca">Instituto de Física de Cantabria</option>
                </select>
                <p>Select your user role</p>
                <select name="userRole" id="userRole" class="required" require>
                    <option value="">Choose your group</option>
                    <option value="1">Administrator</option>
                    <option value="2">SMG group</option>
                    <option value="3">Economia group</option>
                    <option value="4">Geocean group</option>
                    <option value="5">Citimac group</option>
                    <option value="6">GTFE group</option>
                </select>
                <input type="submit" value="Create user" name="registerButton" id="registerButton" class="buttonSend">
                <input type="button" value="Username generator" onclick="usernameGenerator()">
                <input type="button" value="Password generator" onclick="passwordGenerator()">
                <img src="../../..//img/show_password.png" alt="" id="toggleBtn" class="show">
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
    $dbObject = new DB();
    if (isset($_POST['registerButton'])) {
        //connect to db
        $dbObject->connectionDB();
        //username, password, email, emailEmergency, name, lastname, role
        $name = $_POST['namefield'];
        $lastname = $_POST['lastnamefield'];
        $username = $_POST['userfield'];
        $password = $_POST['passfield'];
        $repassword = $_POST['repassfield'];
        $email = $_POST['emailfield'];
        $officeNumber = $_POST['officeNumberfield'];
        $phoneNumber = $_POST['phoneNumberfield'];
        $profilePicture = $_FILES['profilePicturefield'];

        // 
        
        function aleatory_filename($filename, $ext)
        {
            return md5(base64_encode($filename . date('U'))) . $ext;
        }
        if (!empty($_FILES['profilePicturefield'])) {
            //upload pictureProfile
            $uploads_dir = "/var/www/focus-monitor/img/profile/";
            $tmp_name = $_FILES['profilePicturefield']["tmp_name"];
            $namephoto = basename($_FILES['profilePicturefield']["full_path"]);

            $randomName = aleatory_filename($namephoto, ".jpg");
            // print($tmp_name);
            // print($namephoto);
            // print($randomName);
            if (!move_uploaded_file($tmp_name, $uploads_dir . $randomName)) {
                echo "Something was wrong with file"; //para que funcione la foto no tiene que estar en el servidor
            }
        }else{
            $randomName = "default.png";
        }

        $faculty = $_POST['facultyfield'];
        $role = $_POST['userRole'];
        if ($password == $repassword) {
            if(!$dbObject->checkIFUserExists($username)){
                if (checkPassword($password)) {
                    $checkUser = array($name, $lastname, $username, $password, $email, $officeNumber, $phoneNumber, $randomName, $faculty, $role);
                    if (checkEmptyFields($checkUser) && checkPassword($password)) {
                        //encrytp password with md5
                        $encryptedPass = md5($password); //TODO: change md5 
                        $newUser = new User($name, $lastname, $username, $encryptedPass, $email, $officeNumber, $phoneNumber, $randomName, $faculty, $role);
                        if (checkAllFields($newUser)) {
                            $dbObject->registerUser($newUser) ? header('Location: index.php') : 'The user cannot be registered';
                        }
                    }
                }
            }else{
                print("This username already exists");
            }
        } else {
            print("Passwords are not the same first pass" . $password . " and second pass " . $repassword);
        }
    }
    ?>
</body>

</html>