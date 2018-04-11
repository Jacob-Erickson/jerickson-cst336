<?php

    session_start();
    
    if(!isset($_SESSION['correct']))
    {
        $_SESSION['correct'] = rand(1, 10);
    }
    
    if(!isset($_SESSION['guesses']))
    {
        $_SESSION['guesses'] = array();
    }
    
     if(!isset($_SESSION['count']))
    {
        $_SESSION['count'] = 1;
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <title> Guessing game </title>
    </head>
    <body>
        
        <?php echo $_SESSION['correct']; ?>
        
        <form>
            Guess The Number <input type="text" name="your_guess"/>
            <br />
            <input type="submit" value="Guess Number"/>
        </form>
        
        <br />
        
        <form>
            <input type="hidden" name="give_up" value="true"/>
            <input type="submit" value="Give Up"/>
        </form>
        
        <form>
            <input type="hidden" name="play_again" value="true"/>
            <input type="submit" value="Play Again"/>
        </form>
        
        <?php
        
            echo "Number of tries: " . $_SESSION['count'] . "<br />";
        
            
            if(isset($_GET['your_guess']))
            {
                if($_GET['your_guess'] == $_SESSION['correct']){
                    echo "Congrats!";
                    array_push($_SESSION['guesses'], ("you guessed the number " . $_SESSION['correct'] . " In " . $_SESSION['count'] . " Attempts"));
                
                }
                else if($_GET['your_guess'] == null)
                {
                    echo "Improper Input!!!";
                }
                else if ($_GET["your_guess"] < $_SESSION['correct']) {
                    echo "Your number was too low";
                    $_SESSION['count']++;
                }
                else if ($_GET['your_guess'] > $_SESSION['correct'])
                {
                    echo "your guess was too high";
                    $_SESSION['count']++;
                }
                
            }
            else
            {
            
                if(isset($_GET['give_up'])){
                    array_push($_SESSION['guesses'], ("You gave up after " . $_SESSION['count'] . " guesses."));
                    $_SESSION['correct'] = rand(1, 10);
                    $_SESSION['count'] = 1;
                    
                    echo "New number has been chosen";
                }
                
                if(isset($_GET['play_again']))
                {
                    $_GET['play_again'] = null;
                    $_SESSION['correct'] = rand(1, 10);
                    $_SESSION['count'] = 1;
                    
                    echo "New number has been chosen";
                }
            }
            echo "<br /><br />guess history:  <br/>";
            
            foreach($_SESSION['guesses'] as $value){
                echo $value;
                echo "<br />";
            }
        
        ?>
        
        
    </body>
</html>