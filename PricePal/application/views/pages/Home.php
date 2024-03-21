<div class="container">
    <div id="itemgrid" class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-2">
        <?php for ($i = 0; $i < 8; $i++) {

            echo $document;
            echo '<div class="col-md-3 card-item">
            <div class="card-sl">
                <div class="container d-flex justify-content-center card-image">
                    <img src="https://singerwebcdn.azureedge.net/resources/products/thumbnails/HON-X7B-8-256-SIL-01.webp"/>
                </div>
                <div class="card-heading">
                    Audi Q8
                </div>
                <div class="card-text">
                </div>
                <div class="card-text text-danger price">
                    <p>$67,400</br>$67,400</p>
                </div>
                <div class="row">
                <div class="col" id="item-btn-left"><a href="#" class="card-button bg-dark" id="item-btn-left"><span class="material-symbols-outlined">
                visibility
                </span></a></div>
                <div class="col" id="item-btn-right"><a href="#" class="card-button bg-dark" id="item-btn-right"><span class="material-symbols-outlined">
                favorite
                </span></a></div>
            </div>
            </div>
        </div>';
        }
        ; ?>
    </div>
</div>
