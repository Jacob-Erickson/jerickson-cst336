<?php

    $backgroundImage = "img/sea.jpg";
    
    // API here
    if (isset($_GET['keyword']) && !($_GET['keyword'] == ""))
    {
        include 'api/pixabayAPI.php';
        echo "You searched for: " . $_GET['keyword'];
        $imageURLs = getImageURLs($_GET['keyword'], $_GET['layout']);
        $backgroundImage = $imageURLs[array_rand($imageURLs)];
    }
    elseif (isset($_GET['category']) && !($_GET['category'] == ""))
    {
        include 'api/pixabayAPI.php';
        echo "You searched for: " . $_GET['category'];
        $imageURLs = getImageURLs($_GET['category'], $_GET['layout']);
        $backgroundImage = $imageURLs[array_rand($imageURLs)];
    }
    else
    {
        
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Image Carousel </title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
        <style>
            @import url("css/styles.css");
            body {
                background-image: url('<?=$backgroundImage ?>');
            }
        </style>
    </head>
    <body>
        <br /> <br />
        <?php
        
            if (!isset($imageURLs))
            {
                echo "<h2> Type a keyword to display a slideshow <br /> with random images from Pixabay.com </h2>";
            }
            elseif (($_GET['keyword'] == "") && ($_GET['category'] == ""))
            {
                echo "<h2> You must type a keyword or select a category to display a slideshow <br /> with random images from Pixabay.com </h2>";
            }
            else 
            {
                
        ?>
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicators Here -->
            <ol class="carousel-indicators">
                
                <?php //still in else statement
                
                    for ($i = 0; $i < 7; $i++)
                    {
                        echo "<li data-target='#carousel-example-generic' data-slide-to='$i'";
                        echo ($i == 0)? " class='active'":"";
                        echo "></li>";
                    }
                    
                    /*
                    echo "<li data-target='#carousel-example-generic' data-slide-to='0' class='active'></li>";
                    echo "<li data-target='#carousel-example-generic' data-slide-to='1'></li>";
                    echo "<li data-target='#carousel-example-generic' data-slide-to='2'></li>";
                    echo "<li data-target='#carousel-example-generic' data-slide-to='3'></li>";
                    echo "<li data-target='#carousel-example-generic' data-slide-to='4'></li>";
                    echo "<li data-target='#carousel-example-generic' data-slide-to='5'></li>";
                    echo "<li data-target='#carousel-example-generic' data-slide-to='6'></li>";
                    
                    for ($i = 1; $i < 7; $i++)
                    {
                         echo "<li data-target='#carousel-example-generic' data-slide-to='$i'></li>";
                    }*/
                
                ?>
                
            </ol>
            
            <!--Wrapper for Images -->
            <div class="carousel-inner" role="listbox">
                
                <?php //still in else statement
                    
                    for ($i = 0; $i < 7; $i++)
                    {
                        $randomIndex = rand(0, count($imageURLs) - 1);
                    
                        echo '<div class="item';
                        echo ($i == 0)? ' active': '';
                        echo '"><img src="' . $imageURLs[$randomIndex] . '">';
                        echo '</div>';
                            
                        unset($imageURLs[$randomIndex]);
                    
                    }
                    
                    /*for ($i = 1; $i < 7; $i++) 
                    {
                        do 
                        {
                            $randomIndex = rand(0, count($imageURLs) - 1);
                        }
                        while (!isset($imageURLs[$randomIndex]));
                        
                        echo '<div class="item">';
                        echo '<img src="' . $imageURLs[$randomIndex] . '">';
                        echo '</div>';
                        
                        unset($imageURLs[$randomIndex]);
                    }*/
                    
                ?>
                    
            </div>
           
            <!-- Controls Here -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
          
        </div>
        
        <?php
        
            }//end of else
        
        ?>
        
        <br>
        
        <form>
            <input type="text" name="keyword" placeholder="Keyword" value="<?=$_GET['keyword']?>" />
            <input type="radio" id="lhorizontal" name="layout" value="horizontal">
            <label for="Horizontal"></label><label for="lhorizontal"> Horizontal </label>
            <input type="radio" id="lvertical" name="layout" value="vertical">
            <label for="Vertical"></label><label for="lvertical"> Vertical </label>
            <select name="category">
                <option value="">Select One</option>
                <option value="ocean">Sea</option>
                <option>Forest</option>
                <option>Mountain</option>
                <option>Snow</option>
            </select>
            <input type="submit" value="Submit" />
        </form>
        <br /> <br />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>