<?php
include 'server.php';
include 'error.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_SESSION["username"])) {

        $session = $_SESSION["username"];

        $check = $conn->prepare("SELECT * FROM user_accounts WHERE username = ?");
        $check->bind_param("s", $session);
        $check->execute();
        $check_result = $check->get_result();

        if ($check_result->num_rows > 0) {

            $accounts = $check_result->fetch_assoc();

            $shop = $conn->prepare("SELECT * FROM seller_shop WHERE user_id = ?");
            $shop->bind_param("i", $accounts["id"]);
            $shop->execute();
            $shop_result = $shop->get_result();

            if ($shop_result->num_rows > 0) {

                $shop_acc = $shop_result->fetch_assoc();

                $product_id = $_POST["update_id"];

                $check_product = $conn->prepare("SELECT * FROM products_view WHERE id = ? AND seller_id = ?");
                $check_product->bind_param("ii", $product_id, $shop_acc["id"]);
                $check_product->execute();
                $check_product_result = $check_product->get_result();

                if ($check_product_result->num_rows > 0) {

                    $result = $check_product_result->fetch_assoc();

                    $product_name = $_POST["product_name"];
                    $prize = $_POST["prize"];

                    if (isset($_FILES['img']) && $_FILES['img']['error'] === 0) {

                        $img_tmp_name = $_FILES['img']['tmp_name'];
        
                        if (is_uploaded_file($img_tmp_name)) {
                            
                            $img_data = file_get_contents($img_tmp_name);
                    
                            $img_id = $img_data;
                        }      
                        
                    } else {

                        $img_id = $result["img"];

                    }

                    $response = [
                        'success' => true,
                        'message' => ' Updated Succesfully'
                    ];

                    include 'encrypt.php';

                    include 'key.php';

                    $encryptedPrize = encryptPrize($prize, $key);


                    $stmt = $conn->prepare("UPDATE products_view SET product_name = ?, prize = ?, img = ? WHERE id = ?");
                    $stmt->bind_param("sssi", $product_name, $encryptedPrize, $img_id, $result["id"]);
                    $stmt->execute();

                    

                } else {
                    
                    $response = [
                        'success' => false,
                        'message' => ' Invalid Parameters'
                    ];

                }


            } else {

                include 'session_destroy.php';

            }


        } else {

            include 'session_destroy.php';

        }

    } else {

        include 'session_destroy.php';
    
    }

} else {

    echo '<div style="width:100%; display: flex; justify-content: center;"><h1>Invalid Request :(</h1></div>';

}



?>