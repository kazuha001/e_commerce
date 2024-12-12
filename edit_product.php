<?php
include 'server.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_SESSION["username"])) {

        include 'encrypt.php';

        include 'key.php';

        $domain = decryptPrize($_SESSION["username"], $key);
        $session = $domain;

        $check = $conn->prepare("SELECT * FROM seller_shop WHERE username = ?");
        $check->bind_param("s", $session);
        $check->execute();
        $check_result = $check->get_result();

        if ($check_result->num_rows > 0) {

            $accounts = $check_result->fetch_assoc();

            $edit_id = $_POST["edit_id"];

            $table = $conn->prepare("SELECT * FROM products_view WHERE id = ?");
            $table->bind_param("i", $edit_id);
            $table->execute();
            $table_result = $table->get_result();

            if ($table_result->num_rows > 0) {

                while ($row = $table_result->fetch_assoc()) {

                    $decryptedToken = decryptPrize($row['prize'], $key);

                    echo '
                        <!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Domain</title>

    <!-- CSS links -->
    <link rel="stylesheet" href="css/default.css">

    <!-- CSS admin -->
    <link rel="stylesheet" href="css/admin.css">

    <link rel="stylesheet" href="">

    </head>
    <body style="background-color: #1e1e1e;">
    <div class="container">
        <div class="header">
            <div class="overlay_1"><img src="retrieve_img_shop.php?user_id=' . $accounts['username'] . '" alt="png" style="width: 100%; height: 100%;"></div><!-- Overlay -->
            <div class="title"><h2>Update Products</h2></div>
        </div>

         <div class="content">
            <div class="user_request" id="">
                <div class="tables_function">
                    <h1>Products Overview</h1>
                    <div class="tables_function_elements">
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
                                            <td><img id="upImg" src="product_img.php?user_id=' . $row["id"] . '" alt="Product Img" style="width: 90px; height: 90px; margin: 10px;"></td>
                                            <td><input id="uploadImg" type="file" name="img" accept="image/*" style="width: 50%; color: #fff;"></td>
                                            <td><input type="text" name="product_name" id="product_name" placeholder="Product Name" value="' . $row["product_name"] . '" required></td>
                                            <td><input type="number" name="prize" id="prize" placeholder="Input Prize" value="' . $decryptedToken . '" required></td>
                                            <td><button style="background-color: #0f0;">Update</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <input type="hidden" name="update_id" id="update_id" value="' . $row["id"] . '" required>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </body>
    <footer>
    
    </footer>
                
    <script src="script/product_update.js"></script>
    
    </html>
                    ';

                }


            }


        }

    } else {

        include 'session_destroy.php';
    

    }


} else {

    echo '<div style="width:100%; display: flex; justify-content: center;"><h1>Invalid Request :(</h1></div>
    <script>
        window.location.href = "sell_products.php"
        </script>';

}


?>