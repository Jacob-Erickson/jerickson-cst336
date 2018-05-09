<?php

    session_start();

    include "inc/header.php";

?>

    <div class="jumbotron">
        
<?php

    if(!isset($_SESSION['user']))
    {
        echo '<h1>You are not logged in.</h1>';
        echo '<h2>If you want to view catalog statistics please first log in.</h2>';
        echo '</div>';
    }
    else
    {
?>
    <h1>Stats</h1>
    
    </div>
    
    <br />
    
    <form method="post">
        <input type="hidden" name="logger" value="false" />
        <input class="btn btn-primary" type="submit" value="Log Out"/>
    </form>
    
    <br />
    <br />
    
    <h2>Change Username and/or Password</h2>
    
    <span style="color: red;">* at the moment you cannot change your username or password</span>
    
    <br />
    <br />
    
    <form method='post' onsubmit="return false">
        New Username: <input id="username" type="text" name="username"/><br /><br />
        New Password: <input id="password" type="text" name="password"/><br /><br />
        <input class="btn btn-primary" type="submit" value="Change"/>
        <br />
        <span id="error" style="color: red;"></span>
        <br />
    </form>

<?php

    }
    include "inc/footer.php";
    
?>