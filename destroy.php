<?php

include 'server.php';

session_start();


if (isset($_SESSION["username"])){

    include 'encrypt.php';

    include 'key.php';

    $decryptUser = decryptPrize($_SESSION["username"], $key);

    $stmt = $conn->prepare("SELECT * FROM user_accounts WHERE username = ?");
    $stmt->bind_param("s", $decryptUser);
    $stmt->execute();
    $stmt_result = $stmt->get_result();

    if ($stmt_result->num_rows > 0) {

        $accounts = $stmt_result->fetch_assoc();

        $destroy = $conn->prepare("DELETE FROM trans WHERE user_id = ?");
        $destroy->bind_param("i", $accounts["id"]);
        $destroy->execute();

    }

    


}



?>