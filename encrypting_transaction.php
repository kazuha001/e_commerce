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

    $session = $_SESSION["username"];

    $check = $conn->prepare("SELECT * FROM user_accounts WHERE username = ?");
    $check->bind_param("s", $session);
    $check->execute();
    $check_result = $check->get_result();

    if ($check_result->num_rows > 0) {

        $accounts = $check_result->fetch_assoc();

        $shop = $conn->prepare("SELECT * FROM seller_shop WHERE username = ?");
        $shop->bind_param("s", $accounts["username"]);
        $shop->execute();
        $shop_result = $shop->get_result();

        if ($shop_result->num_rows > 0) {

            $shop_acc = $shop_result->fetch_assoc();

            $shop_cff = $shop_acc["username"];

        } else {

            $shop_cff = "none";

        }

            include 'dencrypt.php';

            include 'key.php';

            $decryptedToken = decryptPrize($token_id, $key);

            $decryptedId = decryptPrize($productId, $key);

            $decryptedSeller = decryptPrize($seller_id, $key);

            if ($accounts["username"] !== $shop_cff) {

                
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

                $tax = "2.6% || " . $total_fee2;

                $process = "Carts";

                $stmt = $conn->prepare("INSERT INTO trans (user_id, seller_id, product_id, product_name, tax, prize, qty, process)
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?)
                ");
                $stmt->bind_param("iiisssss", $accounts["id"], $decryptedSeller, $decryptedId, $product_name, $tax, $total, $qty_id, $process);
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