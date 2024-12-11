<?php

include 'server.php';

session_start();

if (isset($_SESSION["username"])) {

    $session = $_SESSION["username"];

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

                        include 'encrypt.php';

                        include 'key.php';

                        $process = "Carts";

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
                                            <button>Cancel</button>

                                        </div>
                                    </div>
                                ';

                               $result += $row["prize"];
                               
                                $result_id = $row["user_id"];

                                $process_id = $row["process"];

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

            <div class="controller">
                <?php

                echo '<h1 id="total">Total: ' . $result .  '</h1>';
                $encryptedUserId = encryptPrize($result_id, $key);
                $encryptedProcessId = encryptPrize($process_id, $key);
                echo '
                    <div>
                    <form action="confirming.php" method="post" style="width: auto; height: auto;">
                    <input type="hidden" id="process_key" name="process" value="' . $encryptedProcessId . '">
                    <input type="hidden" id="result" name="user_id" value="' . $encryptedUserId . '">
                    <button type="submit" class="bt1">Confirm</button>
                    </form>
                </div>
                ';
                
                ?>
            </div>
        </div>
    </div>
</body>
<script src="script/services.js"></script>
</html>