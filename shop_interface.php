<?php
include 'server.php';

session_start();

$limit = 20;  // Number of items per page
$start = isset($_GET['start']) ? (int)$_GET['start'] : 0;

$user_id = isset($_GET['user_id']) ? (int)$_GET['user_id'] : 0;

if (isset($_SESSION["username"])) {

$stmt = $conn->prepare("SELECT * FROM seller_shop WHERE id = ?");
$stmt->bind_param("s", $user_id);
$stmt->execute();
$stmt_result = $stmt->get_result();

$stmt2 = $conn->prepare("SELECT * FROM products_view WHERE seller_id = ? LIMIT ? OFFSET ?");
$stmt2->bind_param("iii", $user_id, $limit, $start);
$stmt2->execute();
$stmt2_result = $stmt2->get_result();


} else {

    include 'session_destroy.php';

}


?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Interface</title>
    <link rel="icon" href="logo/e-commerce.png" type="image/x-icon">
    <!-- CSS links -->
    <link rel="stylesheet" href="css/default.css">

    <link rel="stylesheet" href="css/shop_interface.css">

    <link rel="stylesheet" href="css/user.css">

    <link rel="stylesheet" href="css/loading.css">

</head>
<body style="position: relative;">
    <div class="products_foods_popup" id="products_foods_popup">
        <div class="products_foods_popup_top">
            <p id="close_popup">&times;</p>
        </div>
        <div class="products_foods_popup_bottom">
            <div class="products_foods_popup_bottom_img">
                
                <img id="img_change" src="" alt="images">
                
                <div>
                    <h2 id="products_name"></h2><h2 id="price"></h2>
                </div>
            </div>
            <form action="encrypting_transaction.php" method="POST" id="resetf0">
                
            <div class="products_foods_popup_bottom_quantity_function">
                <div class="products_foods_popup_bottom_quantity_function_elements1">
                    
                    <button onclick="minus_qty()" type="button"><p>&minus;</p></button>
                    <h2 id="qty_result">1</h2>
                    <button onclick="plus_qty()" type="button"><p>&plus;</p></button>
                </div>
                <div class="products_foods_popup_bottom_quantity_function_elements2">
                    
                    <button type="submit">Add to Cart - &nbsp;<p id="total_result"></p></button>
                </div>
                <input type="hidden" name="org_prize" id="org_price2" value="">
                <input type="hidden" name="qty" id="qty" value="1" required>
                <input type="hidden" name="token" id="token" value="">
                <input type="hidden" id="total" value="">
                <input type="hidden" id="seller" name="seller" value="">
                <!-- Important -->
                <input type="hidden" id="PRID" name="PRID" value="" required>

            </div>
            </form>
        </div>
    </div>
    <div class="container">
    <div class="hide_bg" id="hide_bg"></div>
            <?php
            if ($stmt_result->num_rows > 0) {

                $shop_acc = $stmt_result->fetch_assoc();

                echo '
                    <div class="header1">
                         <div class="header1_img_pp">
                        <img src="retrieve_img_shop.php?user_id=' . $shop_acc["username"] . '" alt="">
                    </div>
                    <div class="header1_shop_name">
                        <h2>' . $shop_acc["shop_name"] . '</h2>
                        <h2><br>Address: ' . $shop_acc["address"] . '</h2>
                    </div>
                    </div>
                ';

            }

           
            ?>

                   
        
        <div class="content">
            <div class="content_overview">
                <div>
                    <button onclick="">Products</button>
                    <button onclick="">Discription</button>
                </div>
            </div>
            <div class="content_product">
                <?php

                    if ($stmt2_result->num_rows > 0) {

                        include 'dencrypt.php';

                        include 'encrypt.php';

                        include 'key.php';

                        $row = $stmt2_result->fetch_all(MYSQLI_ASSOC);

                        foreach ($row as $rows) {

                            $decryptedPrize = decryptPrize($rows['prize'], $key);

                            $encryptedId = encryptPrize($rows["id"], $key);

                            $encryptedSellerId = encryptPrize($rows["seller_id"], $key);

                            echo '
                            
                             <!-- Changes -->
                                <div class="products_foods_ads">
                                    <div class="products_foods_ads_image">
                                        <img src="product_img.php?user_id=' . $rows["id"] . '" alt="images">
                                    </div>
                                    <div class="products_foods_ads_info">
                                        <h3>' . $rows["product_name"] . '</h3>
                                        <p> ' . $decryptedPrize . ' / <u>Shipping Included</u></p>
                                        <div class="products_foods_ads_info_funtion">
                                        <input type="hidden" class="PRID" name="productId" value="' . $encryptedId . '"><!-- Important -->
                                        <input type="hidden" class="seller" name="productId" value="' . $encryptedSellerId . '">
                                        <input type="hidden" class="img_identify" name="productId" value="' . $rows["id"] . '">
                                        <input type="hidden" class="products_name" value="' . $rows["product_name"] . '">
                                        <input type="hidden" class="org_price" value="' . $decryptedPrize . '">
                                        <input type="hidden" class="token" value="' . $rows["prize"] . '">
                                        <button class="buy">Add to Cart &#x2795;</button>
                                        </div>
                                    </div>
                                </div>

                            
                            ';

                        }

                    }

                ?>

                        <?php
                            // Prepare the statement to fetch the total number of products
                            $total_query = $conn->prepare("SELECT COUNT(*) as total FROM products_view WHERE seller_id = ?");
                            $total_query->bind_param("i", $user_id);
                            $total_query->execute();
                            $total_result = $total_query->get_result();
                            $total_row = $total_result->fetch_assoc();
                            $total_products = $total_row['total'];

                            // Calculate the next starting point
                            $next_start = $start + $limit;

                            // Display Next button only if there are more products to load
                            if ($next_start < $total_products) {
                                echo '<div class="pagination">
                                        <a href="shop_interface.php?user_id=' . $user_id . '&start=' . $next_start . '">Load More</a>
                                    </div>';
                            } else {
                                echo '<div class="pagination">
                                <a>No Products Available</a>
                                    </div>';
                            }
                        ?>
               

            </div>

        </div>
    </div>
</body>

<script src="script/animation5.js"></script>

</html>