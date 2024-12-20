<?php
include 'server.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    session_start();

    if (isset($_SESSION["username"])) {

        include 'encrypt.php';

        include 'key.php';

        $domain = decryptPrize($_SESSION["username"], $key);
        $session = $domain;

        $check = $conn->prepare("SELECT * FROM seller_shop WHERE username = ?");
        $check->bind_param("s", $session);
        $check->execute();
        $result = $check->get_result();

        if ($result->num_rows > 0) {

            $accounts = $result->fetch_assoc();

            $product_name = $_POST["product_name"];

            $product_uppercase = ucwords($product_name);

            $prize = $_POST["prize"];
            
            $encryptedPrize = encryptPrize($prize, $key);

            if (isset($_FILES['img']) && $_FILES['img']['error'] === 0) {

                $img_tmp_name = $_FILES['img']['tmp_name'];

                if (is_uploaded_file($img_tmp_name)) {
                    
                    $img_data = file_get_contents($img_tmp_name);
            
                    $img_id = $img_data;
                } 

                $response = [
                    'success' => true,
                    'message' => ' Added Succesfully'
                ];
                echo json_encode($response);
                
                $stmt = $conn->prepare("INSERT INTO products_view (seller_id, product_name, prize, img) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("isss", $accounts["id"], $product_uppercase, $encryptedPrize, $img_id);
                
                $stmt->execute();

            }  else {

                $response = [
                    'success' => false,
                    'message' => ' Failed To Submit'
                ];
                
                echo json_encode($response);
            }

           
            

        }else {

            include 'session_destroy.php';
        }


    } else {

        include 'session_destroy.php';
    }



} else {

    echo '<div style="width:100%; display: flex; justify-content: center;"><h1>Invalid Request :(</h1></div>';

}

?>