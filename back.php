<?php
include 'server.php';
session_start();

if(isset($_SESSION["id"])) {
    
    include 'encrypt.php';

    include 'key.php';

    $domain = decryptPrize($_SESSION["id"], $key);
    $session = $domain;

    $stmt = $conn->prepare("SELECT * FROM user_accounts WHERE id = ?");
    $stmt->bind_param("i", $session);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $accounts = $result->fetch_assoc();

            $destroy_api = $conn->prepare("DELETE FROM api_code WHERE user_id = ?");
            $destroy_api->bind_param("i", $accounts["id"]);
            $destroy_api->execute();
            session_start();

            session_destroy();

            echo '<script>
                alert("Authentication Failed Session Destroy")
                window.location.href = "index.php"
            </script>';
        

    }
    
} 

$conn->close();



?>