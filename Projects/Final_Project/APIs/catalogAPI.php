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
    
    $sql = "";
    
    $records;
    
    switch($_GET['method'])
    {
        case 'demo':
            {
                $sql = "SELECT * FROM demographics;";
                $records = getCodeResults($sql, $conn);
                break;
            }
        case 'genre':
            {
                $sql = "SELECT * FROM genres;";
                $records = getCodeResults($sql, $conn);
                break;
            }
        case 'all':
            {
                $sql = "SELECT *
                        FROM catalog
                        NATURAL JOIN demographics
                        NATURAL JOIN authors;";
                $records = getCodeResults($sql, $conn);
                break;
            }
        case 'addAuthor':
            {
                $code_pt_1 = "INSERT INTO om_product (";
                $code_pt_2 = ") VALUES (";
                $sql = "SELECT *
                        FROM catalog
                        NATURAL JOIN demographics
                        NATURAL JOIN authors;";
                $records = getCodeResults($sql, $conn);
                break;
            }
        default:
            {
                break;
            }
    }

    
    
    if(empty($records))
    {
        echo json_encode(false);
    }
    else
    {
        echo json_encode($records);
    }

?>