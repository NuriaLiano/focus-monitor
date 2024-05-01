<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location: index.php');
}
require_once 'db/db_connection.php';
require_once 'objects/user.php';
require_once 'validations/validator.php';
require_once '/var/www/focus-monitor/app/php/objects/errorLog.php';

$dbObject = new DB();
$dbObject->connectionDB();
showUserRole($_SESSION['username']);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="stylesheet" href="../css/main/users.css">
    <script src="../js/validators/prelogin_reg.js"></script>
    <?php require_once("header.php") ?>
    <title>Users</title>
</head>

<body>
    <div class="container">
        <?php require_once("menu.php") ?>
        <main>
            <div class="namePicture">
                <div id="introText">
                    <h2>View users or add new user</h2>
                </div>
            </div>
            <div class="users">
                <div class="showUsers">
                    <h2>User in group</h2>
                    <div class="listUsers">
                        <ul id="listU">
                            <?php
                            $allUser = $dbObject->selectUserbyGroup($_SESSION['userRole']);
                            for ($i = 0; $i < count($allUser); $i++) {
                                $username = $allUser[$i]->username;
                                echo "<li>$username</li>";
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="newUser">
                    <h2>Add new user</h2>
                    <div class="groupDivsUsers">
                        <form action="" class="formNewUser" method="POST">
                            <input type="text" class="textfield required" name="namefield" id="namefield" placeholder="Enter your name" require>
                            <input type="text" class="textfield required" name="lastnamefield" id="lastnamefield" placeholder="Enter your lastname" require>
                            <input type="text" class="textfield required" name="userfield" id="userfield" placeholder="Create your username" require>
                            <input type="password" class="textfield required" name="passfield" id="passfield" placeholder="Create your password" require>
                            <input type="password" class="textfield required" name="repassfield" id="repassfield" placeholder="Confirm your password" require>
                            <input type="email" name="emailfield" id="emailfield" placeholder="usuario@unican.es" require>
                            <input type="number" name="officeNumberfield" id="officeNumberfield" placeholder="Office number">
                            <input type="file" name="profilePicturefield" id="profilePicture">
                            <input type="tel" name="phoneNumberfield" id="phoneNumber" placeholder="Phone number">
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
                            <select name="userRole" id="userRole" class="required" require>
                                <option value="">Choose your group</option>
                                <option value="1">Administrator</option>
                                <option value="2">SMG group</option>
                                <option value="3">Economia group</option>
                                <option value="4">Geocean group</option>
                                <option value="5">Citimac group</option>
                                <option value="6">GTFE group</option>
                            </select>
                            <input type="submit" value="Create user" name="createUserButton" id="registerButton">
                            <img src="../../img/show_password.png" alt="" id="toggleBtn" class="show" onclick="onload">
                        </form>
                        <div class="informationUsers">
                            <div class="infoUsers">
                                <h3>Username requirements</h3>
                                <p>The username must contain the <b>lastname followed by the inicial of the name</b></p>
                                <p>1. In case of coincidence with another user, it would be <b>lastname + two inicial of the name</b></p>
                                <p>2. In case of compound lastname, it would be only the <b>first lastname of compound lastname + inicial of the name</b></p>
                                <p class="example">Example: María Sanchez-Perez García -> sanchezm / sanchezma</p>
                            </div>
                            <div class="generators">
                                <div class="usernameGenerator">
                                    <p>Or know how is your username</p>
                                    <p>For use, only <b>enter name and lastname in fields</b></p>
                                    <input type="button" value="Username generator" onclick="usernameGenerator()">
                                </div>
                                <div class="passwordGenerator">
                                    <p>Or create a secure password</p>
                                    <input type="button" value="Password generator" onclick="passwordGenerator()">
                                </div>
                            </div>
                            <div class="infoPassword">
                                <h3>Password requirements</h3>
                                <div class="charLenght">
                                    <div class="circle"></div>
                                    <div class="text">
                                        <p>The password's lenght is equal or more than 8</p>
                                    </div>
                                </div>
                                <div class="upperCase">
                                    <div class="circle"></div>
                                    <div class="text">
                                        <p>The password contain one or more capital letter</p>
                                    </div>
                                </div>
                                <div class="specialChar">
                                    <div class="circle"></div>
                                    <div class="text">
                                        <p>The password contain one or more special characters</p>
                                    </div>
                                </div>
                                <div class="numbers">
                                    <div class="circle"></div>
                                    <div class="text">
                                        <p>The password contain one or more numbers</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <?php
    //register new user




    function showUserRole($username)
    {
        $dbObject = new DB();
        $userData = $dbObject->searchUser($username);
        $_SESSION["userRole"] = $userData["id_role"];
    }

    //$dbObject = new DB();

    if (isset($_POST['createUserButton'])) {

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
        $profilePicture = $FILES['profilePicturefield'];

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

            if (!move_uploaded_file($tmp_name, $uploads_dir . $randomName)) {
                echo "Something was wrong with file1"; 
            }
        } else {
            $randomName = "default.png";
        }

        $faculty = $_POST['facultyfield'];
        $role = $_POST['userRole'];

        if ($password == $repassword) {
            if (checkPassword($password)) {
                $checkUser = array($name, $lastname, $username, $password, $email, $officeNumber, $phoneNumber, $randomName, $faculty, $role);
                if (checkEmptyFields($checkUser)) {
                    //encrytp password with md5
                    $encryptedPass = md5($password);
                    $newUser = new User($name, $lastname, $username, $encryptedPass, $email, $officeNumber, $phoneNumber, $randomName, $faculty, $role);
                    if (checkAllFields($newUser)) {
                        if ($newUser->getRole() == $role) {
                            $dbObject->registerUser($newUser) ? "The user has already registered" : 'The user cannot be registered';
                        } else {
                            print("The user can only modify other users in his group");
                        }
                    }
                }
            }
        } else {
            print("Passwords are not the same first pass" . $password . "second pass " . $repassword);
        }
    }
    ?>

</body>

</html>