<?php
include 'server.php';
session_start();

if(isset($_SESSION["id"])) {

    $request_code_id = $_POST["code"];
    $username = $_SESSION["id"];

    $stmt = $conn->prepare("SELECT * FROM user_accounts WHERE id = ?");
    $stmt->bind_param("i", $username);
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
                window.location.href = "demo_login.php"
            </script>';
        

    }
    
} 

$conn->close();



?>