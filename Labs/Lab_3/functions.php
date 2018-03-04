<?php

    function displayElapsedTime($starting_microtime)
    {
        $elapsedSecs = microtime(true) - $starting_microtime;
        echo $elapsedSecs . " seconds";
    }
    
    function draw_card(&$deck)
    {
        if(count($deck) > 1)
        {
            $index = rand(1, (count($deck) - 1));
            $card = $deck[$index];
            unset($deck[$index]);
            $deck = array_values(array_filter($deck));
        }
        else 
        {
            $card = "No more cards in the deck";
        }
        
        return($card);
        
    }
    
    function draw_hands(&$deck, &$players)
    {
        foreach($players as $key => $value) {
            
            $handvalue = 0;
            while($handvalue <= 35) {
                $card = draw_card($deck);
                $players[$key][] = $card;
                $handvalue += $card[0];
                
            }
        }
    }
    
    function get_winner(&$player)
    {
        $winnerpoint=0;
        $howmuchpoint=0;
        $winner = '';
        $names = array('<strong>Alex</strong>', '<strong>Casey</strong>', '<strong>Dylan</strong>', '<strong>Jordan</strong>');
        $faces = array(
            '<img src="faces/alpha.jpg" id="profile">',
            '<img src="faces/beta.jpg" id="profile">',
            '<img src="faces/gamma.jpg" id="profile">',
            '<img src="faces/omega.jpg" id="profile">'
            );
        $aliases = array();
        
        foreach ($player as $currplay => $currhand)
        {
            $cpt=0;
            
            $f_num = rand(0, count($faces) - 1);
            $n_num = rand(0, count($names) - 1);
            $aliases[$currplay] = array($names[$n_num], $faces[$f_num]);
            unset($names[$n_num]);
            unset($faces[$f_num]);
            $faces = array_values(array_filter($faces));
            $names = array_values(array_filter($names));
            
            echo "<div>";
            echo $aliases[$currplay][0];
            echo $aliases[$currplay][1];
            
            foreach($currhand as $currcard)
            {  
                $cpt = $cpt + $currcard[0];
                echo $currcard[2];
            }
            
            echo "score: " . $cpt;
            echo "</div> <br />";
            
            if($cpt>$winnerpoint && $cpt<=42)
            {
                $winnerpoint = $cpt;
                $winner = $currplay;
            }
            
            $howmuchpoint = $howmuchpoint + $cpt;
        }
        
        echo "<br/> <div>";
        echo $aliases[$winner][0];
        echo $aliases[$winner][1];
        echo " Wins! They earned " . ($howmuchpoint - $winnerpoint) . " points!!! </div>";
        
    }

?>