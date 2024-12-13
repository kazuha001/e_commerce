<?php
include 'server.php';
include 'error.php';
session_start();

if(isset($_SESSION["username"])) {

    echo '<div style="width:100%; display: flex; justify-content: center;"><h1>Creating Shop Server Redirecting Please Wait
<span class="Animation">...........</span> </h1>
</div>
<p>From this User id = ' . $_SESSION["username"] . '</p>
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

    $checkquery = $conn->prepare("SELECT COUNT(*) FROM seller_shop WHERE username = ?");
    $checkquery->bind_param("s", $session);
    $checkquery->execute();
    $checkquery->bind_result($count);
    $checkquery->fetch();
    

    if ($count > 0) {
        
        $checkquery->close();
        $destroy = $conn->prepare("DELETE FROM seller_shop WHERE username = ?");
        $destroy->bind_param("s", $session);
        $destroy->execute();

        $access_key_destroy = NULL;
        $acc_lv = "Minor";
        $access_key = $conn->prepare("UPDATE user_accounts SET acc_lv = ?, access_key = ? WHERE username = ?");
        $access_key->bind_param("sss", $acc_lv, $access_key_destroy, $session);
        $access_key->execute();

        echo '
            <script>
                alert("The Session Has Been Refresh Shop and Access Key Destroy")
                window.location.href = "logout.php"
            </script>
        ';
        exit();
    } 

    $checkquery->close();

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
        window.location.href = "index.php";
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