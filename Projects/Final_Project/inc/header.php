<?php

    include("funcs/phpFunctions.php");
    
    if(isset($_POST['logger']))
    {
        unset($_SESSION['user']);
    }
    
    if(!isset($_SESSION['cart']))
    {
        $_SESSION['cart'] = array();
    }
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title> CSUMB: Pet Shelter </title>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    	<script type="text/javascript" src="funcs/javascriptFunctions.js"></script>
    	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>   
        <style>
            @import url("styles.css");
        </style>
<script>

    $(document).ready(function(){//start document ready
        
        docReady();
        
    });//end document ready

</script>

    </head>
    <body>
        
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">Manga Mart</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li id="home" class="nav-item">
                        <a id="homeLink" class="nav-link" href="index.php">Home <span class="sr-only"></span></a>
                    </li>
                    <?php
                            
                        if(!isset($_SESSION['user']))
                        {
                            echo '<li id="adopt" class="nav-item">';
                            echo '<a id="adoptLink" class="nav-link" href="scart.php">Cart </a>';
                            echo '</li>';
                        }
                            
                    ?>
                    <li id="about" class="nav-item">
                        <a id="aboutLink" class="nav-link" href="about.php">About Us</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="adminLink" class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style='z-index: -1;'>
                            Admin
                        </a>
                        <div class="dropdown-menu pull-left" aria-labelledby="navbarDropdownMenuLink">
                            <?php
                            
                                if(isset($_SESSION['user']))
                                {
                                    echo '<a id="userLink" class="dropdown-item" href="user.php">User</a>';
                                    echo '<hr />';
                                    echo '<a id="addLink" class="dropdown-item" href="add.php">Add</a>';
                                    echo '<a id="updateLink" class="dropdown-item" href="update.php">Update</a>';
                                    echo '<a id="deleteLink" class="dropdown-item" href="delete.php">Delete</a>';
                                    echo '<a id="statsLink" class="dropdown-item" href="stats.php">Statistics</a>';
                                }
                                else
                                {
                                    echo '<a id="log_in" class="dropdown-item" href="#">Log In</a>';
                                }
                            
                            ?>

                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        
        <div class="jumbotron">
          <h1>Manga Mart</h1>
          <h2> Home to all your favorites </h2>
        </div>
        
        
        <!-- Modal -->
        <div class="modal fade" id="logInModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <strong><h2 class="modal-title" id="modalLabel">Log In</h2></strong>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="modalMain">
                            <form method='post' onsubmit="return logIn()">
                                Username: <input id="username" type="text" name="username"/><br /><br />
                                Password: <input id="password" type="text" name="password"/><br /><br />
                                <input class="btn btn-primary" type="submit" value="Log In"/>
                                <br />
                                <span id="error" style="color: red;"></span>
                                <br />
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
