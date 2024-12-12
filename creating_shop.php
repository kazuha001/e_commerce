<?php
include 'server.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

if(isset($_SESSION["username"])) {

    echo '<div style="width:100%; display: flex; justify-content: center;"><h1>Creating Shop Server Redirecting Please Wait
<span class="Animation">...........</span> </h1>
</div>
<div style="width: 100% height: auto; display:flex; justify-content: center;"><img src="load/loading.gif" style="width=: 120px; height: 120px;"></div>

    <style>
    
    .Animation {
        animation: blink 2s infinite;
    }

    @keyframes blink {
        0% {
            opacity: 1;
            width: 0%;
        }
        50% {
            opacity: 0;
            width: 50%;
        }
        100% {
            opacity: 1;
            width: 100%;
        }
    
    }
    
    </style>
   ';

   include 'encrypt.php';

   include 'key.php';

   $domain = decryptPrize($_SESSION["username"], $key);

   $session = $domain;

$allow = "100%";

$stmt = $conn->prepare("SELECT * FROM user_accounts WHERE username = ?");
$stmt->bind_param("s", $session);
$stmt->execute();
$result = $stmt->get_result();


if ($result->num_rows > 0) {

    $accounts = $result->fetch_assoc();

    $decrypted = decryptPrize($accounts['access_key'], $key);

    if ($decrypted === $allow) {

        $stmt2 = $conn->prepare("INSERT INTO seller_shop (user_id, 	name, shop_name, username, address) VALUES (?, ?, ?, ?, ?)");
        $stmt2->bind_param("issss", $accounts["id"], $accounts["fname"], $accounts["username"], $accounts["username"], $accounts["address"]);
    
        if ($stmt2->execute()) {
    
            $acc_lv_up = "Major";
    
            $stmt3 = $conn->prepare("UPDATE user_accounts SET acc_lv = ? WHERE id = ? ");
            $stmt3->bind_param("si", $acc_lv_up, $accounts["id"]);
            $stmt3->execute();
    
            session_start();
    

    
            echo '<script>
            
                setTimeout(() => {
                window.location.href = "relocating.php";
                }, 2000)
            </script>
                
            ';
    
            exit();
        
            
    
        }

    } else {

        session_destroy();
        echo '<script>
        alert("Invalid Access Key!!!!")
        window.location.href = "demo_login.php";
        </script>
        
        
    ';
        sleep(2);
    }

   

} else {

    include 'session_destroy.php';

}

$stmt->close();
$stmt2->close();
$stmt3->close();
$conn->closr();

} else {

    include 'session_destroy.php';

}



exit();

?>