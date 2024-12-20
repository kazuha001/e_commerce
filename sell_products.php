<?php
include 'server.php';
include 'error';
session_start();

if (isset($_SESSION["username"])) {

    include 'encrypt.php';

    include 'key.php';
    
    $domain = decryptPrize($_SESSION["username"], $key);
    $session = $domain;

    $stmt = $conn->prepare("SELECT * FROM user_accounts WHERE username = ?");
    $stmt->bind_param("s", $session);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $accounts = $result->fetch_assoc();

        $stmt2 = $conn->prepare("SELECT * FROM seller_shop WHERE user_id = ?");
        $stmt2->bind_param("i", $accounts["id"]);
        $stmt2->execute();
        $result2 = $stmt2->get_result();

        if ($result2->num_rows > 0) {

            $shop_acc = $result2->fetch_assoc();

            echo '
            <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Domain</title>
    <link rel="icon" href="css/Icons/supermarket.png" type="image/x-icon">
    <!-- CSS links -->
    <link rel="stylesheet" href="css/default.css">

    <!-- CSS admin -->
    <link rel="stylesheet" href="css/admin.css">

    <link rel="stylesheet" href="">

</head>
<body style="background-color: #1e1e1e;">
     <div id="uploading" style="display: none; width: 100%; justify-content: center; align-items: center; margin: 20px;">
        <h1 style="color: #fff;">Adding PLEASE WAIT...</h1></div>
        <div class="container" id="hide">
        <div class="overlay_burger_menu" id="burger_overlay">
            <div class="overlay_title"><h1>Seller Option</h1></div>
            <div class="overlay_burger_menu_function" onclick="ordered()"><h3>Ordered</h3></div>
            <div class="overlay_burger_menu_function" onclick="sell_product()"><h3>Sell Products</h3></div>
            <div class="overlay_burger_menu_function" onclick="seller_pp()"><img src="retrieve_img_shop.php?user_id=' . $shop_acc['username'] . '" alt=""><h3>Seller Profile</h3></div>
        </div><!-- Overlay -->
        <div class="header">
            <div class="overlay_burger" id="bugershow">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="overlay_1"><img src="retrieve_img_shop.php?user_id=' . $shop_acc['username'] . '" alt="png" style="width: 100%; height: 100%;"></div><!-- Overlay -->
            <div class="title"><h2>Sell Product</h2></div>
        </div>

         <div class="content">
            <div class="user_request" id="">
                <div class="tables_function">
                    <h1>Products Overview</h1>
                    <div class="tables_function_elements">
                    <table>
                            <thead>
                                <th style="width: 10%;">Product ID</th>
                                <th style="width: 20%;">Product img</th>
                                <th style="width: 20%;">Name</th>
                                <th style="width: 20%;">Prize</th>
                                <th style="width: 10%;">Publish time</th>
                                <th style="width: 10%;">Action</th>
                            </thead>
                            <tbody>
                    

            ';


            $table = $conn->prepare("SELECT * FROM products_view WHERE seller_id = ?");
            $table->bind_param("s", $shop_acc["id"]);
            $table->execute();
            $table_result = $table->get_result();

            if ($table_result->num_rows > 0) {

                $row = $table_result->fetch_all(MYSQLI_ASSOC);

                foreach($row as $rows) {
                    $decryptedPrize = decryptPrize($rows['prize'], $key);
                    echo '
                    <tr>
                        <td>' . $rows["id"] . '</td>
                        <td><img src="product_img.php?user_id=' . $rows["id"] . '" alt="Product Img" style="width: 90px; height: 90px; margin: 10px;"></td>
                        <td>' . $rows["product_name"] . '</td>
                        <td>' . $decryptedPrize . '</td>
                        <td>' . $rows["current_time/date"] . '</td>
                        <td>
                            <form action="edit_product.php" method="POST">
                                <input type="hidden" id="edit_id" name="edit_id" value="' . $rows["id"] . '">
                                <button style="background-color: #0f0;">EDIT</button>
                            </form>
                            <form action="delete_product.php" method="POST">
                                <input type="hidden" id="delete_id" name="delete_id" value="' . $rows["id"] . '">
                                <button style="background-color: #f00;">DELETE</button>
                            </form>
                        </td>
                    </tr>';

                }
                echo '
                </tbody>
                    </table>    
            ';

        } else {
            echo '
            </tbody>
                    </table>    
                    
            <div class="graph">
                <h1>No Data</h1>
                <img src="load/no-content.png" alt="No Content">
            </div>
             
        ';
        }

           
                                
            
            echo '  
                            
                            <form id="myform">
                                <table>
                                    <thead>
                                        <th style="width: 20%;">Product img</th>
                                        <th>Upload Img</th>
                                        <th>Product Name</th>
                                        <th>Product Prize</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><img id="upImg" src="" alt="Product Img" style="width: 90px; height: 90px; margin: 10px;"></td>
                                            <td><input id="uploadImg" type="file" name="img" accept="image/*" style="width: 50%; color: #fff;" required ></td>
                                            <td><input type="text" name="product_name" id="product_name" placeholder="Product Name" required maxlength="20"></td>
                                            <td><input type="number" name="prize" id="prize" placeholder="Input Price" required></td>
                                            <td><button style="background-color: #0f0;">Add Products</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                                
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </body>
    <footer>
    
    </footer>
                
    <script src="script/shop_graph.js"></script>
    
    <script>
       
       var domain = "' . htmlspecialchars($_SESSION["username"], ENT_QUOTES, 'UTF-8') . '";
       
       if (domain) {
           var newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + "?temporary?encryptedkey=" + encodeURIComponent(domain);
           
           
           window.history.pushState({path: newUrl}, "", newUrl);
           
           console.log("Current session data (temporary key) is now in the URL!");
       } else {
           console.log("No domain key found or invalid.");
       }
   
   
</script>
</html>

            ';

$stmt->close();
$stmt2->close();
$stmt3->close();
$conn->close();

} else {

    include 'session_destroy.php';

}
  


} else {

include 'session_destroy.php';

}


} else {

include 'session_destroy.php';

}






?>

