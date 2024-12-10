<?php
include 'server.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_SESSION["username"])) {

        $session = $_SESSION["username"];

        $check = $conn->prepare("SELECT * FROM seller_shop WHERE username = ?");
        $check->bind_param("s", $session);
        $check->execute();
        $check_result = $check->get_result();

        if ($check_result->num_rows > 0) {

            $accounts = $check_result->fetch_assoc();

            if (isset($_FILES['img']) && $_FILES['img']['error'] === 0) {

                

                $img_tmp_name = $_FILES['img']['tmp_name'];

                if (is_uploaded_file($img_tmp_name)) {
                    
                    $img_data = file_get_contents($img_tmp_name);
            
                    $img_id = $img_data;
        
                    }

                    $stmt = $conn->prepare("UPDATE seller_shop SET img = ? WHERE username = ?");
                    $stmt->bind_param("ss", $img_id, $accounts["username"]);
                    
                    $stmt->execute();
                        
                    $response = [
                        'success' => true,
                        'message' => ' Uploaded Succesfully'
                    ];
                    
                    echo json_encode($response);


            }  else {
                    
                $response = [
                    'success' => false,
                    'message' => ' No Images Uploaded'
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

    include 'session_destroy.php';

}

?>