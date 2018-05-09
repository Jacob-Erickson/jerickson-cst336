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
    
    $result = [];
    
    $records;
    
    switch($_GET['method'])
    {
        case 'demo':
            {
                $sql = "SELECT * FROM demographics;";
                $result = getCodeResults($sql, $conn);
                break;
            }
        case 'genre':
            {
                $sql = "SELECT * FROM genres;";
                $result = getCodeResults($sql, $conn);
                break;
            }
        case 'author':
            {
                $sql = "SELECT * FROM authors;";
                $result = getCodeResults($sql, $conn);
                break;
            }
        case 'product':
            {
                $sql = "SELECT * FROM catalog;";
                $result = getCodeResults($sql, $conn);
                break;
            }
        case 'all':
            {
                $sql = "SELECT *
                        FROM catalog
                        NATURAL JOIN demographics
                        NATURAL JOIN authors;";
                $result = getCodeResults($sql, $conn);
                break;
            }
        case 'getEverything':
            {
                $sql = "SELECT *
                        FROM catalog
                        NATURAL JOIN demographics
                        NATURAL JOIN authors;";
                $records = getCodeResults($sql, $conn);
                array_push($result, $records);
                
                $sql = "SELECT * FROM demographics;";
                $records = getCodeResults($sql, $conn);
                array_push($result, $records);
                
                $sql = "SELECT * FROM genres;";
                $records = getCodeResults($sql, $conn);
                array_push($result, $records);
                
                $sql = "SELECT * FROM authors;";
                $records = getCodeResults($sql, $conn);
                array_push($result, $records);
                break;
            }
        case 'addAuthor':
            {
                $sql .= "INSERT INTO authors (";
                $sql .= "firstName, lastName, gender, birth, bio, authorImage";
                $sql .= ") VALUES ('" . $_GET['firstName'] . "', '" . $_GET['lastName'] . "', '" 
                                     . $_GET['gender'] . "', '" . $_GET['birth'] . "', '" 
                                     . $_GET['bio'] . "', '" . $_GET['authorImage'] . "');";
                                     
                runCode($sql, $conn);
                break;
            }
        case 'updateAuthor':
            {
                $sql .= "UPDATE authors SET ";
                $sql .= "firstName = '" . $_GET['firstName'] . "', 
                        lastName = '" . $_GET['lastName'] . "', 
                        gender = '" . $_GET['gender'] . "', 
                        birth = '" . $_GET['birth'] . "', 
                        bio = '" . $_GET['bio'] . "', 
                        authorImage = '" . $_GET['authorImage'] . "' WHERE authorId = " . $_GET['authorId'] . ";";
                        
                runCode($sql, $conn);
                break;
            }
        case 'deleteAuthor':
            {
                $sql = "DELETE FROM `authors` WHERE `authors`.`authorId` = " . $_GET['authorId'] . ";";
                runCode($sql, $conn);
                break;
            }
        default:
            {
                break;
            }
    }

    
    
    if(empty($result))
    {
        switch($_GET['method'])
        {
            case 'addAuthor':
                {
                    echo json_encode(true);
                    break;
                }
            case 'updateAuthor':
                {
                    echo json_encode(true);
                    break;
                }
        case 'deleteAuthor':
            {
                echo json_encode(true);
                break;
            }
            default:
                {
                    echo json_encode(false);
                    break;
                }
        }
    }
    else
    {
        echo json_encode($result);
    }

?>