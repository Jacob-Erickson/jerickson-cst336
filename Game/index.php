<!DOCTYPE html>
<html>
    <head>
        <style type="text/css">
            @import url("styles.css");
        </style>
        <title> RPG </title>
        <script type="text/javascript" src="characters.js"></script>
        <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
        <script>
        
            $(document).ready( function (){
                $("#player").html("<p>" + player + "</p>");
            });
        </script>
    </head>
    <body>
        
        <div id="enemy">
            
        </div>
        
        <div id="ally">
            <div id="player">
                <p>Name</p>
            </div>
        </div>

    </body>
</html>
<!--
stats:
health points
skill points
strength
vitality
inteligence
faith
agility
?disease/rot
luck
-->