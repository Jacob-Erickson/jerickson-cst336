<?php

    include("manga.php");
    $has_genre = false;
    $criteria = array();
    $results = array();
    
    function home_button()
    {
        echo "<div id='home'>";
        
        echo "<a href='index.php' id='home_link'>";
        
        echo "<div>";
        
        echo "Return to Main Page";
        
        echo "</div>";
        
        echo "</a>";
        
        echo "</div>";
    }
    
    function previous_page_button()
    {
        echo "<div id='previous'>";
        echo "<form>";
        echo "<input type='hidden' name='selection' value='" . $_GET['selection'] . "'/>";
        echo "<button name='page' value=" . ($_GET['page'] - 1) . ">";
        echo "Previous Page";
        echo "</button></form>";
        echo "</div>";
    }
    
    function next_page_function()
    {
        echo "<div id='next'>";
        echo "<form>";
        echo "<input type='hidden' name='selection' value='" . $_GET['selection'] . "'/>";
        echo "<button type='submit' name='page' value=" . ($_GET['page'] + 1) . ">";
        echo "Next Page";
        echo "</button></form>";
        echo "</div>";
    }
    
    function manga_navigation()
    {
        echo "<div id='navigation'>";
        
        if($_GET['page'] != 1)
        {
            previous_page_button();
        }
        
        home_button();
        
        if($_GET['page'] != 10)
        {
            next_page_function();
        }
        
        echo "</div>";
    }
    
    function get_results($array)
    {
        global $results;
        
        echo "<form>";
        
        echo "<input type='hidden' name='page' value=1></input>";
        
        foreach($results as $value)
        {
            echo "<button name='selection' value='" . $value . "' id='available' type='submit'>";
            echo "<h3>" . $value . "</h3>";
            echo "<strong> Genres: </strong><br />";
            for ($i = 2; $i < count($array[$value]); $i++)
            {
                echo $array[$value][$i];
                if($i != (count($array[$value]) - 1))
                {
                    echo ", ";
                }
            }
            echo "<br /><br /> <strong> Description: </strong> <br />";
            echo $array[$value][1];
            echo "<br /><br />";
            echo "</button>";
        }
        
        echo "</form>";
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <?php
        
            if(!isset($_GET['selection']))
            {
                echo "<title> Manga Previewer </title>";
            }
            else
            {
                echo "<title> Preview of \"" . $_GET['selection'] . "\" </title>";
            }
        
        ?>
        <style type="text/css">
            @import url(styles.css);
        </style>
    </head>
    <body>
        
        <?php
        
            if(!isset($_GET['selection']))
            {
        ?>
        
        <header>
        
            <h1>Let's Preview some Manga!!!</h1>
            
            <h2>To begin please enter the following demographic information:</h2>
        
        </header>
        
        <div id="demographics">
            
            <span class='error'> * required field </span>
            
            <form>
                
                <div id="top">
                <fieldset id="gender">
                    <legend> <strong> Gender Oriented Towards: </strong> </legend>
                    
                    <?php
                    
                        if(!isset($_GET['gender']))
                        {
                            echo "<span class='error'>";
                            echo "*A gender is required";
                            echo "</span><br />";
                        }
                    
                    ?>
                    
                    <br />
                    
                    <input type="radio" name="gender" value="Male" <?php if($_GET['gender'] == "Male"){echo "checked";}?>/>
                    <label for="Male"> Male </label>
                    
                    <input type="radio" name="gender" value="Female"<?php if($_GET['gender'] == "Female"){echo "checked";}?>/>
                    <label for="Female"> Female </label> <br/>
                
                </fieldset>
                
                <fieldset id="age">
                    <legend> <strong>Age Range Oriented Towards:</strong> </legend>
                    <select name="age_range">
                        
                        <option value="Under" <?php if($_GET['age_range'] == "Under"){echo "selected";}?>> Under 20 Years Old </option>
                        <option value="Over" <?php if($_GET['age_range'] == "Over"){echo "selected";}?>> Over 20 Years Old </option>
                        
                    </select>
                </fieldset>
                
                <fieldset id="genres">
                    <legend> <strong>Here are the genres to choose from:</strong> </legend>
                    
                    <?php
                        
                        $error = true;
                        
                        foreach ($genres as $value) {
                            
                            if($_GET[$value] == "on")
                            {
                                $error = false;
                            }
                        }
                        
                        if($error)
                        {
                            echo "<span class='error'>";
                            echo "*At least one genre must be selected";
                            echo "</span><br />";
                        }
                        
                    ?>
                    
                    <br />
                    
                    <?php
                        
                        foreach ($genres as $value) {
                            
                            echo '<input type="checkbox" name="' . $value . '" ';
                            if($_GET[$value] == "on")
                            {
                                echo "checked";
                                $has_genre = true;
                                $criteria[] = $value;
                            }
                            echo ' />';
                            echo '<label for="' . $value . '"> ' . $value . '<label><br />';
                        }
                        
                    ?>
                </fieldset>
                
                </div>
                
                <div id="bottom">
                    
                <input id="demo_button" type="submit" value="Submit Demographic Criteria"/>
                
                </div>
                
            </form>
            
        </div>
        
        <br /><br />
            
            <?php
            
                if(isset($_GET['gender']) and $has_genre)
                {
                    echo "<div id='results'>";
                    echo "<h2> Here are the results for manga oriented towards";
                    echo $_GET['gender'];
                    echo "s that are ";
                    echo $_GET['age_range'];
                    echo " 20 years old and with the following genres: ";
            
                    for ($i = 0; $i < count($criteria); $i++)
                    {
                        echo $criteria[$i];
                        if($i != (count($criteria) - 1))
                        {
                            echo " & ";
                        }
                    }
            
                    echo "</h2>";
            
                    echo "<h3>*Clicking on one of the below manga will allow you to preview the fist 10 pages of the manga </h3>";
                    
                    
                    if($_GET['gender'] == "Male")
                    {
                        if($_GET['age_range'] == "Under")
                        {
                            foreach ($shounen_manga as $name => $info) {
                                if($criteria == array_intersect($criteria, $info))
                                {
                                    $results[] = $name;
                                }
                            }
                            get_results($shounen_manga);
                        }
                        else
                        {
                            foreach ($seinen_manga as $name => $info) {
                                if($criteria == array_intersect($criteria, $info))
                                {
                                    $results[] = $name;
                                }
                            }
                            get_results($seinen_manga);
                        }
                    }
                    else 
                    {
                        if($_GET['age_range'] == "Under")
                        {
                            foreach ($shoujo_manga as $name => $info) {
                                if($criteria == array_intersect($criteria, $info))
                                {
                                    $results[] = $name;
                                }
                            }
                            get_results($shoujo_manga);
                        }
                        else
                        {
                            foreach ($josei_manga as $name => $info) {
                                if($criteria == array_intersect($criteria, $info))
                                {
                                    $results[] = $name;
                                }
                            }
                            get_results($josei_manga);
                        }
                    }
                    echo "</div>";
                }
            }
            else {
                
                echo "<br />";
                
                echo "<div id='reader'>";
                
                manga_navigation();
                
                echo "<br /><br />";
                
                echo "<p>";
                echo "Read right to left";
                echo "<br />";
                echo "<= <= <= <= <= <=";
                echo "</p>";
                
                $image_link = "manga/" . $_GET['selection'] . "/" . $_GET['page'] . ".";
                
                if(file_exists($image_link . "jpg"))
                {
                    $image_link = $image_link . "jpg";
                }
                else
                {
                    $image_link = $image_link . "png";
                }
                
                echo "<img id='current' src='" . $image_link;
                echo "'>";
                
                echo "<br /><br />";
                
                manga_navigation();
                
                echo "</div>";
                
                echo "<br />";
            }
        ?>
        
        <footer>
            <hr>
            <hr>
            <p>
                This website was created for educational purposes only. No authorship is claimed for any of the content found within.
            </p>
            <div id="include">
                <img src="CSUMB_Logo.png" alt="picture of CSUMB logo" />
            </div>
        </footer>

    </body>
</html>