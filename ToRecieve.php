<?php

include 'server.php';

include 'error.php';

session_start();

if (isset($_SESSION["username"])) {

    include 'encrypt.php';

    include 'key.php';

    $domain = decryptPrize($_SESSION["username"], $key);
    $session = $domain;

    $check = $conn->prepare("SELECT * FROM user_accounts WHERE username = ?");
    $check->bind_param("s", $session);
    $check->execute();
    $check_result = $check->get_result();

    

} else {

    include 'session_destroy.php';

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS Links -->
    <link rel="stylesheet" href="css/default.css">

    <link rel="stylesheet" href="css/navigation.css">
</head>
<body>
    <div class="container">
        <div class="content">
            <div class="content_items">

            <?php

            if ($check_result->num_rows > 0) {

$accounts = $check_result->fetch_assoc();

$process = "to_recieve";

$trans = $conn->prepare("SELECT * FROM trans WHERE user_id = ? AND process = ?");
$trans->bind_param("is", $accounts["id"], $process);
$trans->execute();
$trans_result = $trans->get_result();

if ($trans_result->num_rows > 0) {

    $trans_final = $trans_result->fetch_all(MYSQLI_ASSOC);

    $result = 0;
    $tax = 0;
    foreach ($trans_final as $row) {
        
        echo '
            <div class="items">
                <div class="items_img">
                    <img src="product_img.php?user_id=' . $row["product_id"] . '" alt="images">
                </div>
                <div class="status">
                    <h2>' . $row["product_name"] . '</h2>
                    <h4>Total Price: ' . $row["prize"] . '</h4>
                    <h4>Quantity: ' . $row["qty"] . '</h4><p style="font-size: 12px;">TRID: ' . $row["id"] . ' // Fee: ' . $row["tax"] . '</p>
                    <p>' . $row["date"] . '</p>
                    <h3>' . $row["admin_conf"] . ' ' . $row["bank"] . '</h3>
                </div>
            </div>
        ';

       $result += $row["prize"];
       $tax += $row["tax"];
        $result_id = $row["user_id"];

        $process_id = $row["process"];

    }   
    
    
    

        echo '</div>';
    
    $trans = $conn->prepare("SELECT * FROM trans WHERE user_id = ?");
    $trans->bind_param("i", $accounts["id"]);
    $trans->execute();
    $trans_result = $trans->get_result();

    if ($trans_result->num_rows > 0) {

        $trans_id = $trans_result->fetch_assoc();
        
        
        if ($trans_id["admin_conf"] != "Delivered") {

            echo '
            
            <div style="width:100%; display: flex; justify-content: center;"><h1>Seller Preparing your Order
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

            <script>
                setInterval(() => {
                    window.location.reload()
                }, 2000)
            </script>
                        
            ';

        } else {

            echo '
            <form method="post">
            <div class="controller">

            <h1>Total: ' . $result . '</h1>
            <div>
                <button class="bt1" type="submit" name="recieve">Receive</button>
                <button class="bt2" type="return" name="return">Return/Refund</button>
            </div>
            
            </form>
            ';
     

        }
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(isset($_POST["recieve"])) {
                $set = "Recieve";
                $set2 = "Complete";
                $set3 = NULL;
                $done = $conn->prepare("UPDATE trans SET process = ?, admin_conf = ? WHERE user_id = ?");
                $done->bind_param("ssi", $set2, $set, $trans_id["user_id"]);
                $done->execute();
                $done1 = $conn->prepare("UPDATE user_accounts SET request_order = ? WHERE id = ?");
                $done1->bind_param("si", $set3, $trans_id["user_id"]);
                $done1->execute();
                $result_tax = $result - $tax;
                $done2 = $conn->prepare("UPDATE seller_shop SET balance = ? WHERE id = ?");
                $done2->bind_param("si", $result_tax, $trans_id["seller_id"]);
                $done2->execute();
                echo '
                <script>
                    alert("Ordered Recieved")
                    window.location.href = "ToRecieve.php"
                </script>
            ';

            }

            if (isset($_POST["return"])) {
                $set = "Denied";
                $set2 = "Return";
                $set3 = "ReturnRefund";
                $done = $conn->prepare("UPDATE trans SET process = ?, admin_conf = ? WHERE user_id = ?");
                $done->bind_param("ssi", $set2, $set, $trans_id["user_id"]);
                $done->execute();
                $done1 = $conn->prepare("UPDATE user_accounts SET request_order = ? WHERE id = ?");
                $done1->bind_param("si", $set3, $trans_id["user_id"]);
                $done1->execute();
                echo '
                <script>
                    alert("Request Refund")
                    window.location.href = "ToRecieve.php"
                </script>';
            }

        }

    } else {

        include 'session_destroy.php';
        
    }


    
       
} else {

    echo '
            <h1>&nbsp;Empty....</h1>
        ';

}

} else {

include 'session_destroy.php';

}
            

            ?>
        </div>
    </div>
</body>
<script src="script/services.js"></script>
</html>