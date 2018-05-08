<?php

    session_start();
    
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
    
    $conn = getDatabaseConnection("mangaMart");
    
    $username = $_POST['username'];
    $password = sha1($_POST['password']);
    
    $sql = "SELECT *
            FROM admin
            WHERE username = :username
            AND password = :password";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute( array(':username' => $username,
                          ':password' => $password));
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    
    
    if(empty($record))
    {
        echo json_encode(false);
    }
    else
    {
        $_SESSION['user'] = $username;
        echo json_encode($record);
    }
    
?>