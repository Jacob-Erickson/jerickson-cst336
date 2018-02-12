<?php
        
    $suit = array("clubs", "diamonds", "hearts", "spades");
    $number = array("ten", "jack", "queen", "king", "ace");
    
    $computer_card = rand(0,4);
    $human_card = rand(0,4);
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Card Game V2 </title>
        <style type="text/css">
            @import url("styles.css");
        </style>
    </head>
    <body>
        
        <header>
            <h1>
                Card Battle!!!
            </h1>
        </header>
        
        <div id="player">
            <?php
            
                echo "<h2> Computer </h2>";
                echo "<img src='" . $suit[rand(0,3)] . "/" . $number[$computer_card] . ".png' alt='computer's card' />";
            
            ?>
        </div>
        
        <div id="player">
            <?php
            
                echo "<h2> Human </h2>";
                echo "<img src='" . $suit[rand(0,3)] . "/" . $number[$human_card] . ".png' alt='computer's card' />";
            
            ?>
        </div>
        
        <footer>
            
            <?php
            
                if ($computer_card > $human_card)
                {
                    echo "<h2> Computer Wins </h2>";
                }
                else if ($human_card > $computer_card)
                {
                    echo "<h2> Human Wins </h2>";
                }
                else
                {
                    echo "<h2> Tie Game </h2>";
                }
            
            ?>
            
        </footer>

    </body>
</html>