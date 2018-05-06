<?php

    include "inc/header.php";
    
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
    
    function getAllPets()
    {
        $conn = getDatabaseConnection("c9");
        
        $sql = "SELECT id, name, type FROM pets";
        
        $records = $conn->prepare($sql);
        $records->execute();
        $records = $records->fetchAll(PDO::FETCH_ASSOC);
        
        return $records;
    }
    
    $petList = getAllPets();
?>

<!-- Modal -->
<div class="modal fade" id="petModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <strong><h2 class="modal-title" id="petModalLabel"></h2></strong>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="petInfo">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    
    //print_r($petList);
    
    echo "<table>";
    
    foreach($petList as $key => $value)
    {
        echo "<tr><td class='listing left'>";
        echo "<span>Name: <a href='#' class='petLink' id='" . $value['id'] . "'>" . $value['name'] . "</a><br />";
        echo "type: " . $value['type'] . "</span></td><td class='listing right'>";
        echo '<a href="pets.php" class="btn btn-light btn-lg active" role="button" aria-pressed="true" style="float: right;">Adopt Me!</a>';
        echo "</td></tr>";
    }
    
    echo "</table>";

?>

<?php

    include "inc/footer.php";

?>