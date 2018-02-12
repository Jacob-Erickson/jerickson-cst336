<!DOCTYPE html>
<html>
    <head>
        <title>
            Random Color
        </title>
        
        <style>
            
            body {
                
                
                <?php
                
                    echo "background-color: rgba(".rand(0,255).", ".rand(0,255).", ".rand(0,255).", ".(rand(0,100) / 100).");";
                
                ?>
                
            }
            
        </style>
    </head>
    <body>
        
        <h1>
            Welcome!
        </h1>
        
        <h2>
            Random Background Color!
        </h2>

    </body>
</html>