<h4 class="text-center"><i class="fa-solid fa-heart text-danger"></i> Favourites</h4>
<div id="itemgrid" class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-2 px-5">

    <?php
    foreach ($result as $document) {
        $category = json_encode($document['category']); /// trending
        $id = $id = (string) $document['_id'];
        $mail = $_SESSION["email"] ?? null;
        $email = json_encode($mail);
        $idForJs = json_encode($id);
        echo '<div class="col-md-3 card-item" onclick=\'trend(' . $idForJs . ',' . $category . ');\'>
            <div class="card-sl">
                <div class="container d-flex justify-content-center card-image">
                    <img src="';
        echo $document->image;
        echo '"/>
                </div>
                <div class="card-heading">';
        echo $document->title;
        echo '</div>
                <div class="card-text">
                </div>
                <div class="card-text price h-25">
                    <p>';
        $newPriceText = $document->new_price;

        // Check if 'Rs' is not already in the old price text
        if (strpos($newPriceText, 'Rs') === false) {
            $newPriceText = 'Rs ' . $newPriceText;
        }

        echo '<span class="text-success">' . $newPriceText . '</span>';
        echo ' </br><s>';
        $oldPriceText = $document->old_price;

        // Check if 'Rs' is not already in the old price text && if null
        if (!is_null($oldPriceText)) {
            if (strpos($oldPriceText, 'Rs') === false) {
                $oldPriceText = 'Rs ' . $oldPriceText;
            }
        } else {
            $oldPriceText = '-';
        }

        echo '<span class="text-danger">' . $oldPriceText . '</span>';
        echo ' </s></p>
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
                <div class="col" id="item-btn-right"><a href="#" onclick=\'favourites(' . $idForJs . ',' . $email . ',' . $category . ');\' class="card-button bg-dark" id="item-btn-right"><span class="material-symbols-outlined">
                favorite
                </span></a></div>
            </div>
            </div>
        </div>';
    }
    ;
    ?>
</div>

<script>
    function trend(productID, productcategory) {
        fetch('<?= base_url("index.php/trending/update_views") ?>', { // Replace with the actual URL to your method
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest' // Important for CI's is_ajax_request()
            },
            body: JSON.stringify({
                product_id: productID,
                product_category: productcategory
            })
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    console.log(data.message); // Handle success
                    console.log(productID);
                } else {
                    console.error(data.message); // Handle failure
                }
            })
            .catch((error) => {
                console.error('Error:', error); // Handle any error that occurred during the fetch.
            });
    }

    function handleSelectChange() {
        // var selectElement = document.getElementById('categorySelect');git
        // var selectedValue = selectElement.value;
        document.getElementById('searchform').submit();
        // console.log(selectedValue);
        // Perform an action based on the selected value
    }
    function favourites(productID, productCategory) {
        fetch('/index.php/trending/update_favourites', { // Adjust the URL as needed
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({
                product_id: productID,
                product_category: productCategory
            })
        })
            .then(response => response.text()) // Get the response text
            .then(text => {
                console.log("Raw response:", text); // Log the raw text
                return JSON.parse(text); // Then attempt to parse it as JSON
            })
            .then(data => {
                // Handle the parsed data
                console.log(data);
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    }

</script>