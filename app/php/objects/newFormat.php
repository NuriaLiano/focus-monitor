<?php

class newFormartCSV {
    private $url;
    private $subdirectory;
    private $chartName;
    private $groupName;
    private $results;
    private $chartPath;
    private $filePath;
    private $headers;
    private $finalArray;

    function __construct($url){
        $this->url = $url;
        $this->subdirectory;
        $this->chartName;
        $this->groupName;
        $this->results = [];
        $this->chartPath;
        $this->filePath;
        $this->headers = [];
        $this->finalArray = [];
    }

    function cutURL(){
        $components = parse_url($this->url);
        parse_str($components['query'], $results);
        
        //damos valor a las variables
        if(array_key_exists("me", $results)){
            //global
            $this->groupName = $results['me'];
            $this->chartName = $results['g'];
        }else if(array_key_exists("c", $results) && !array_key_exists("me", $results) && !array_key_exists("h", $results)){
            //cluster
            $this->groupName = $results['c'];
            $this->chartName = $results['g'];
        }else{
            //nodes
            $this->groupName = substr($results['h'], 0, strlen($results['h'])-10);
            $this->chartName = $results['m'];
        }
        
        $this->results = $results;
        return $results;
    }

    function checkCSVparam(){
        if(!array_key_exists("csv", $this->results)){
            $this->url = $this->url . "&csv=1";
        }
    }

    function downloadData(){

        //start connection
        $curl = curl_init();

        //set parameters to connection
        curl_setopt($curl, CURLOPT_URL, $this->url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);

        //save data
        $data = curl_exec($curl);
        //close connection 
        curl_close($curl);
        return $data;
    }

    function linkHeaders(){
        switch($this->chartName){
            case "load_report":
                $this->headers = ["date", "1-min" ,"Nodes" ,"CPUs" ,"Procs"];
                break;
            case "mem_report":
                $this->headers = ["Timestamp","Use","Share","Cache","Buffer","Free","Swap","Total"];
                break;
            case "cpu_report":
                $this->headers = ["Timestamp","User","Nice","System","Wait","Steal","Sintr","Idle"];
                break;
            case "network_report":
                $this->headers = ["Timestamp", "In" ,"Out"];
                break;
            case "":
                print("La url no mola");
                break;
        }
    }

    function switchGroupChart(){
        if(array_key_exists("h", $this->results)){
            $this->subdirectory = "nodes";
            $this->headers = ["date", "value"];
        }else if (array_key_exists("c",$this->results) && !array_key_exists("h", $this->results)){
            $this->subdirectory = "cluster";
            $this->linkHeaders();
        }else if (array_key_exists("g", $this->results) && !array_key_exists("c", $this->results) && !array_key_exists("h", $this->results)){
            $this->subdirectory = "global";
            $this->linkHeaders();
        }else{
            print("The URL is invalid for this app, please check Ganglia URLs");
        }
    }

    //crea el directorio segun los nombres que necesite
    function createDirectory($data){
        $this->chartPath = "chartsData/".$this->subdirectory."/".$this->groupName;
        if (is_dir($this->chartPath) == 1) {
            $this->createCSVfile($data);
        }else{
            if(mkdir($this->chartPath, 0777, true)){
                $this->createCSVfile($data);
            }else{
                print("Directory could not be created");
            }
        }
    }

    function createCSVfile($data){
        
        $this->filePath = $this->chartPath ."/". "data_".$this->chartName."_".$this->groupName.".csv";
        $file = fopen($this->filePath, "w+b") or die ("The file could not be created. Check directory permission");
        fwrite($file, $data);
        fclose($file);
    }
    
    function csvtoarray($delimitador = ";")
    {
        if (!empty($this->filePath) && !empty($delimitador) && is_file($this->filePath)) {
            $array_total = array();
            $fp = fopen($this->filePath, "r");
            while ($data = fgetcsv($fp, 10000, $delimitador)) {
                $num = count($data);
                $array_total[] = array_map("utf8_encode", $data);
            }
            fclose($fp);
            return $array_total;
        } else {
            return false;
        }
    }

    function replaceHeaders(){
        
        $arraycsv = $this->csvtoarray();
        $reemplazos2 = array(0 => $this->headers);
        return array_replace($arraycsv, $reemplazos2);
    }

    function separateData($arrayNewHeaders){
        array_push($this->finalArray, $arrayNewHeaders[0]);
        
        //it is important mark 1 for skip headers 0 position
        for ($i=1; $i < count($arrayNewHeaders); $i++) { 
            $response = explode(",", $arrayNewHeaders[$i][0]); //no hay mas de 0 por que es un string
            array_push($this->finalArray, $response);
        }
    }

    function createNewCSV($isEpoch){
        $file =fopen("$this->filePath", "w+b") or die ("The new CSV file couldn't created");

        //remove colon headers
        $head = str_replace('"', "",$this->finalArray[0]);
        fputcsv($file, $head) or die ("The headers couldn't insert into new CSV file");
        for ($i=1; $i < count($this->finalArray) ; $i++) { 
            //format date
            $changeSlash = str_replace("-","/", $this->finalArray[$i][0]); //en la posicion 0 esta la fecha
            $removeT = str_replace("T", "-", $changeSlash);
            $removeGMT = substr($removeT, 0, 19);
            if($isEpoch){
                $epochDate = strtotime($removeGMT);
                $this->finalArray[$i][0]= $epochDate;
                fputcsv($file, $this->finalArray[$i]) or die ("The epoch date couldn't insert into new CSV file");
            }else{
                $this->finalArray[$i][0]= $removeGMT;
                fputcsv($file, $this->finalArray[$i]) or die ("The format date couldn't insert into new CSV file");
            }
            
        }
    }


    function switchFormatDate(){
        if($this->chartName == "mem_report" || $this->chartName == "cpu_report" || $this->chartName == "network_report"){
            $this->createNewCSV(true);
        }else{
            $this->createNewCSV(false);
        }
    }

    function main(){
        //first cut the url and extract necessary params
        $this->cutURL();

        //check if url have csv param, if not add it 
        $this->checkCSVparam();

        //download data and save in array
        $data = $this->downloadData();

        //set subdirectory param and call to linkheaders
        $this->switchGroupChart();

        //create new file and new directory with data preformated
        $this->createDirectory($data);

        //change headers depending on subdirectory param and save in new array with data preformated but new headers
        $arrayNewHeaders = $this->replaceHeaders();

        //split the string into several strings to be able to format the date
        $this->separateData($arrayNewHeaders);

        //create new CSV file depending on isepoch, format date and save in to file
        $this->switchFormatDate($arrayNewHeaders);
        
    }

}

?>