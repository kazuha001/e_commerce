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

$process = "to_pay";

$trans = $conn->prepare("SELECT * FROM trans WHERE user_id = ? AND process = ?");
$trans->bind_param("is", $accounts["id"], $process);
$trans->execute();
$trans_result = $trans->get_result();

if ($trans_result->num_rows > 0) {

    $trans_final = $trans_result->fetch_all(MYSQLI_ASSOC);

    $result = 0;

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
        
        
        if ($trans_id["admin_conf"] !== NULL) {

            echo '
            
            <div style="width:100%; display: flex; justify-content: center;"><h1>Admin Confirming your request
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
                    $gcash = "Gcash";

                    $paymaya = "Paymaya";

                    $encryptBank1 = encryptPrize($gcash, $key);

                    $encryptBank2 = encryptPrize($paymaya, $key);

                    $encryptProcess = encryptPrize($trans_id["process"], $key);

                                echo '
                    <form action="bank.php" method="post">
                    <div class="controller">

                    <h1>Total: ' . $result . '</h1>
                    <input type="hidden" id="system" value="100">
                    <div>
                        <button class="bt1" type="submit">Pay</button>
                        <button class="bt2" name="cancel">Cancel</button>
                    </div>
                    </div>
                    <div class="payform" id="payform">
                    <img src="https://i.pinimg.com/originals/20/27/3c/20273cfda041b47e89e057a4c2296928.png" alt="gcash" style="width:60px; height: 60px; border-radius: 20px;">
                    <h4>Current Number: ' . $accounts["mnumber"] . '</h4>
                    <div>
                        <img src="https://th.bing.com/th/id/OIP.XWZuoYEF1vpD9nGA917kkgHaGi?rs=1&pid=ImgDetMain" alt="gcash" style="width:60px; height: 60px; border-radius: 20px;">
                        <input type="radio" name="banking" id="banking1" value="' . $encryptBank1 . '" required> <label for="banking1">Gcash</label>
                    </div>
                    <div>
                    <img src="https://th.bing.com/th/id/OIP.DqyXo_31Qw4CbG8V_caX-AHaHa?rs=1&pid=ImgDetMain" alt="gcash" style="width:60px; height: 60px; border-radius: 20px;">
                        <input type="radio" name="banking" id="banking2" value="' . $encryptBank2 . '" required> <label for="banking2">Maya</label>
                    </div>
                    </div>
                    <input type="hidden" name="process" id="process_key" value="' . $encryptProcess . '">
                    </form>
                    ';
     

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