<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header('location: index.php');
    }
    require_once 'db/db_connection.php';
    require_once 'objects/user.php';
    require_once 'validations/validator.php';
    require_once '/var/www/focus-monitor/app/php/objects/errorLog.php';
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
<link rel="stylesheet" href="../css/main/support.css">
    <?php require_once("header.php") ?>
    <title>Contact to support</title>
</head>
<body>
    <div class="container">
        <?php require_once("menu.php")?>
        <main>
            <div class="namePicture">
                <div id="introText">
                    <h2>Support Contact Centre</h2>
                </div>
            </div>
            <div class="data">
                <div class="faq">
                    <h2>FAQ</h2>
                    <div class="question1">
                        <h4>What can I do if I have an emergency?</h4>
                        <p>Emergencies are considered as such, only if the incidence happens out of our working hours. Should you have an emergency within our schedule, please contact us via email. Were you to have an emergency out of the schedule, contact us through our phone number. </p>
                    </div>
                    <div class="question2">
                        <h4>Can I order new charts?</h4>
                        <p>Of course. If you have new parameters to monitor, tell us your needs and we will change whatever is needed. </p>
                    </div>
                    <div class="question3">
                        <h4>Can you check our code?</h4>
                        <p>Yes, we can check your code but it is necessary to arrage a meeting for you to explain the code to us.</p>
                    </div>
                    <div class="question4">
                        <h4>Our group needs an extra node, what do we do?</h4>
                        <p>Write an email explaining all your needs. We can search for nodes for implementing your jobs or buy some in case they are needed.</p>
                    </div>
                    <div class="question5">
                        <h4>I need a new group, can you create it?</h4>
                        <p>Yes, it is only necessary for you to write an email with the groupname and all users that you want to include within</p>
                    </div>
                </div>
                <div class="incidenceForm">
                    <h2>Send your incidence</h2>
                    <div class="data1">
                        <div class="colInfo">
                            <div class="emergencies">
                                <h3>Should you have an emergency, call at: 942897525</h3>
                            </div>
                            <div class="downloads">
                                <h3>Download the software you need</h3>
                                <a href="#"><img src="../../img/support/anydesk_logo.png" alt=""></a>
                                <a href="#"><img src="../../img/support/teamviewer_logo.png" alt=""></a>
                            </div>
                            <div class="information">
                                <h3>Our schedule</h3>
                                <ul>
                                    <li>Monday - Thursday: 08:00 - 18:30</li>
                                    <li>Friday: 08:00 - 15:00</li>
                                </ul>
                            </div>
                        </div>
                        
                        <form action="" method="post" name="personalData" class="formIncidence">
                            
                            <div class="formInci">
                                <div class="userName">
                                    <p>Username: </p>
                                    <input type="text">
                                </div>
                                <div class="phone">
                                    <p>Phone: </p>
                                    <input type="tel">
                                </div>
                                <div class="email">
                                    <p>Email: </p>
                                    <input type="email">
                                </div>
                                <div class="describe">
                                    <p>Describe your problem: </p>
                                    <textarea name="incidence" id="incidence" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                            <div class="buttons">
                                <input type="submit" value="Send" name="sendIncidence">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <?php
        if(isset($_POST['sendIncidence'])){
            $to = "nuriasmr211@gmail.com";
            $subject = "probando";
            $message = "prueba";
            if(mail($to,$subject,$message)){
                echo "va bien";
            }else{
                echo "no va";
            }
        }

        
    ?>

</body>
</html>