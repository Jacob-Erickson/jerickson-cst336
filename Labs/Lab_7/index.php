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
        
        <h1> OtterMart - Admin Login </h1>
        
        <form method="post" action="loginProcess.php" >
            <input type="text" name="username"/> <br />
            <input type="password" name="password"/> <br />
            
            <input type="submit" name="submitForm" value="Login" />
            
        </form>

    </body>
</html>