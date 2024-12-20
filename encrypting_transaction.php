<?php
include 'server.php';

include 'error.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

$seller_id = $_POST["seller"];
$productId = $_POST["PRID"];
$org_prize_id = $_POST["org_prize"];
$qty_id = $_POST["qty"];
$token_id = $_POST["token"];

if (isset($_SESSION["username"])) {

    include 'encrypt.php';

    include 'key.php';

    $domain = decryptPrize($_SESSION["username"], $key);
    $session = $domain;

    $check = $conn->prepare("SELECT * FROM user_accounts WHERE username = ?");
    $check->bind_param("s", $session);
    $check->execute();
    $check_result = $check->get_result();

    if ($check_result->num_rows > 0) {

        $accounts = $check_result->fetch_assoc();

        $decryptedSeller = decryptPrize($seller_id, $key);   

        $decryptedToken = decryptPrize($token_id, $key);

        $decryptedId = decryptPrize($productId, $key);

        $seller = $conn->prepare("SELECT * FROM seller_shop WHERE id = ?");
        $seller->bind_param("i", $decryptedSeller);
        $seller->execute();
        $seller_result = $seller->get_result();

        if ($seller_result->num_rows > 0) {

            $seller_acc = $seller_result->fetch_assoc();

            $seller_name = $seller_acc["shop_name"];

            $seller->close();

        }

        $trans = $conn->prepare("SELECT * FROM trans WHERE product_id = ?");
        $trans->bind_param("i", $decryptedId);
        $trans->execute();
        $trans_result = $trans->get_result();

        if ($trans_result->num_rows > 0) {
            
            $trans_acc = $trans_result->fetch_assoc();

            if ($trans_acc["admin_conf"] != NULL) {

                echo '
                    <script>
                        alert("You have a Pending Request access denied")
                        window.location.href = "user.php"
                    </script>
                ';

                exit();

            } else {

                $checkquery = $conn->prepare("SELECT COUNT(*) FROM trans WHERE product_id = ?");
                $checkquery->bind_param("i", $decryptedId);
                $checkquery->execute();
                $checkquery->bind_result($count);
                $checkquery->fetch();
                

                if ($count > 0) {

                    echo '
                        <script>
                            alert("Please Cancelled this to add new quantity TRN: ' . $trans_acc["id"] . '")
                            window.location.href = "user.php"
                        </script>
                    ';

                    exit();
                }

                $checkquery->close();

            }

        }

        

            if ($accounts["username"] !== $seller_name) {

                $product = $conn->prepare("SELECT * FROM products_view WHERE id = ?");
                $product->bind_param("i", $decryptedId);
                $product->execute();
                $product_result = $product->get_result();


               if ($product_result->num_rows > 0) {

                   $result = $product_result->fetch_assoc();

                    $product_name = $result["product_name"];

                }

                if ($org_prize_id === $decryptedToken) {

                $total_qty = $decryptedToken * $qty_id;
                $total_fee2 = $total_qty * 0.0026;
                $total = $total_qty + $total_fee2;

                $tax = $total_fee2;

                $process = "Carts";

                $stmt = $conn->prepare("INSERT INTO trans (user_id, shop_name, seller_id, product_id, product_name, pr_price, tax, prize, qty, process)
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                ");
                $stmt->bind_param("isiissssss", $accounts["id"], $seller_name ,$decryptedSeller, $decryptedId, $product_name, $decryptedToken, $tax, $total, $qty_id, $process);
                if ($stmt->execute()) {
                    echo '<script>
                        alert("Added Succesfully!!!")
                        window.location.href = "user.php"
                    </script>';
                } else {
                    echo '<script>
                        alert("Encryption Key Is not Valid")
                        window.location.href = "user.php"
                    </script>';
                }
                

                } else {

                      echo '<script>
                          alert("Prize is Tampered....Access Key Denied")
                         window.location.href = "user.php"
                      </script>';

                }


            } else {

                echo '<script>
                    alert("Minors Only....Access Key Denied")
                   window.location.href = "user.php"
                </script>';

          }
          
       
        }

    }

}

?>