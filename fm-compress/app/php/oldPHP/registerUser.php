<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main/main.css">
    <title>Document</title>
</head>
<body>
    <div id="register">
        <div id="box">
            <form action="" name="register-user" method="post">
                <div id="title">
                    <h2>Register new user</h2>
                </div>
                <div id="form">
                    <div class="textbox">
                        <!--username, password, email, emailEmergency, name, lastname, role-->
                        <input type="text" class="textfield" name="userfield" id="userfield" placeholder="Create your username" require>
                        <input type="password" class="textfield" name="passfield" id="passfield" placeholder="Create your password" require>
                        <input type="password" class="textfield" name="repassfield" id="repassfield" placeholder="Confirm your password" require>
                        <input type="email" name="emailfield" id="emailfield" placeholder="usuario@unican.es" require> <!--TODO: check if email is @unican.es o alumnos.unican.es-->
                        <input type="email" name="emailEmergencyfield" id="emailEmergencyfield" placeholder="usuario@domain" require>
                        <input type="text" class="textfield" name="namefield" id="namefield" placeholder="Enter your name" require>
                        <input type="text" class="textfield" name="lastnamefield" id="lastnamefield" placeholder="Enter your lastname" require>
                        <select name="userRole" id="userRole" require>
                            <option value="">Choose your group</option>
                            <option value="admin">Administrator</option>
                            <option value="smg">SMG group</option>
                            <option value="economia">Economia group</option>
                            <option value="economia">Geocean group</option>
                            <option value="economia">Citimac group</option>
                            <option value="economia">GTFE group</option>
                        </select>

                    </div>
                    <div class="buttons">
                        <input type="submit" value="Register" name="registerButton" id="registerButton" class="buttonSend">
                        <input type="submit" value="Log in" name="loginButton" id="loginButton" class="buttonSend">
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

        if(isset($_POST['registerButton'])){
            //username, password, email, emailEmergency, name, lastname, role
            $username = $_POST['userfield'];
            $password = $_POST['passfield'];
            $repassword = $_POST['repassfield'];
            $email = $_POST['emailfield'];
            $emailEmergency = $_POST['emailEmergencyfield'];
            $name = $_POST['namefield'];
            $lastname = $_POST['lastnamefield'];
            $role = $_POST['userRole'];

            if($password == $repassword){
               //encrytp password with md5
                $encryptedPass = md5($password);
                if($dbObject->registerUser($username, $encryptedPass, $email, $emailEmergency, $name, $lastname, $role)){
                    echo " Se ha registrado el usuario ";
                    header('Location: index.php');
                }else{
                    echo "El usuario no se ha podido registrar";
                    echo "<script>
                        window.open('https://www.google.com', 'prueba', 'width=120,height=300,scrollbars=NO')
                    </script>";
                }
            }else{
                echo "No coinciden las contraseñas";
            }
        }
    
    ?>


</body>
</html>