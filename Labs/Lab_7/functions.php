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

    function seedHead()
    {
        echo "<head>";
        echo "<title> Administration </title>";
        echo "<meta charset='UTF-8'>";
        echo "<meta name='viewport' content='width=device-width, initial-scale=1'>";
        echo "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>";
        echo "<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' integrity='sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa' crossorigin='anonymous'></script>";
        echo "<link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u' crossorigin='anonymous'>";
        echo "</head>";
    }
    
    function seedNav()
    {
        echo "<nav class='navbar navbar-default - navbar-fixed-top'>";
        echo "<div class='container-fluid'>";
        echo "<div class='navbar-header'>";
        echo "<a class='navbar-brand' href='#'>Ottermart Admin</a>";
        echo "</div>";
        echo "<ul class='nav navbar-nav'>";
        if(empty($_SESSION['user']))
        {
            echo "<li>";
            echo "<form method='post' action='index.php' style='margin-top: 10%;'>";
            echo "<button class='btn' name='login' value='true'>";
            echo "Login";
            echo "</button>";
            echo "</form>";
            echo "</li>";
        }
        else
        {
            echo "<li>";
            echo "<form method='post' action='index.php' style='margin-top: 10%;'>";
            echo "<button class='btn' name='logout' value='true'>";
            echo "Log Out";
            echo "</button>";
            echo "</form>";
            echo "</li>";
        }
        echo "</ul>";
        echo "</div>";
        echo "</nav>";
        echo "<br /> <br /> <br />";
    }

?>