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
$userData = $dbObject->searchUser($_SESSION['username']);

//$dbObject->changeUser();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="stylesheet" href="../css/main/profile.css">
    <?php require_once("header.php") ?>
    <title>My profile</title>
</head>

<body>
    <div class="container">
        <?php require_once("menu.php") ?>
        <main>
            <div class="namePicture">
                <div id="introText">
                    <h2>Hello, &nbsp; </h2>
                    <h2 id="showUsername"><?php print($_SESSION['username']) ?></h2>
                </div>
                <img src="../../img/profile/<?php echo $userData['profilePicture'] ?> " alt="">
            </div>
            <div class="data">
                <!-- <div class="profileResume">
                    <h2>View your infrastructure data</h2>
                    <div class="personal">
                    </div>
                    <div class="group"></div>
                    <div class="general"></div>
                </div> -->
                <div class="modifyData">
                    <h2>Modify your details</h2>
                    <div class="data1">
                        <form action="" method="post" name="personalData" class="formPersonal" enctype="multipart/form-data">
                            <div class="dataForm">
                                <div class="personal">
                                    <div class="name">
                                        <p>Name: </p>
                                        <input type="text" name="name" placeholder="<?php echo $userData['name'] ?>">
                                    </div>
                                    <div class="lastname">
                                        <p>Lastname: </p>
                                        <input type="text" name="lastname" placeholder="<?php echo $userData['lastname'] ?>">
                                    </div>
                                    <div class="userName">
                                        <p>Username: </p>
                                        <input type="text" name="user" placeholder="<?php echo $userData['username'] ?>">
                                    </div>
                                    <div class="phone">
                                        <p>Phone: </p>
                                        <input type="tel" name="phoneNumber" placeholder="<?php echo $userData['phoneNumber'] ?>">
                                    </div>
                                    <div class="email">
                                        <p>Email: </p>
                                        <input type="email" name="email" placeholder="<?php echo $userData['email'] ?>">
                                    </div>
                                    <div class="profilePicture">
                                        <p>Profile picuture: </p>
                                        <input type="file" name="profilePicture">
                                    </div>
                                </div>
                                <div class="group">
                                    <div class="department">
                                        <p>Group: </p>
                                        <select name="userRole" id="userRole" class="required" require>
                                            <option value="">Choose your group</option>
                                            <option value="1">Administrator</option>
                                            <option value="2">SMG group</option>
                                            <option value="3">Economia group</option>
                                            <option value="4">Geocean group</option>
                                            <option value="5">Citimac group</option>
                                            <option value="6">GTFE group</option>
                                        </select>
                                    </div>
                                    <div class="faculty">
                                        <p>Faculty: </p>
                                        <select name="faculty" id="faculty">
                                            <option value="">Choose your faculty</option>
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
                                    </div>
                                    <div class="office">
                                        <p>Office number: </p>
                                        <input type="number" name="officeNumber" placeholder="<?php print_r($userData['officeNumber']) ?>">
                                    </div>
                                    <div class="buttons">
                                        <input type="submit" value="Save changes" name="saveChanges">
                                        
                                    </div>
                                </div>
                            </div>

                        </form>
                        <form action="" method="post" name="changePassword" class="formChangePass">
                            <div class="changePassHeader">
                                <h3>Change password</h3>
                                <img src="../../img/show_password.png" alt="" id="toggleBtn" class="show">
                                <input type="submit" value="Change password" name="changePassword" id="btnPassword">
                            </div>
                            <div class="changePassword">
                                <div class="oldPass">
                                    <p>Confirm your old password: </p>
                                    <input type="password" name="oldPassword" id="oldPassword">
                                </div>
                                <div class="newPass">
                                    <p>Enter your new password: </p>
                                    <input type="password" name="newPassword" id="newPassword">
                                </div>
                                <div class="confirmPass">
                                    <p>Confirm your new password: </p>
                                    <input type="password" name="rePassword" id="rePassword">
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>

        </main>
    </div>
    <?php
    
    if (isset($_POST['saveChanges'])) {

        function aleatory_filename($filename, $ext)
        {
            return md5(base64_encode($filename . date('U'))) . $ext;
        }

        //connect to db
        $dbObject->connectionDB();

        $inputs = [];
        //collect inputs with info
        foreach ($_POST as $key => $value) {
            if ($value != "" && $key != "saveChanges") {
                $inputs[$key] = $value; //create array with key and value

            }
        }
        if (!empty($_FILES['profilePicture'])) {
            //upload pictureProfile
            $uploads_dir = "/var/www/focus-monitor/img/profile/";
            $tmp_name = $_FILES['profilePicture']["tmp_name"];
            $name = basename($_FILES['profilePicture']["full_path"]);

            $randomName = aleatory_filename($name, ".jpg");

            if (!move_uploaded_file($tmp_name, $uploads_dir.$randomName)) {
                echo "Something was wrong with file"; 
            }else{
                $inputs["profilePicture"] = $randomName;
            }
        }

        $queryEditUser = "UPDATE users SET";
        $keysArray = array_keys($inputs); //array with keys to inputs array
        for ($i = 0; $i < count($inputs); $i++) {
            switch ($keysArray[$i]) {
                case "name":
                    $queryEditUser .= " name" . "= '" . $inputs["name"] . "' ,";
                    break;
                case "lastname":
                    $queryEditUser .= " lastname" . "= '" . $inputs["lastname"] . "' ,";
                    break;
                case "user":
                    $queryEditUser .= " username" . "= '" . $inputs["user"] . "' ,";
                    break;
                case "email":
                    $queryEditUser .= " email" . "= '" . $inputs["email"] . "' ,";
                    break;
                case "officeNumber":
                    $queryEditUser .= " officeNumber" . "=" . $inputs["officeNumber"] . ",";
                    break;
                case "phoneNumber":
                    $queryEditUser .= " phoneNumber" . "=" . $inputs["phoneNumber"] . ",";
                    break;
                case "faculty":
                    $queryEditUser .= " faculty" . "= '" . $inputs["faculty"] . "' ,";
                    break;
                case "userRole":
                    $queryEditUser .= " id_role" . "=" . $inputs["userRole"] . ",";
                    break;
                case "profilePicture":
                    $queryEditUser .= " profilePicture " . "= '" . $inputs["profilePicture"] . "' ,";
                    break;
            }
        }
        $queryEditUser = substr($queryEditUser, 0, -1); //remove last char 
        $queryEditUser .= " WHERE id=" . $userData['id'] . ";";
        $dbObject->modifyUser($queryEditUser);
    }

    if (isset($_POST['changePassword'])) {
        var_dump($_POST);
        //comprobar si existe el susuario con el username de la sesion
        if ($userData['username'] === $_SESSION['username']) {
            //comprobar si la password corresponde con el usuario
            if (md5($_POST['oldPassword']) == $userData['password']) {
                //comprobar que las contraseñas cumplen los criterios
                if (checkPassword($_POST['newPassword']) && checkPassword($_POST['rePassword'])) {
                    //comprobar que las nuevas password coinciden
                    if (md5($_POST['newPassword']) === md5($_POST['rePassword'])) {
                        //modificar los datos para el usuario
                        $dbObject->resetPassword($_SESSION['username'], md5($_POST['newPassword']));
                    } else {
                        echo "The new passwords are not the same";
                    }
                }
            } else {
                echo "The password is not the same";
            }
        } else {
            echo "The username doesn't exits";
        }
    }

    ?>
</body>

</html>