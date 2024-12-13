<?php
include 'server.php';
session_start();

if(isset($_SESSION["username"])) {

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

            $destroy_api = $conn->prepare("DELETE FROM upgrade_request WHERE user_id = ?");
            $destroy_api->bind_param("i", $accounts["id"]);
            $destroy_api->execute();
            session_start();

            echo '<script>
                alert("Authentication Failed Session Destroy")
                window.location.href = "update_account.php"
            </script>';
        

    }
    
} 

$conn->close();



?>