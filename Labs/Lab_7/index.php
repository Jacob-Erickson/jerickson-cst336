<?php  

    session_start();

    include "functions.php";
    
    if(isset($_POST['logout']))
    {
        unset($_SESSION['user']);
    }

?>
<!DOCTYPE html>
<html>
    <?php seedHead(); ?>
    <body>
        
        <?php seedNav(); ?>
        
        <main>
        
        <?php
        
            if(!isset($_SESSION['user']))
            {
                
        ?>
        
        <h1> OtterMart - Admin Login </h1>
        
        <hr />
        
        <form method="post" action="loginProcess.php" >
            Username: &emsp;<input type="text" name="username"/> <br />
            <hr />
            Password: &emsp; <input type="password" name="password"/> <br />
            <hr />
            <input type="submit" name="submitForm" value="Login" />
            
        </form>
        
        <?php
        
            }//end of if statement
            else
            {
        
        ?>
        
        <h1>You are already logged in.</h1>
        <h2>To log in as a different user please first log out.</h2>
        
        <?php
        
            }//end of else statement
        
        ?>
        </main>

    </body>
</html>