<?php
include 'server.php';
session_start();

$limit = 30;  // Number of items per page
$start = isset($_GET['start']) ? (int)$_GET['start'] : 0;

if (isset($_SESSION["username"])) {

    include 'encrypt.php';

    include 'key.php';

    $domain = decryptPrize($_SESSION["username"], $key);
    $session = $domain;

    $check = $conn->prepare("SELECT * FROM user_accounts WHERE username = ?");
    $check->bind_param("s", $session);
    $check->execute();
    $check_result = $check->get_result();


    $shop = $conn->prepare("SELECT * FROM seller_shop");
    $shop->execute();
    $shop_result = $shop->get_result();


    $product = $conn->prepare("SELECT * FROM products_view LIMIT ? OFFSET ?");
    $product->bind_param("ii", $limit, $start);
    $product->execute();
    $product_result = $product->get_result();


} else {

    include 'session_destroy.php';
    

}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Interface</title>

    <link rel="icon" href="logo/e-commerce.png" type="image/x-icon">

    <!-- CSS links -->  
    <link rel="stylesheet" href="css/default.css">

    <!-- User CSS -->
    <link rel="stylesheet" href="css/user.css">

    <link rel="stylesheet" href="css/loading.css">

</head>
<body style="background-color: #eee; position: relative;">
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
                        <input type="hidden" name="org_prize" id="org_price2" value="">
                        <input type="hidden" name="qty" id="qty" value="1" required>
                        <input type="hidden" name="token" id="token" value="">
                        <input type="hidden" id="total" value="">
                        <input type="hidden" id="seller" name="seller" value="">
                        <!-- Important -->
                        <input type="hidden" id="PRID" name="PRID" value="" required>
                    <button type="submit">Add to Cart - &nbsp;<p id="total_result"></p></button>
                </div>
                

            </div>
            </form>
        </div>
    </div>
    <div class="container" id="container">
        <div class="hide_bg" id="hide_bg"></div>
        
        <div class="burger_menu" id="burger_menu">
            <div class="title" id="burger_menu">
                <div class="overlay_1"></div>
                <h2>Cordy</h2>
                
            </div>
                <select disabled id="categories_function">
                    <option>Categories</option>
                </select>
                <div class="burger_menu_items">
                    <span><h4>Fruits</h4>
                    <div class="burger_menu_items_dropdown">
                        <span><h4>Apples</h4></span>
                        <span><h4>Bananas</h4></span>
                        <span><h4>Oranges</h4></span>
                        <span><h4>Grapes</h4></span>
                        <span><h4>Mangoes</h4></span>
                    </div>
                    </span>
                    <span><h4>Vegetables</h4>
                    <div class="burger_menu_items_dropdown">
                        <span ><h4>Carrots</h4></span>
                        <span><h4>Broccoli</h4></span>
                        <span><h4>Spinach</h4></span>
                        <span><h4>Potatoes</h4></span>
                        <span><h4>Peppers</h4></span>
                    </div>
                    </span>
                    <span><h4>Grains</h4>
                    <div class="burger_menu_items_dropdown">
                        <span ><h4>Rice</h4></span>
                            <span><h4>Wheat</h4></span>
                            <span><h4>Oats</h4></span>
                            <span><h4>Quinoa</h4></span>
                            <span><h4>Barley</h4></span>
                    </div>
                    </span>
                    <span><h4>Proteins</h4>
                    <div class="burger_menu_items_dropdown">
                        <span ><h4>Chicken</h4></span>
                            <span><h4>Beef</h4></span>
                            <span><h4>Pork</h4></span>
                            <span><h4>Fish</h4></span>
                            <span><h4>Crab</h4></span>
                    </div>
                    </span>
                    <span><h4>Dairy</h4>
                    <div class="burger_menu_items_dropdown">
                        <span ><h4>Milk</h4></span>
                            <span><h4>Cheese</h4></span>
                            <span><h4>Yogurt</h4></span>
                            <span><h4>Butter</h4></span>
                            <span><h4>Cream</h4></span>
                    </div>
                    </span>
                    <span><h4>Fats and Oils</h4>
                    <div class="burger_menu_items_dropdown">
                        <span ><h4>Olive Oil</h4></span>
                            <span><h4>Coconut Oil</h4></span>
                            <span><h4>Butter</h4></span>
                            <span><h4>Avocados</h4></span>
                            <span><h4>Nuts</h4></span>
                    </div>
                    </span>
                    <span><h4>Snacks</h4>
                    <div class="burger_menu_items_dropdown">
                        <span ><h4>Chips</h4></span>
                            <span><h4>Crackers</h4></span>
                            <span><h4>Cookies</h4></span>
                            <span><h4>Popcorn</h4></span>
                            <span><h4>Nuts</h4></span>
                    </div>
                    </span>
                    <span><h4>Desserts</h4>
                    <div class="burger_menu_items_dropdown">
                        <span ><h4>Ice Cream</h4></span>
                            <span><h4>Cakes</h4></span>
                            <span><h4>Pies</h4></span>
                            <span><h4>Pastries</h4></span>
                            <span><h4>Chocolates</h4></span>
                    </div>
                    </span>
                    <span><h4>Beverages</h4>
                    <div class="burger_menu_items_dropdown">
                        <span ><h4>Water</h4></span>
                            <span><h4>Coffee</h4></span>
                            <span><h4>Tea</h4></span>
                            <span><h4>Juice</h4></span>
                            <span><h4>Smoothies</h4></span>
                    </div>
                    </span>
                    <span><h4>Fast Foods</h4>
                    <div class="burger_menu_items_dropdown">
                        <span ><h4>Burgers</h4></span>
                            <span><h4>Pizza</h4></span>
                            <span><h4>Fries</h4></span>
                            <span><h4>Tacos</h4></span>
                            <span><h4>Sandwiches</h4></span>
                    </div>
                    
                    </span>
                </div>
                <select disabled id="about_burger">
                    <option value="">About me</option>
                </select>
                <div class="burger_menu_items_2">
                    <span><h4>Terms Of Condition</h4></span>
                    <span><h4>Privacy Policy</h4></span>
                </div>
        </div>
        <div class="header" >
            <div class="overlay_burger" onclick="burger_function()">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="header_left">
                <div class="title">
                    <div class="overlay_1"></div>
                    <h2>Cordy</h2>
                </div>
                <nav class="navbar">
                    <select disabled id="categories">
                        <option>Categories</option>
                    </select>
                    
                    <select disabled id="about">
                        <option value="">About me</option>
                    </select>
                </nav>
            </div>
            
            <div class="header_right" >
                
                
                <div class="search" id="header_prevention">
                    <form action="user_search.php" method="POST">
                        <input type="search" placeholder="What are you looking for?" id="search" name="search">
                    </form>
                    
                </div>
                <div class="user_information" id="user_information">
                    <?php

                        if ($check_result->num_rows > 0) {

                            $user = $check_result->fetch_assoc();

                            echo '
                                <div>
                                    <div style="width: 35px; height: 35px; margin: 5px; border-radius: 1000vh; overflow: hidden;"><img src="retrieve_img.php?user_id=' . $user['id'] . '" alt="PP" style="width: 100%; height: 100%;"></div><!-- Overlay -->
                                <p>' . $user["username"] . '</p>
                                </div>
                            ';

                        } else {
                            include 'session_destroy.php';
                        }
                        
                    ?>
                    <div class="user_information_overlay" id="user_information_overlay">
                        <form action="user_pp.php"><button><h4>My Profile</h4></button></form>
                        <form action="carts.php"><button><h4>My Carts</h4></button></form>
                        <form action="logout.php" method=""><button><h4>Log out</h4></button></form>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="overlay" id="overlay">
                <div class="categories" id="categories_overlay">
                    
                    <div class="categories_left">
                        <h2>All Categories</h2>
                        <div class="categories_overview" id="opt1"><h3>Fruits</h3></div>
                        <div class="categories_overview" id="opt2"><h3>Vegetables</h3></div>
                        <div class="categories_overview" id="opt3"><h3>Grains</h3></div>
                        <div class="categories_overview" id="opt4"><h3>Proteins</h3></div>
                        <div class="categories_overview" id="opt5"><h3>Dairy</h3></div>
                        <div class="categories_overview" id="opt6"><h3>Fats and Oils</h3></div>
                        <div class="categories_overview" id="opt7"><h3>Snacks</h3></div>
                        <div class="categories_overview" id="opt8"><h3>Desserts</h3></div>
                        <div class="categories_overview" id="opt9"><h3>Beverages</h3></div>
                        <div class="categories_overview" id="opt10"><h3>Fast Foods</h3></div>
                    </div>
                    <div class="categories_center">
                        <div class="categories_center_hidden" id="fruits">
                            <h2>Based On</h2>
                            <span ><h4>Apples</h4></span>
                            <span><h4>Bananas</h4></span>
                            <span><h4>Oranges</h4></span>
                            <span><h4>Grapes</h4></span>
                            <span><h4>Mangoes</h4></span>
                        </div>
                        <div class="categories_center_hidden" id="vegetables">
                            <h2>Based On</h2>
                            <span ><h4>Carrots</h4></span>
                            <span><h4>Broccoli</h4></span>
                            <span><h4>Spinach</h4></span>
                            <span><h4>Potatoes</h4></span>
                            <span><h4>Peppers</h4></span>
                        </div>
                        <div class="categories_center_hidden" id="Grains">
                            <h2>Based On</h2>
                            <span ><h4>Rice</h4></span>
                            <span><h4>Wheat</h4></span>
                            <span><h4>Oats</h4></span>
                            <span><h4>Quinoa</h4></span>
                            <span><h4>Barley</h4></span>
                        </div>
                        <div class="categories_center_hidden" id="Proteins">
                            <h2>Based On</h2>
                            <span ><h4>Chicken</h4></span>
                            <span><h4>Beef</h4></span>
                            <span><h4>Pork</h4></span>
                            <span><h4>Fish</h4></span>
                            <span><h4>Crab</h4></span>
                        </div>
                        <div class="categories_center_hidden" id="Dairy">
                            <h2>Based On</h2>
                            <span ><h4>Milk</h4></span>
                            <span><h4>Cheese</h4></span>
                            <span><h4>Yogurt</h4></span>
                            <span><h4>Butter</h4></span>
                            <span><h4>Cream</h4></span>
                        </div>
                        <div class="categories_center_hidden" id="Fats_and_Oils">
                            <h2>Based On</h2>
                            <span ><h4>Olive Oil</h4></span>
                            <span><h4>Coconut Oil</h4></span>
                            <span><h4>Butter</h4></span>
                            <span><h4>Avocados</h4></span>
                            <span><h4>Nuts</h4></span>
                        </div>
                        <div class="categories_center_hidden" id="Snacks">
                            <h2>Based On</h2>
                            <span ><h4>Chips</h4></span>
                            <span><h4>Crackers</h4></span>
                            <span><h4>Cookies</h4></span>
                            <span><h4>Popcorn</h4></span>
                            <span><h4>Nuts</h4></span>
                        </div>
                        <div class="categories_center_hidden" id="Desserts">
                            <h2>Based On</h2>
                            <span ><h4>Ice Cream</h4></span>
                            <span><h4>Cakes</h4></span>
                            <span><h4>Pies</h4></span>
                            <span><h4>Pastries</h4></span>
                            <span><h4>Chocolates</h4></span>
                        </div>
                        <div class="categories_center_hidden" id="Beverages">
                            <h2>Based On</h2>
                            <span ><h4>Water</h4></span>
                            <span><h4>Coffee</h4></span>
                            <span><h4>Tea</h4></span>
                            <span><h4>Juice</h4></span>
                            <span><h4>Smoothies</h4></span>
                        </div>
                        <div class="categories_center_hidden" id="Fast_Foods">
                            <h2>Based On</h2>
                            <span ><h4>Burgers</h4></span>
                            <span><h4>Pizza</h4></span>
                            <span><h4>Fries</h4></span>
                            <span><h4>Tacos</h4></span>
                            <span><h4>Sandwiches</h4></span>
                        </div>
                    </div>
                    <div class="categories_right"></div>

                </div>
                <div class="about_me" id="about_me">
                    <div class="about_me_elements">
                        <div class="about_me_elements_img about_me_overlay_left">

                        </div><!--Overlay-->
                        <h3>Terms of Condition</h3>
                    </div>
                    <div class="about_me_elements">
                        <div class="about_me_elements_img about_me_overlay_right">

                        </div><!--Overlay-->
                        <h3>Privacy Policy</h3>
                    </div>
                </div>
                
        </div>
        <div class="content" id="content">
            <div class="content_top">
                <div class="content_top_reconds">
                    <div class="content_top_reconds_title">
                        <h2>Popular Shop</h2>
                    </div>
            <div class="content_top_reconds_shop">

                 <?php
                 
                 if ($shop_result->num_rows > 0) {

                    $row = $shop_result->fetch_all(MYSQLI_ASSOC);

                    foreach ($row as $rows) {

                        echo '

                         
                        <!-- Changes -->
                        <div class="shop" onclick="window.location.href = \'shop_interface.php?user_id=' . $rows["id"] . '\'">
                            <div class="shop_logo">
                                <img src="retrieve_img_shop.php?user_id=' . $rows["username"] . '" alt="logo">
                            </div>
                            <div class="shop_name">
                                <p>' . $rows["shop_name"] . '</p>
                            </div>
                        </div>
                        
                        ';

                    }


                 }
                
                        
                ?>

                    </div>
                </div>
            </div>
            <div class="content_bottom">
                <div class="products">
                    <div class="products_title">
                        <h2>Foods Recommendation</h2>
                    </div>

                    <div class="products_foods" id="content_load">

                        <?php

                            if ($product_result->num_rows > 0) {

                                $product_row = $product_result->fetch_all(MYSQLI_ASSOC);
                                
                                foreach ($product_row as $product_rows) {

                                    $decryptedPrize = decryptPrize($product_rows['prize'], $key);

                                    $encryptedId = encryptPrize($product_rows["id"], $key);

                                    $encryptedSellerId = encryptPrize($product_rows["seller_id"], $key);

                                    echo '
                                    
                                    <!-- Changes -->
                            <div class="products_foods_ads">
                                <div class="products_foods_ads_image">
                                    <img src="product_img.php?user_id=' . $product_rows["id"] . '" alt="images">
                                </div>
                                <div class="products_foods_ads_info">
                                    <div class="text_limiter">
                                        <h3>' . $product_rows["product_name"] . '</h3>
                                        <p> ' . $decryptedPrize . ' / <u>Shipping Included</u></p>
                                    </div>
                                    
                                    <div class="products_foods_ads_info_funtion">
                                    <input type="hidden" class="PRID" name="productId" value="' . $encryptedId . '"><!-- Important -->
                                    <input type="hidden" class="seller" name="productId" value="' . $encryptedSellerId . '">
                                    <input type="hidden" class="img_identify" name="productId" value="' . $product_rows["id"] . '">
                                    <input type="hidden" class="products_name" value="' . $product_rows["product_name"] . '">
                                    <input type="hidden" class="org_price" value="' . $decryptedPrize . '">
                                    <input type="hidden" class="token" value="' . $product_rows["prize"] . '">
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
                            $total_query = $conn->prepare("SELECT COUNT(*) as total FROM products_view");
                            $total_query->execute();
                            $total_result = $total_query->get_result();
                            $total_row = $total_result->fetch_assoc();
                            $total_products = $total_row['total'];

                            // Calculate the next starting point
                            $next_start = $start + $limit;

                            // Display Next button only if there are more products to load
                            if ($next_start < $total_products) {
                                echo '<div class="pagination">
                                        <a href="user.php?start=' . $next_start . '">Load More</a>
                                    </div>';
                            } else {
                                echo '<div class="pagination">
                                <p>No Data</p>
                                    </div>';
                            }
                        ?>

                    </div>
                    

                </div>
                
                
            </div>
        </div>
    </div>
</body>
<footer>

</footer>
<script src="script/animation3.js"></script>

<script>
       
       var domain = "<?php echo htmlspecialchars($_SESSION["username"], ENT_QUOTES, 'UTF-8'); ?>";
       
       if (domain) {
           var newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + "?temporary?encryptedkey=" + encodeURIComponent(domain);
           
           
           window.history.pushState({path: newUrl}, '', newUrl);
           
           console.log("Current session data (temporary key) is now in the URL!");
       } else {
           console.log("No domain key found or invalid.");
       }
   
   
</script>
</html>
