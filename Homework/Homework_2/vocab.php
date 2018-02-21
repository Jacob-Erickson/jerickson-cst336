<?php

$words = array
(
    $duck = array("duck", "<img src='img/duck.jpg' />", "gato"),
    $cat = array("cat", "<img src='img/cat.png' />", "pato"),
    $turtle = array("turtle", "<img src='img/turtle.png' />", "tortuga"),
    $chest = array("chest", "<img src='img/chest.jpg' />", "cofre"),
    $honey = array("honey", "<img src='img/honey.png' />", "miel"),
    $frog = array("frog", "<img src='img/frog.jpg' />", "rana"),
    $bee = array("bee", "<img src='img/bee.jpg' />", "abeja"),
    $rabbit = array("rabbit", "<img src='img/rabbit.png' />", "conejo"),
    $sand = array("sand", "<img src='img/sand.jpg' />", "arena"),
    $turkey = array("turkey", "<img src='img/turkey.jpg' />", "pavo"),
    $leaf = array("leaf", "<img src='img/leaf.png' />", "hoja"),
    $table = array("table", "<img src='img/table.png' />", "mesa"),
    $beach = array("beach", "<img src='img/beach.jpg' />", "playa"),
    $shower = array("shower", "<img src='img/shower.jpg' />", "ducha"),
    $candy = array("candy", "<img src='img/candy.jpg' />", "dulce"),
    $fish = array("fish", "<img src='img/fish.jpg' />", "pescado"),
    $bear = array("bear", "<img src='img/bear.jpg' />", "oso"),
    $necktie = array("necktie", "<img src='img/necktie.jpg' />", "corbata"),
    $cloud = array("cloud", "<img src='img/cloud.jpg' />", "nube"),
    $chair = array("chair", "<img src='img/chair.png' />", "silla"),
    $cow = array("cow", "<img src='img/cow.png' />", "vaca"),
    $suit = array("suit", "<img src='img/suit' />", "traje"),
    $fork = array("fork", "<img src='img/fork.jpg' />", "tenedor"),
    $sheep = array("sheep", "<img src='img/sheep.jpg' />", "oveja"),
    $raisin = array("raisin", "<img src='img/raisin.jpg' />", "pasa")
    
);

    function start_cards($page)
    {
        global $words;
        
        for ($i = 0; $i < 10; $i++)
        {
            echo "<div id='card'>";
            
            if (($i + 1) % 2 == 0) {
                echo $words[$i][1];
                echo "<br /><strong>" . $words[$i][2] . "</strong></div>";
            }
            else {
                echo "<strong>" . $words[$i][0] . " = " . $words[$i][2] . "</strong></div>";
            }
            
            echo "</div>";
            
            echo "<br />";
        }
    }
    
    function check_quiz($code)
    {
        global $words;
        $scores = array('visual' => 0, 'written' => 0);
        
        if ($code == 1)
        {
            for($i = 0; $i < 10; $i = $i + 2)
            {
                if ($_GET[$words[$i][0]] == $words[$i][0])
                {
                    $scores['written']++;
                }
            }
            
            for($i = 1; $i < 10; $i = $i + 2)
            {
                if ($_GET[$words[$i][0]] == $words[$i][0])
                {
                    $scores['visual']++;
                }
            }
        }
        
        echo "Your Score was: " . ($scores['visual'] . $score['written']);
        
    }
    
    /*function start_quiz($code)
    {
        global $words;
        
        $quiz_1 = array('', '', '', '', '', '', '', '', '', '');
        $quiz_2 = array('', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
        
        echo "alpha";
        
        if ($code == 1)
        {
        echo "beta";
            $cont = 0;
            while ($cont < 2)
            {
        echo "gamma";
                $index = rand(0,9);
                if ($quiz_1[$index] != '')
                {
                    $quiz_1[$index] = array(
                        ("<strong> " . $words[$index][2] . "</strong>"),
                        ("<input type='text' name='" . $words[$index][0] . "'/>"),
                        "<br />",
                        "<br />"
                        );
                    $cont++;
                }
                
            }
        }
        else
        {
            $cont = 0;
            while ($cont < 15)
            {
                $index = rand(10,24);
                if ($quiz_1[$index] != '')
                {
                    $quiz_1[$index] = "<strong> " . $words[$index][2] . "</strong> <input type='text' name='" . $words[$index][0] . "'/><br /><br />";
                    $cont++;
                }
                
            }
        }
        
        if ($code == 1)
        {
            foreach ($quiz_1 as $item)
            {
                echo $item[0];
                echo $item[1];
                echo $item[2];
                echo $item[3];
            }
        }
        else
        {
            foreach ($quiz_2 as $item)
            {
                echo $item;
            }
        }
        
    }*/
    
?>