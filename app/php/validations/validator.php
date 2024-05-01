<?php

function checkEmptyFields($userArray){
    foreach ($userArray as $key) {
        if($key == NULL || $key == ""){
            return false;
            print("There are empty fields");
        }else{
            return true;
        }
    }
}

function checkAllFields($newUser){
    if(checkNameLastUsername($newUser->getName(), $newUser->getLastname(), $newUser->getUsername()) && checkEmail($newUser -> getEmail())){
       return true;
    }else{
        return false;
    }
}

function checkNameLastUsername($name, $lastname, $username){
    //username = lastname + first letter name

    $lastnameArray = explode("-", strtolower($lastname));
    
    $nameArray = str_split(strtolower($name));
    $correctUsername = $lastnameArray[0] . $nameArray[0];
    if($username != $correctUsername){
        print "Username is incorrect, must be " . $correctUsername;
        return false;
    }else{
        return true;
    }
    
}

function checkPassword($password){
    if(strlen($password) < 8 ){
        print("Password must have 8 characters");
        return false;
    }
    if(strlen($password) > 16){
        print("Password must have max of 16 characters");
        return false;
    }
    if(!preg_match('`[a-z]`', $password)){
        print("Password must have at least one lower case letter");
        return false;
    }
    if(!preg_match('`[A-Z]`', $password)){
        print("Password must have at least one upper case letter");
        return false;
    }
    if(!preg_match('`[0-9]`', $password)){
        print("Password must have at least one number");
        return false;
    }
    return true;

}

function checkEmail ($email){
    if(!preg_match("/@unican.es/i", $email)){
        echo "The email doesn't have '@unican.es'";
        return false;
    }else{
       return true; 
    }
    
}


?>