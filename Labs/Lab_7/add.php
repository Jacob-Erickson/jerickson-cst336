<?php

    include "functions.php";
    
    $conn = getDatabaseConnection("ottermart");
    
    seedHead();
    
    seedNav();
    
    if(isset($_SESSION['user']))
    {
        if(!isset($_SESSION['add']))
        {
            echo "<form method='post'>";
            echo "<input"
            echo "</form>";
        }
        else
        {
            unset($_POST);
            echo "Successfully Added";
        }
    }
    else
    {
        echo "You must be logged in to add items";
    }

?>