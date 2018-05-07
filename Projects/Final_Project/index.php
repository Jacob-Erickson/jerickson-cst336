<?php  

    include "inc/header.php";

?>
<!--
<!DOCTYPE html>
<html>
        <head>
        <title> Manga Mart </title>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
        <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' integrity='sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa' crossorigin='anonymous'></script>
        <link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u' crossorigin='anonymous'>
        <style type='text/css'>
            @import url('styles.css');
        </style>
        <script>
        
        function login()
        {
            $.ajax({
            
                type: "POST",
                url: "loginProcessAPI.php",
                dataType: "JSON",
                data: { "username": $("#username").val(),
                        "password": $("#password").val()},
                success: function(data,status) {
                alert(data);
                alert("<?//php echo $_SESSION['user'];?>");
                },
                complete: function(data,status) { //optional, used for debugging purposes
                //alert(status);
                }
                
            });//ajax
            alert("hello");
            
            return true;
        }
        </script>
        </head>
    <body>

        <header style="width: 100%;">
        <nav class='navbar navbar-default - navbar-fixed-top'>
        <div class='navbar-header'>
            <a class='navbar-brand' href='index.php'>Manga Mart - All your favortie manga in one place</a>
        </div>
        <ul class='nav navbar-nav' style="float: right;">
        <li>
            
        </li>
        <li>
            <div class="dropdown" style='margin-top: 7%; margin-bottom: 7%; margin-right: 50%; border-radius: 3px;'>
                <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">
                    <strong>MENU</strong> <i class="glyphicon glyphicon-th-list"></i>
                </button>
                <ul class="dropdown-menu" role="menu" aria-labelledby="menu1" style="float: left;">
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="index.php">Browse</a></li>
                    <li role="presentation" class="divider"></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="?page=admin">Admin</a></li>
                </ul>
            </div>
        </li>
        </ul>
        </nav>
        </header>
-->
        <main>
            
            <form>
                <span>Minimum Price</span><input type="text" name="minimum"/>
                <span>Maximum Price</span><input type="text" name="maximum"/>
                <br />
                <span>Author</span><input type="text" name="author"/>
                <br />
                <span>Demographic</span><select id="demographics" name="demographic"></select>
                <div id="demoInfo" style="border-style: solid; border-color: black;">
                    hello
                </div>
                <span>Genre</span><select id="genre" name="genre"></select>
                <div id="genreInfo" style="border-style: solid; border-color: black;">
                    hello
                </div>
                
                <input type="submit" value="Filter"/>
            </form>
        
        
            <h1>Catalog</h1>
            
            <div id="fullCatalog"></div>
            
        </main>
       
        <?php
        
            include "inc/footer.php";
            
        ?>
<!--

                            <a href='scart.php'>
                                <span class='glyphicon glyphicon-shopping-cart' aria-hidden='true'>
                                </span>
                            Cart <?//php displayCartCount(); ?>
                            </a>
                            
                            -->