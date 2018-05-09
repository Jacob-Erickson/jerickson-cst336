<?php

    function getDatabaseConnection($dbName) 
    {
        $host = "localhost";
        $username = "jacob66";
        $password = "Dreini10";
        $dbname = $dbName;
        
        //checks whether the URL contains "herokuapp" (using Heroku)
        if(strpos($_SERVER['HTTP_HOST'], 'herokuapp') !== false) {
           $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
           $host = $url["host"];
           $dbname = substr($url["path"], 1);
           $username = $url["user"];
           $password = $url["pass"];
        }
        
        $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        return $dbConn;
    
    }
    
    function getCodeResults($code, $database)
    {
        $results = $database->prepare($code);
        $results->execute();
        $results = $results->fetchAll(PDO::FETCH_ASSOC);
        
        return($results);
    }
    
    function runCode($code, $database)
    {
        $results = $database->prepare($code);
        $results->execute();
    }
?>