<?php

include 'server.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

if(isset($_SESSION["id"])) {

    include 'encrypt.php';

    include 'key.php';

    $domain = decryptPrize($_SESSION["id"], $key);

    $request_code_id = $_POST["code"];
    $username = $domain;

    $stmt = $conn->prepare("SELECT * FROM api_code WHERE user_id = ?");
    $stmt->bind_param("i", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $accounts = $result->fetch_assoc();

        if ($request_code_id == $accounts["code"]) {
            
            $check = $conn->prepare("SELECT * FROM user_accounts WHERE username = ?");
            $check->bind_param("s", $accounts["username"]);
            $check->execute();
            $check_result = $check->get_result();


            if ($check_result->num_rows > 0) {

                $check_acc = $check_result->fetch_assoc();
                session_unset();
                session_destroy();
                

                include 'key.php';

                $domain = encryptPrize($accounts["username"], $key);
                session_start();
                $_SESSION["username"] = $domain;
                $stmt4 = $conn->prepare("UPDATE user_accounts SET username_key = ? WHERE username = ?");
                $stmt4->bind_param("ss", $domain, $check_acc["username"]);
                $stmt4->execute();

                sleep(5);
                header("Location: updatepasswd.php");
                

                $destroy_api = $conn->prepare("DELETE FROM api_code WHERE username = ?");
                $destroy_api->bind_param("s", $accounts["username"]);
                $destroy_api->execute();

                exit();

            }

            
        } else {

            $destroy_api = $conn->prepare("DELETE FROM api_code WHERE username = ?");
            $destroy_api->bind_param("s", $accounts["username"]);
            $destroy_api->execute();
            session_start();

            session_destroy();

            include 'session_destroy.php';
        }

    }
    

} else {
    
    include 'session_destroy.php';

} 



} else {

    echo '<div style="width:100%; display: flex; justify-content: center;"><h1>Invalid Request :(</h1></div>';

}

$conn->close();

?>
