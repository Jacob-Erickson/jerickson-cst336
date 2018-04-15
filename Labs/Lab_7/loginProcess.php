<?php

    session_start();
    include "functions.php";
    
    $conn = getDatabaseConnection("ottermart");
    
    $username = $_POST['username'];
    $password = sha1($_POST['password']);
    
    $sql = "SELECT *
            FROM om_admin
            WHERE username = '$username'
            AND password = '$password'";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (empty($record))
    {
        echo "Wrong username and/or password";
    }
    else
    {
        $_SESSION['user'] = $record['username'];
        seedHead();
        
        seedNav();
        
        echo "Welcome " . $record['firstName'] . ", " . $record['lastName'];
        echo "<br />";
        
    }

?>