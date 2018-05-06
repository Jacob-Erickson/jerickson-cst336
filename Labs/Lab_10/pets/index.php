<?php

    include "inc/header.php";

?>
        
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="img/carl.jpg" data-slide-to="0" class="active"></li>
        <li data-target="img/charlie.jpg" data-slide-to="1"></li>
        <li data-target="img/sally.jpg" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="img/carl.jpg" alt="First slide">
        </div>
        
        <div class="carousel-item">
            <img class="d-block w-100" src="img/charlie.jpg" alt="Second slide">
        </div>
        
        <div class="carousel-item">
            <img class="d-block w-100" src="img/sally.jpg" alt="Third slide">
        </div>
    </div>
    
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<br />

<a href="pets.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Adopt Now!</a>

<?php

    include "inc/footer.php";

?>