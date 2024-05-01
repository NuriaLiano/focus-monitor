<?php

    class ErrorLog{
        private $path;
        private $error_date;
        private $message;

        function __construct(){
            $this->path = "/var/log/focusmonitor/error.log";
            $this->error_date = date("Y-m-d H:i:s");
            $this->message = "default";
        }


        function getPath(){
            return $this->path;
        }
        function setPath($path){
            $this->path = $path;
        }
        function getError_date(){
            return $this->error_date;
        }
        function setError_date($date){
            $this->error_date = $date;
        }
        function getMessage(){
            return $this->message;
        }
        function setMessage($message){
            $this->message = $message;
        }

        function createFile(){
            if (file_exists($this->path) != 1) {
                //echo "This file "."/var/log/focusmonitor/error.log"." already exits";
                $myfile = fopen($this->path, "w+b") or die("Unable to open file!");
                fclose($myfile);
                return true;
            }
        }

        function readFile(){
            $array_log = [];
            if (file_exists($this->path) == 1) {
                $file = fopen($this->path,"r");
                //Output lines until EOF is reached
                while(! feof($file)) {
                    array_push($array_log,fgets($file));
                }
                fclose($file);
                return $array_log;
            }else{
                echo "This file ".$this->path." doesn't exists or the path is wrong";
            }
        }

        function writeFile($message){
            $newEntry = $this->error_date . " " . $message;
            if(file_exists($this->path) == 1){
                $file = fopen($this->path, "a");
                if($message != ""){
                    fwrite($file,$newEntry . PHP_EOL);
                }else{
                    fwrite($file, PHP_EOL. $this->message);
                }
                fclose($file);
                return true;
            }
        }

        function cleanFile(){
            if(file_exists($this->path) == 1){
                unlink($this->path); 
                $file = fopen($this->path, "w+b") or die("Unable to open file!");
                fclose($file);
                return true;
            }
        }
    }

?>