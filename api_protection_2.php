<?php
include 'server.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {

session_start();

if(isset($_SESSION["username"])) {

    $request_code_id = $_POST["code"];
    $username = $_SESSION["username"];

    $stmt = $conn->prepare("SELECT * FROM upgrade_request WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    include 'encrypt.php';

    include 'key.php';

    $allow = "100%";

    $encryptedPrize = encryptPrize($allow, $key);

    $stmt1 = $conn->prepare("UPDATE user_accounts SET access_key = ? WHERE username = ?");
    $stmt1->bind_param("ss", $encryptedPrize, $username);
    $stmt1->execute();

    if ($result->num_rows > 0) {

        $accounts = $result->fetch_assoc();

        if ($request_code_id == $accounts["code"]) {

            $check = $conn->prepare("SELECT * FROM user_accounts WHERE username = ?");
            $check->bind_param("s", $accounts["username"]);
            $check->execute();
            $check_result = $check->get_result();


            if ($check_result->num_rows > 0) {

                $check_acc = $check_result->fetch_assoc();

                session_start();

                $_SESSION["username"] = $check_acc["username"];
                
                sleep(5);
                header("Location: creating_shop.php");
                

                $destroy_api = $conn->prepare("DELETE FROM upgrade_request WHERE username = ?");
                $destroy_api->bind_param("s", $check_acc["username"]);
                $destroy_api->execute();

                exit();

            }

        } else {

            $destroy_api = $conn->prepare("DELETE FROM upgrade_request WHERE username = ?");
            $destroy_api->bind_param("s", $accounts["username"]);
            $destroy_api->execute();

            session_start();

            include 'session_destroy.php';
        }

    }
    
} else {

    include 'session_destroy.php';


} 

} else {

    echo '<div style="width:100%; display: flex; justify-content: center;"><h1>Invalid Request :(</h1></div>';
    

}



?>
