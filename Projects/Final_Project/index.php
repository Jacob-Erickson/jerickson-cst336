<?php

    session_start();

    include "inc/header.php";

?>

<div class="jumbotron">
  <h1>Manga Mart</h1>
  <h2> Home to all your favorites </h2>
</div>

<main id="index">
    
    <form onsubmit="return filterCatalog()" id="filter">
        Minimum Price $<input type="number" step=0.01 name="minimum"/>
        <br />
        <br />
        Maximum Price $<input type="number" step=0.01 name="maximum"/>
        <br />
        <br />
        Author: <input type="text" placeholder="first or last name" name="author"/>
        <br />
        <br />
        Demographic: <select id="demographics" name="demographic"></select>
        <div id="demoInfo" style="border-style: solid; border-color: black;">
            hello
        </div>
        <br />
        <br />
        Genre: <select id="genre" name="genre"></select>
        <div id="genreInfo" style="border-style: solid; border-color: black;">
            hello
        </div>
        
        <hr />
        <br />
        
        <input type="submit" value="Filter"/>
    </form>
    
    <h1>Catalog Results For:</h1>
    
    <h2 id='label'>
        No Criteria (Get Everything)
    </h2>
    
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