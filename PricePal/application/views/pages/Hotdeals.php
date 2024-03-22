<div class="container">
    <div id="itemgrid" class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-2">
        <?php
        foreach ($newarrivals as $document) {
            echo '<div class="col-md-3 card-item">
            <div class="card-sl">
                <div class="container d-flex justify-content-center card-image">
                    <img src="';
            echo $document->image;
            echo '"/>
                </div>
                <div class="card-heading">';
            echo $document->title;
            echo '</div>
                <div class="card-text text-danger price">
                    <p>';
            echo $document->old_price;
            // echo $document->original_price;
            echo ' LKR</br><s>';
            echo $document->new_price;
            // echo $document->selling_price;
            echo ' LKR</s></p>
                </div>
                <div class="card-text">
                <p>';
            $milliseconds = $document->created_at->toDateTime();
            echo $milliseconds->format('Y-m-d');
            echo '</p>
                </div>
                <div class="row">
                <div class="col" id="item-btn-left"><a href="';
            echo $document->product_url;
            echo '" class="card-button bg-dark" id="item-btn-left"><span class="material-symbols-outlined">
                visibility
                </span></a></div>
                <div class="col" id="item-btn-right"><a href="#" class="card-button bg-dark" id="item-btn-right"><span class="material-symbols-outlined">
                favorite
                </span></a></div>
            </div>
            </div>
        </div>';
        }
        ;
        ?>
    </div>
</div>