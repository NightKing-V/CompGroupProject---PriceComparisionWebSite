<?php
    $categories = [
        'All',
        'Mobile Phones & Devices',
        'Televisions',
        'Refrigerators',
        'Washing Machines',
        'Kitchen Appliances',
        'Laptops',
        'Air Conditioners',
        'Fitness Equipment'
    ];

    echo '<div class="row justify-content-center">';
    echo '    <div class="col-md-4">';
    echo '        <h4 class="text-center">Categories</h4><form id="searchform" action = "' . base_url("index.php/Main/searchcat") . '" method = "post">';
    echo '        <select class="form-control mb-5" id="categorySelect" onchange="handleSelectChange()" name="cat">';
    foreach ($categories as $category) {
        echo '            <option' . ($category === 'All' ? ' selected' : '') . ' value= "' . htmlspecialchars($category) . '">' . htmlspecialchars($category) . '</option>';
    }
    echo '        </select></form>';
    echo '    </div>';
    echo '</div>';
    ?>

<h5 class="text-center">Search result for "<?php echo $searchtext; ?>"
</h5>

<div class="container">
        <?php
        if(isset($result) && count($result) == 0){
            echo '
            <div id="itemgrid" class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-2 justify-content-center">
            <div class="vh-100 w-100 d-flex flex-col justify-content-center mt-5 mb-5 ">
            <h3 class="text-center mt-5 w-100">No items Found <i class="fa-regular fa-face-frown"></i></h3>
            
            </div>
            ';
        }else{
            echo '<div id="itemgrid" class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-2">';
        }
        foreach ($result as $document) {
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
                <div class="card-text">
                </div>
                <div class="card-text price h-25">
                    <p>';
            $newPriceText = $document->new_price;

            // Check if 'Rs' is not already in the old price text
            if (strpos($newPriceText, 'Rs') === false) {
                $newPriceText = 'Rs ' . $newPriceText;
            }

            echo '<div class="w-100 d-flex justify-content-between"><span class="text-success">' . $newPriceText . '</span><strong class="text-bold text-primary">'.ucfirst($document->platform).'</strong></div>';
            echo ' </br><s>';
            $oldPriceText = $document->old_price;

            // Check if 'Rs' is not already in the old price text && if null
            if (!is_null($oldPriceText)) {
                if (strpos($oldPriceText, 'Rs') === false) {
                    $oldPriceText = 'Rs ' . $oldPriceText;
                }
            }else{
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