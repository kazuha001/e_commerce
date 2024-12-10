<?php
include 'server.php';
include 'error.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

if (isset($_SESSION["username"])) {

    $session = $_SESSION["username"];

    $check = $conn->prepare("SELECT * FROM user_accounts WHERE username = ?");
    $check->bind_param("s", $session);
    $check->execute();
    $check_result = $check->get_result();

    if ($check_result->num_rows > 0) {

        $accounts = $check_result->fetch_assoc();

        $shop = $conn->prepare("SELECT * FROM seller_shop WHERE user_id = ?");
        $shop->bind_param("i", $accounts["id"]);
        $shop->execute();
        $shop_result = $shop->get_result();

        if ($shop_result->num_rows > 0) {

            $shop_acc = $shop_result->fetch_assoc();

            $product = $conn->prepare("SELECT * FROM products_view WHERE seller_id = ?");
            $product->bind_param("i", $shop_acc["id"]);
            $product->execute();
            $product_result = $product->get_result();

            if ($product_result->num_rows > 0) {

                $product_row = $product_result->fetch_all(MYSQLI_ASSOC);

                foreach ($product_row as $row) {

                    $delete_id = $_POST["delete_id"];
                    $stmt = $conn->prepare("DELETE FROM products_view WHERE id = ? AND seller_id = ?");
                    $stmt->bind_param("ii", $delete_id, $row["seller_id"]);
                    

                    if ($stmt->execute()) {
                        echo '
                        <script>
                        alert("Succesfully Delete the ID Number = ' . $delete_id . '")
                        window.location.href = "sell_products.php"
                        </script>

                    ';
                    } else {
                        echo '
                        <script>
                        alert("Invalid Request")
                        window.location.href = "sell_products.php"
                        </script>

                    ';
                    }

                    

                            
                }

                
                

            } else {

                include 'session_destroy.php';

            }

        } else {

            include 'session_destroy.php';

        }


    } else {

        include 'session_destroy.php';
        
    }

} else {

    include 'session_destroy.php';

}

} else {
    echo '<div style="width:100%; display: flex; justify-content: center;"><h1>Invalid Request :(</h1></div>';
}

?>