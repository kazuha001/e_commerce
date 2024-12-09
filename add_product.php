<?php
include 'server.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_SESSION["username"])) {

        $session = $_SESSION["username"];

        $check = $conn->prepare("SELECT * FROM seller_shop WHERE username = ?");
        $check->bind_param("s", $session);
        $check->execute();
        $result = $check->get_result();

        if ($result->num_rows > 0) {

            $accounts = $result->fetch_assoc();

            $product_name = $_POST["product_name"];
            $prize = $_POST["prize"];

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
                $stmt->bind_param("isss", $accounts["id"], $product_name, $prize, $img_id);
            
                $stmt->execute();

                    
                

            }  else {

                $response = [
                    'success' => false,
                    'message' => ' Failed To Submit'
                ];
                
                echo json_encode($response);

                exit();
                session_start();

                

            }

            

        }else {

            echo '<script>
            alert("Authentication Failed Session Destroy 2")
            
            </script>';
            sleep(2);
        }


    } else {

        echo '<script>
        alert("Authentication Failed Session Destroy 3")
        
        </script>';
        sleep(2);
    }



} else {

    echo '<div style="width:100%; display: flex; justify-content: center;"><h1>Invalid Request :(</h1></div>';

}

?>