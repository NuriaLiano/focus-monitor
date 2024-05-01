<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header('location: index.php');
    }
    require_once 'db/db_connection.php';
    require_once 'objects/user.php';
    require_once 'validations/validator.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="../css/main/users.css">
    <?php require_once("header.php") ?>

    <title>Alerts</title>
    <style>
        iframe{
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php require_once("menu.php")?>
        <main>
            <div class="namePicture">
                <div id="introText">
                    <h2>View all alerts</h2>
                </div>
            </div>
            <div class="users">
                <div class="newUser">
                    <div class="groupDivsUsers">
                        <iframe src="https://meteo.unican.es/nagios/cgi-bin//tac.cgi" frameborder="0" width="1000" height="500" ></iframe>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>