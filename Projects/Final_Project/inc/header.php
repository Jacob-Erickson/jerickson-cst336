<?php

    session_start();

    include("funcs/phpFunctions.php");
    
    if(isset($_POST['logger']))
    {
        unset($_SESSION['user']);
    }
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title> CSUMB: Pet Shelter </title>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>   
        <style>
            @import url("styles.css");
        </style>
<script>

    $(document).ready(function(){//start document ready
        
        var current = window.location.href.split('/').pop();
        
        
            if(current == $("#homeLink").attr('href'))
            {
                $("#home").addClass("active");
            }
            else if(current == $("#adoptLink").attr('href'))
            {
                $("#adopt").addClass("active");
            }
            else if(current == $("#aboutLink").attr('href'))
            {
                $("#about").addClass("active");
            }
        /*
        $(".petLink").click(function(){//start link
        
            $('#petModal').modal("show");
            $("#petInfo").html("<img src='img/loading.gif' />");
                
            $.ajax({//start ajax
                type: "GET",
                url: "api/getPetInfo.php",
                dataType: "JSON",
                data: { "id": $(this).attr("id") },
                success: function(data,status) {
                    
                    $("#petModalLabel").html(data.name);
                    $("#petInfo").html("<img src='img/" + data.pictureURL + "' style='float: left;' />");
                    $("#petInfo").append("<h5 style='text-align: left;'><strong>Age: </strong>" + data.age + "</h5><hr />");
                    $("#petInfo").append("<h5 style='text-align: left;'><strong>Breed:</strong><br />" + data.breed + "</h5><hr />");
                    $("#petInfo").append("<h5 style='text-align: left;'><strong>About Me:</strong><br />" + data.description + "<br />");
                    
                },
                complete: function(data,status) { //optional, used for debugging purposes
                    //alert(status);
                }
            
            });//end ajax
           
        });//end link
        */
    });//end document ready

</script>

    </head>
    <body>
        
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="http://csumb.edu">Manga Mart</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li id="home" class="nav-item">
                        <a id="homeLink" class="nav-link" href="index.php">Home <span class="sr-only"></span></a>
                    </li>
                    <li id="adopt" class="nav-item">
                        <a id="adoptLink" class="nav-link" href="pets.php">Adoption</a>
                    </li>
                    <li id="about" class="nav-item">
                        <a id="aboutLink" class="nav-link" href="about.php">About Us</a>
                    </li>
                    <li class="">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style='z-index: -1;'>
                            Admin
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <?php
                            
                                if(!isset($_SESSION['user']))
                                {
                                    echo '<a class="dropdown-item" href="#">User</a>';
                                    echo '<hr />';
                                    echo '<a class="dropdown-item" href="#">Add</a>';
                                    echo '<a class="dropdown-item" href="#">Update</a>';
                                    echo '<a class="dropdown-item" href="#">Delete</a>';
                                    echo '<a class="dropdown-item" href="#">Statistics</a>';
                                }
                                else
                                {
                                    echo '<a class="dropdown-item" href="#">Log In</a>';
                                }
                            
                            ?>

                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        
        <div class="jumbotron">
          <h1> CSUMB Animal Shelter</h1>
          <h2> The "official" animal adoption website of CSUMB </h2>
        </div>