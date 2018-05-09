<?php

    session_start();

    include "inc/header.php";

?>

<div class="jumbotron">
  <h1>Manga Mart</h1>
  <h2> Home to all your favorites </h2>
</div>

<main id="index">
    
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