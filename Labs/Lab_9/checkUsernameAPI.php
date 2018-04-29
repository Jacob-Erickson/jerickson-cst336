<?php

    function getDatabaseConnection($dbName) 
    {
        $host = "localhost";
        $username = "web_user";
        $password = "s3cr3t";
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
    
    function runCode($code, $database)
    {
        $records = $database->prepare($code);
        $records->execute();
    }
    
    $conn = getDatabaseConnection("c9");
    
    $username = $_GET['username'];
    
    $sql = "SELECT * FROM lab9_user WHERE username = :username";
    
    $records = $conn->prepare($sql);
    $records->execute( array(":username" => $username));
    $records = $records->fetchAll(PDO::FETCH_ASSOC);
    
    if(empty($records))
    {
        echo json_encode(false);
    }
    else
    {
        echo json_encode($records);
    }
?>