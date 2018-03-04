<?php

    include ('functions.php');
    $start = microtime(true);
    $deck = array(
        array("value", "suit", "img tag")
        );
    $suits = array('clubs', 'diamonds', 'hearts', 'spades');
    
    $players = array(
        'player 1' => array(),
        'player 2' => array(),
        'player 3' => array(),
        'player 4' => array()
        );
    
    foreach ($suits as $value)
    {
        for ($i = 1; $i <= 13; $i++)
        {
            $deck[] = array($i, $value, ("<img src='cards/" . $value . "/" . $i . ".png' />"));
        }
    }
    
    draw_hands($deck, $players);

?>

<!DOCTYPE html>
<html>
    <head>
        <title> SilverJack </title>
        <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    </head>
    <body>
        
        <style>
            @import url("styles.css");    
        </style>
        
        <header>
            <font size = "8"><h1>Silverjack</h1></font>
            
        </header>
        
        <?php
        
         /*Demonstrate Draw card
            echo "<div>";
            
            for($i = 0; $i < 52; $i++)
            {
                $card = draw_card($deck);
                echo "<b>" . $card[0] . " of " . $card[1] . "</b><br/>";
                echo $card[2];
                echo "<br />";
            }
            
            echo "</div>";
            
            echo "<p>" . draw_card($deck) . "</p>";
            echo "<p>" . draw_card($deck) . "</p>";
        */    
        
        
        ?>
        
        <?php
        
            get_winner($players);
        
        ?>
        <div>
        
       <h2><a href="index.php">Play again?</a></h2>
        </div>
        <div id = "elapsedTime">
            Elapsed Time: <?= displayElapsedTime($start) ?>
        </div>
        
            <footer>
                <hr>
                CST336 Internet Programming. 2018 &copy; Team 8 <br />
                <strong> Disclaimer:</strong>
                The information in this website is fictitous. It's used for academic purposes.
                    
                <figure>
                        
                     <img id = "logo" src = "csumbLogo/csumbLogo.png" alt = "csumb logo" />
                        
                </figure>
            </footer>

    </body>
</html>