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

    function seedHead()
    {
        echo "<head>";
        echo "<title> Administration </title>";
        echo "<meta charset='UTF-8'>";
        echo "<meta name='viewport' content='width=device-width, initial-scale=1'>";
        echo "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>";
        echo "<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' integrity='sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa' crossorigin='anonymous'></script>";
        echo "<link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u' crossorigin='anonymous'>";
        echo "<style type='text/css'>";
        echo "@import url('styles.css');";
        echo "</style>";
        echo "</head>";
    }
    
    function seedNav()
    {
        echo "<header>";
        echo "<nav class='navbar navbar-default - navbar-fixed-top'>";
        echo "<div class='navbar-header'>";
        echo "</div>";
        echo "<ul class='nav navbar-nav'>";
        echo "<li>";
        echo "<a class='navbar-brand' href='index.php'>Ottermart Admin</a>";
        echo "</li>";
        if(empty($_SESSION['user']))
        {
            echo "<li>";
            echo "<form id='nav-form' method='post' action='index.php' style='margin-top: 10%; box-shadow: 1px 1px 1px 1px; border-radius: 3px;'>";
            echo "<button class='btn' name='login' value='true'>";
            echo "Login";
            echo "</button>";
            echo "</form>";
            echo "</li>";
        }
        else
        {
            echo "<li>";
            echo "<form id='nav-form' method='post' action='index.php' style='margin-top: 10%; box-shadow: 1px 1px 1px 1px; border-radius: 3px;'>";
            echo "<button class='btn' name='logout' value='true'>";
            echo "Log Out";
            echo "</button>";
            echo "</form>";
            echo "</li>";
        }
        echo "<li>";
        echo "<form id='nav-form' method='post' action='add.php' style='margin-top: 13%; margin-left: 15%; box-shadow: 1px 1px 1px 1px; border-radius: 3px;'>";
        echo "<button class='btn' name='add' value='true'>";
        echo "Add";
        echo "</button>";
        echo "</form>";
        echo "</li>";
        
        echo "<li>";
        echo "<form id='nav-form' method='post' action='edit.php' style='margin-top: 13%; margin-left: 15%; box-shadow: 1px 1px 1px 1px; border-radius: 3px;'>";
        echo "<button class='btn' name='edit' value='true'>";
        echo "Edit";
        echo "</button>";
        echo "</form>";
        echo "</li>";
        
        echo "<li>";
        echo "<form id='nav-form' method='post' action='delete.php' style='margin-top: 10%; margin-left: 15%; box-shadow: 1px 1px 1px 1px; border-radius: 3px;'>";
        echo "<button class='btn' name='delete' value='true'>";
        echo "Delete";
        echo "</button>";
        echo "</form>";
        echo "</li>";
        echo "</ul>";
        echo "</nav>";
        echo "</header>";
    }

?>