<?php

    include 'vocab.php';

?>
<!DOCTYPE html>
<html>
    <head>
        <title> Vocab Trainer - Initial Test!!!</title>
        <style type="text/css">
            @import url("styles.css");
        </style>
    </head>
    
    <body>
        
        <?php
            
            start_cards('initial');
            
        ?>
        
        
        <a href="style_test.php">
            <div id="start_button" onClick="style_test.php">
                <strong>
                    Lets Take That Quiz!!!
                </strong>
            </div>
        </a>
        

    </body>
</html>