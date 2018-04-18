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
    
    seedHead();
    
    echo "<main>";
    
    if (empty($record))
    {
        seedNav();
        echo "<h1 style='color: red;'>Wrong username and/or password</h1>";
    }
    else
    {
        $_SESSION['user'] = $record['username'];
        seedNav();
        echo "<h1>Welcome " . $record['firstName'] . ", " . $record['lastName'] . "</h1>";
        echo "<br />";
    }
    echo "</main>";
?>