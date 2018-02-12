

<!DOCTYPE html>
<html>
    <head>
        <title> Card Game </title>
        
        <?php
        
            $suit = rand(1,4);
            $value = rand(1,5);
            
            
        
        ?>
        
        <style>
            
            main {
                display: inline-block;
            }
            
        </style>
        
        
    </head>
    <body>
        
        <main>
            
             <?php
        
            echo "<h3> Human </h3>";
            
            $suit = rand(1,4);
            $value = rand(1,5);
            switch($suit) {
            case 1:
                switch($value) {
                case 1:
                    echo "<img src=\"clubs/ten.png\" />;";
                    break;
                case 2:
                    echo"<img src=\"clubs/jack.png\" />";
                    break;
                case 3:
                    echo"<img src=\"clubs/queen.png\" />";
                    break;
                case 4:
                    echo"<img src=\"clubs/king.png\" />";
                    break;
                case 5:
                    echo"<img src=\"clubs/ace.png\" />";
                    break;
                }
                break;
            case 2:
                switch($value) {
                case 1:
                    echo "<img src=\"diamonds/ten.png\" />";
                    break;
                case 2:
                    echo"<img src=\"diamonds/jack.png\" />";
                    break;
                case 3:
                    echo"<img src=\"diamonds/queen.png\" />";
                    break;
                case 4:
                    echo"<img src=\"diamonds/king.png\" />";
                    break;
                case 5:
                    echo"<img src=\"diamonds/ace.png\" />";
                    break;
                }
                break;
            case 3:
                switch($value) {
                case 1:
                    echo "<img src=\"hearts/ten.png\" />";
                    break;
                case 2:
                    echo"<img src=\"hearts/jack.png\" />";
                    break;
                case 3:
                    echo"<img src=\"hearts/queen.png\" />";
                    break;
                case 4:
                    echo"<img src=\"hearts/king.png\" />";
                    break;
                case 5:
                    echo"<img src=\"hearts/ace.png\" />";
                    break;
                }
                break;
            case 4:
                switch($value) {
                case 1:
                    echo "<img src=\"spades/ten.png\" />";
                    break;
                case 2:
                    echo"<img src=\"spades/jack.png\" />";
                    break;
                case 3:
                    echo"<img src=\"spades/queen.png\" />";
                    break;
                case 4:
                    echo"<img src=\"spades/king.png\" />";
                    break;
                case 5:
                    echo"<img src=\"spades/ace.png\" />";
                    break;
                }
                break;
            }
            
            echo "<br />";
            
            echo "<h3> Computer </h3>";
            
             
            $computer_suit = rand(1,4);
            $computer_value = rand(1,5);
            switch($computer_suit) {
            case 1:
                switch($computer_value) {
                case 1:
                    echo "<img src=\"clubs/ten.png\" />;";
                    break;
                case 2:
                    echo"<img src=\"clubs/jack.png\" />";
                    break;
                case 3:
                    echo"<img src=\"clubs/queen.png\" />";
                    break;
                case 4:
                    echo"<img src=\"clubs/king.png\" />";
                    break;
                case 5:
                    echo"<img src=\"clubs/ace.png\" />";
                    break;
                }
                break;
            case 2:
                switch($computer_value) {
                case 1:
                    echo "<img src=\"diamonds/ten.png\" />";
                    break;
                case 2:
                    echo"<img src=\"diamonds/jack.png\" />";
                    break;
                case 3:
                    echo"<img src=\"diamonds/queen.png\" />";
                    break;
                case 4:
                    echo"<img src=\"diamonds/king.png\" />";
                    break;
                case 5:
                    echo"<img src=\"diamonds/ace.png\" />";
                    break;
                }
                break;
            case 3:
                switch($computer_value) {
                case 1:
                    echo "<img src=\"hearts/ten.png\" />";
                    break;
                case 2:
                    echo"<img src=\"hearts/jack.png\" />";
                    break;
                case 3:
                    echo"<img src=\"hearts/queen.png\" />";
                    break;
                case 4:
                    echo"<img src=\"hearts/king.png\" />";
                    break;
                case 5:
                    echo"<img src=\"hearts/ace.png\" />";
                    break;
                }
                break;
            case 4:
                switch($computer_value) {
                case 1:
                    echo "<img src=\"spades/ten.png\" />";
                    break;
                case 2:
                    echo"<img src=\"spades/jack.png\" />";
                    break;
                case 3:
                    echo"<img src=\"spades/queen.png\" />";
                    break;
                case 4:
                    echo"<img src=\"spades/king.png\" />";
                    break;
                case 5:
                    echo"<img src=\"spades/ace.png\" />";
                    break;
                }
                break;
            }
            if(value>computer_value) {
                echo "<h3> Human Wins</h3>";
                
            }else if (computer_value > value) {
                echo"<h3> Computer Wins</h3>";
            }else {
                echo"<h3>Tie Game</h3>";
            }
        ?>
        
            <div>
                <h3></h3>
            </div>
            
        </main>

    </body>
</html>