<h5 class="text-center">Best Selling</h5>
<div class="container">
    <div id="itemgrid" class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-2">
        <?php foreach ($bestselling as $document): ?>
            <div class="col-md-3 card-item">
                <div class="card-sl">
                    <div class="container d-flex justify-content-center card-image">
                        <img src="<?php echo htmlspecialchars($document['image']); ?>" />
                    </div>
                    <div class="card-heading">
                        <?php echo htmlspecialchars($document['title']); ?>
                    </div>
                    <div class="card-text"></div>
                    <div class="card-text price h-25">
                        <p>
                            <?php
                            $newPriceText = $document['new_price'];
                            if (strpos($newPriceText, 'Rs') === false) {
                                $newPriceText = 'Rs ' . $newPriceText;
                            }
                            echo '<span class="text-success">' . htmlspecialchars($newPriceText) . '</span><br><s>';

                            $oldPriceText = $document['old_price'];
                            if (!is_null($oldPriceText) && strpos($oldPriceText, 'Rs') === false) {
                                $oldPriceText = 'Rs ' . $oldPriceText;
                            } elseif (is_null($oldPriceText)) {
                                $oldPriceText = '-';
                            }
                            echo '<span class="text-danger">' . htmlspecialchars($oldPriceText) . '</span>';
                            ?>
                            </s>
                        </p>
                    </div>
                    <div class="card-text">
                        <p>
                            <?php
                            if (isset ($document['created_at']['$date']['$numberLong'])) {
                                $milliseconds = (int) ($document['created_at']['$date']['$numberLong'] / 1000);
                                echo htmlspecialchars(date('Y-m-d', $milliseconds));
                            } else {
                                echo '-';
                            }
                            ?>
                        </p>
                    </div>
                    <div class="row">
                        <div class="col">
                            <a href="<?php echo htmlspecialchars($document['product_url']); ?>"
                                class="card-button bg-dark"><span class="material-symbols-outlined">visibility</span></a>
                        </div>
                        <div class="col">
                            <a href="#" class="card-button bg-dark"><span
                                    class="material-symbols-outlined">favorite</span></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>