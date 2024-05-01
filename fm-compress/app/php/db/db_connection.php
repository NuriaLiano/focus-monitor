<?php
//env var DOTENV
    require '/var/www/focus-monitor/app/vendor/autoload.php';
    #require '/var/www/focusmonitor/app/vendor/autoload.php';
    Dotenv\Dotenv::createUnsafeImmutable('/var/www/focus-monitor/app/')->load();

    require_once '/var/www/focus-monitor/app/php/objects/errorLog.php';

    class DB{

    //connection date
    private $host;
    private $db;
    private $user;
    private $pass;
    private $port;

    function __construct(){
        $this->host = getenv('DB_HOST');
        $this->db = getenv('DB_NAME');
        $this->port = getenv('DB_PORT');
        $this->user = getenv('DB_USER');
        $this->pass = getenv('DB_PASS');
    }


    //This function only connect to db
    function connectionDB(){
        $options['utf8'] = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"];
        $options["mysql_PDO"]="mysql:host=$this->host;dbname=$this->db;port=$this->port";
        try { 
           $connect = new PDO($options['mysql_PDO'], $this->user, $this->pass, $options['utf8']);
           ///print("Has been succesfully connected to the database ".$this->db);
           return $connect;
        } catch (PDOException $ex) {
            $errorFile = new ErrorLog();
            exit($errorFile->writeFile($ex->getMessage()));
            //exit("Error: " . $ex->getMessage());
        }
    }

    function getAllUsers(){
        $allUsers = []; //array with all users from db
        $connect = $this->connectionDB(); 
        try {
            $query_result = $connect->query("SELECT * FROM users"); 
            while ($userDB = $query_result->fetch(PDO::FETCH_OBJ)) { //$userDB is each user from DB 
                array_push($allUsers, $userDB);
                return $allUsers;
            }
        } catch (Exception $e) {
            $errorFile = new ErrorLog();
            exit($errorFile->writeFile($e->getMessage()));
        }
    }

    function autenticateUser($username, $password){
        
        $connect = $this->connectionDB();
        try{
            $connect->beginTransaction();
            $query_result = $connect->prepare("SELECT username, password FROM users WHERE username = :username AND password = :password");
            
            $query_result -> bindParam(":username", $username, PDO::PARAM_STR);
            $query_result-> bindParam(':password', $password, PDO::PARAM_STR);
            $query_result->execute();

            if($query_result->rowCount() == 1){
                return true;
            }else{
                return false;
            }
            
        }catch(Exception $e){
            $errorFile = new ErrorLog();
            exit($errorFile->writeFile($e->getMessage()));
        }     
    }

    function checkIFUserExists($username){
        
        $connect = $this->connectionDB();
        try{
            $connect->beginTransaction();
            $query_result = $connect->prepare("SELECT username FROM users WHERE username = :username");
            
            $query_result -> bindParam(":username", $username, PDO::PARAM_STR);
            $query_result->execute();

            if($query_result->rowCount() == 1){
                return true;
            }else{
                return false;
            }
            
        }catch(Exception $e){
            $errorFile = new ErrorLog();
            exit($errorFile->writeFile($e->getMessage()));
        }     
    }

    
    function registerUser($userObject){
        
        $connect = $this->connectionDB();
        $name = $userObject -> getName();
        $lastname = $userObject -> getLastname();
        $username = $userObject -> getUsername();
        $password = $userObject -> getPassword();
        $email = $userObject -> getEmail();
        $officeNumber = $userObject -> getOfficeNumber();
        $phoneNumber = $userObject -> getPhoneNumber();
        $faculty = $userObject -> getFaculty();
        $role = $userObject -> getRole();
        $profilePicture = $userObject -> getProfilePicture();

        try{
            $connect->beginTransaction();

            $insertUser = $connect->prepare("INSERT INTO users (name, lastname, username, password, email, officeNumber, phoneNumber, faculty, id_role, profilePicture) VALUES (?,?,?,?,?,?,?,?,?,?)");
            $insertUser->bindParam(1, $name , PDO::PARAM_STR);
            $insertUser->bindParam(2, $lastname, PDO::PARAM_STR); //TODO: how encrypted password mysql, it is neccesary encrypt before or its included in insert
            $insertUser->bindParam(3, $username, PDO::PARAM_STR);
            $insertUser->bindParam(4, $password, PDO::PARAM_STR);
            $insertUser->bindParam(5, $email, PDO::PARAM_STR);
            $insertUser->bindParam(6, $officeNumber, PDO::PARAM_INT);
            $insertUser->bindParam(7, $phoneNumber, PDO::PARAM_INT);
            $insertUser->bindParam(8, $faculty, PDO::PARAM_STR);
            $insertUser->bindParam(9, $role, PDO::PARAM_STR);
            $insertUser->bindParam(10, $profilePicture, PDO::PARAM_STR);

            $insertUser->execute();

            //check if insert is complete
            $rowAffected = $insertUser->rowCount();
            if($rowAffected >= 1){ //TODO: check if >=1 it is security break with sql injections
                $connect->commit();
                return true;
                echo " Se ha registrado el usuario ";
            }else{
                $connect->rollBack();
                echo " Error al registrar el usuario ";
            }

            unset($connect);

        }catch(Exception $e){
            $errorFile = new ErrorLog();
            exit($errorFile->writeFile($e->getMessage()));
        }
    }
    
    function resetPassword($username, $newPassword){ //the password must be encrypted
        $connect = $this->connectionDB();
        try{
            $connect->beginTransaction();
            $changePassword = $connect->prepare("UPDATE users SET password = :password WHERE username = :username");
            $changePassword-> bindParam(':password', $newPassword, PDO::PARAM_STR);
            $changePassword->bindParam(':username', $username, PDO::PARAM_STR);
            $changePassword->execute();

            //check if insert is complete
            $rowAffected = $changePassword->rowCount();
            if($rowAffected >= 1){ //TODO: check if >=1 it is security break with sql injections
                $connect->commit();
                return true;
            }else{
                return false;
                $connect->rollBack();
            }
            unset($connect);
        }catch(Exception $e){
            $errorFile = new ErrorLog();
            exit($errorFile->writeFile($e->getMessage()));
        }
    }

    function searchUser($username){
        $connect = $this->connectionDB();
        try {
            
            $searchQuery = $connect->prepare("SELECT * FROM users WHERE username = ?");
            $searchQuery->bindParam(1, $username, PDO::PARAM_STR);
            $searchQuery->execute();


            $infoUser = $searchQuery->fetch(PDO::FETCH_OBJ);
            unset($searchQuery);

            //transform object to array
            $arrayInfoUser = (array) $infoUser;
            return $arrayInfoUser; //retun array

        } catch (Exception $e) {
            $errorFile = new ErrorLog();
            exit($errorFile->writeFile($e->getMessage()));
        }
    }

    function selectUserbyGroup($role){
        $allUsers = []; //array with all users from db
        $connect = $this->connectionDB(); 
        try {
            $query_result = $connect->prepare("SELECT * FROM users WHERE id_role = ?");
            $query_result->bindParam(1, $role, PDO::PARAM_STR);
            $query_result->execute();
            while ($userDB = $query_result->fetch(PDO::FETCH_OBJ)) { //$userDB is each user from DB 
                array_push($allUsers, $userDB);
            }
            unset($query_result);
            return $allUsers;
        } catch (Exception $e) {
            $errorFile = new ErrorLog();
            exit($errorFile->writeFile($e->getMessage()));
        }
    }

    function searchInput($input, $value){
        $allUsers = []; //array with all users from db
        $connect = $this->connectionDB(); 
        try {
            $query_result = $connect->prepare("SELECT * FROM users WHERE ? = ?");
            $query_result->bindParam(1, $input, PDO::PARAM_STR);
            $query_result->bindParam(2, $value, PDO::PARAM_STR);
            $query_result->execute();
            while ($userDB = $query_result->fetch(PDO::FETCH_OBJ)) { //$userDB is each user from DB 
                array_push($allUsers, $userDB);
            }
            unset($query_result);
            return $allUsers;
        } catch (Exception $e) {
            $errorFile = new ErrorLog();
            exit($errorFile->writeFile($e->getMessage()));
        }
    }

    function modifyUser($querySQL){
        $connect = $this->connectionDB();
        try{
            $connect->beginTransaction();
            $connect->exec($querySQL);
            $connect->commit();
            
        }catch(Exception $e){
            $connect->rollBack();
            $errorFile = new ErrorLog();
            exit($errorFile->writeFile($e->getMessage()));
            unset($connect);
        }
    }

    function removeUser($username, $email, $password, $role){
        /*
        IT IS NECESARY ENCRYPT THE PASSWORD BEFORE 
        username, email and password are vars for user will be deleted
        role is for user admin who will delete the normal user
        
        */
        if($role != 1){
            echo "Para eliminar usuarios tienes que tener rol de administrador";
        }else{
            $connect = $this->connectionDB();
            $infoUserRemove = $this->searchUser($username, $email);
            if(count($this->searchUser($username, $email)) >= 1){
                try{
                    $removeQuery = $connect->prepare("DELETE FROM users WHERE username = ? AND email = ? AND password = ?");
                    $removeQuery->bindParam(1, $username, PDO::PARAM_STR);
                    $removeQuery->bindParam(2, $email, PDO::PARAM_STR);
                    $removeQuery->bindParam(3, $password, PDO::PARAM_STR);
                    $removeQuery->execute();
                    $rowAffected = $removeQuery->rowCount();
                    print($rowAffected);
                    if($rowAffected == 1){
                        $connect->commit();
                    }else{
                        print("error");
                        $connect->rollBack();
                    }
                    unset($connect);
                }catch(Exception $e){
                    $errorFile = new ErrorLog();
                    exit($errorFile->writeFile($e->getMessage()));
                }
            }
            
        }
    }

    function addErrorLog($errorLogObject){ //params object
        
        $connect = $this->connectionDB();

        $path = $errorLogObject->getPath();
        $error_date = $errorLogObject->getError_date();
        $message = $errorLogObject->getMessage();

        try{
            
            $connect->beginTransaction();

            $insertError = $connect->prepare("INSERT INTO error_logs (path, error_date, message) VALUES (?,?,?)");
            $insertError->bindParam(1, $path , PDO::PARAM_STR);
            $insertError->bindParam(2, $error_date, PDO::PARAM_STR);
            $insertError->bindParam(3, $message, PDO::PARAM_STR);

            $insertError->execute();

            //check if insert is complete
            $rowAffected= $insertError->rowCount();
            if($rowAffected >= 1){
                $connect->commit();
                return true;
            }else{
                $connect->rollBack();
                if($errorLogObject->createFile()){
                    $errorLogObject->writeFile(" An error ocurred while registering ");
                }
            }
            unset($connect);

        }catch(Exception $e){
            if($errorLogObject->createFile()){
                $errorLogObject->writeFile($e->getMessage());
            }
        }
    }



}
