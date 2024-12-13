<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Domain</title>
    <link rel="icon" href="css/Icons/personnel.gif" type="image/x-icon">
    <!-- CSS links -->
    <link rel="stylesheet" href="css/default.css">

    <!-- CSS admin -->
    <link rel="stylesheet" href="css/admin.css">

    <script type="text/javascript"
        src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js">
    </script>
    <script type="text/javascript">
    (function(){
        emailjs.init({
            publicKey: "wgZgGUgUz1yKs1Lhv",
        });
    })();
    </script>

</head>
<body style="background-color: #1e1e1e;">
    <div class="container">
        <div class="overlay_burger_menu" id="burger_overlay">
        <div class="overlay_title"><h1>Admin Option</h1></div>
            <div class="overlay_burger_menu_function" onclick="user_request_code()"><h3>User Request Code</h3></div>
            <div class="overlay_burger_menu_function" onclick="restaurant_request_code()"><h3>Upgrade Request Code</h3></div>
            <div class="overlay_burger_menu_function" onclick="purchases_validation()"><h3>Confirm Purchases Validation</h3></div>
            <div class="overlay_burger_menu_function" onclick="adminPP()"><img src="css/Icons/id-cardV2.png" alt=""><h3>Admin Profile</h3></div>
        </div><!-- Overlay -->
        <div class="header">
            <div class="overlay_burger" id="bugershow">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="overlay_1"></div><!-- Overlay -->
            <div class="title"><h2>Admin & Customer Service</h2></div>
        </div>
        <div class="content">
            <div class="user_request" id="">
                <div class="tables_function">
                    <h1>User Request Code</h1>
                    <div class="tables_function_elements">
                        <table>
                            <thead>
                                <th style="width: 10%;">Trans Id</th>
                                <th style="width: 10%;">Username</th>
                                <th style="width: 10%;">Shop Name</th>
                                <th style="width: 10%;">Product Name</th>
                                <th style="width: 10%;">Price</th>
                                <th style="width: 10%;">Quantity</th>
                                <th style="width: 10%;">Total</th>
                                <th style="width: 10%;">Bank</th>
                                <th style="width: 10%;">Time</th>
                                <th style="width: 10%;">Action</th>
                            </thead>
                            <tbody>

<?php
include 'server.php';
session_start();

if(isset($_SESSION["username"])) {
    include 'encrypt.php';

    include 'key.php';

    $domain = decryptPrize($_SESSION["username"], $key);
    $session = $domain;

    $stmt = $conn->prepare("SELECT * FROM admin_account WHERE username = ?");
    $stmt->bind_param("s", $session);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $admin = $result->fetch_assoc();

        $process = "Proccessing";

        $stmt = $conn->prepare("SELECT * FROM trans WHERE admin_conf = ?");
        $stmt->bind_param("s", $process);
        $stmt->execute();
        $stmt_result = $stmt->get_result();

        

        if ($stmt_result->num_rows > 0) {

            $stmt_api = $stmt_result->fetch_all(MYSQLI_ASSOC);

            foreach ($stmt_api as $rows){

                $check = $conn->prepare("SELECT * FROM user_accounts WHERE id = ?");
                $check->bind_param("i", $rows["user_id"]);
                $check->execute();
                $check_result = $check->get_result();

                if ($check_result->num_rows > 0) {

                    $accounts = $check_result->fetch_assoc();
                    
                $shop = $conn->prepare("SELECT * FROM seller_shop WHERE id = ?");
                $shop->bind_param("i", $rows["seller_id"]);
                $shop->execute();
                $shop_result = $shop->get_result();

                if ($shop_result->num_rows > 0) {

                    $shop_acc = $shop_result->fetch_assoc();

                    $product = $conn->prepare("SELECT * FROM products_view WHERE id = ?");
                    $product->bind_param("i", $rows["product_id"]);
                    $product->execute();
                    $product_result = $product->get_result();

                    if ($product_result->num_rows > 0) {

                        $pr_result = $product_result->fetch_assoc();

                        $price = decryptPrize($pr_result["prize"], $key);

                        echo '
                        <tr>
                            <td>' . $rows["id"] . '</td>
                            <td>' . $accounts["username"] . '</td>
                            <td>' . $shop_acc["shop_name"] . '</td>
                            <td>' . $rows["product_name"] . '</td>
                            <td>' . $price . '</td>
                            <td>' . $rows["qty"] . '</td>
                            <td>' . $rows["prize"] . '</td>
                            <td>' . $rows["bank"] . '</td>
                            <td>' . $rows["date"] . '</td>
                            <td style="display: flex; justify-content: center; align-items: center;">
                                <form id="sendmail">
                                    <input type="hidden" name="to_email" value="' . $accounts["email"] . '">
                                    <input type="hidden" name="to_name" value="' . $accounts["username"] . '">
                                    <input type="hidden" name="message" value="Please Verify your ' . $rows["bank"] . ' number is ' . $accounts["mnumber"] . ' 
                                    click this to confirm your order http://localhost/e_commerce-main/verify_pay.php || access key = ' . $accounts["username_key"] . '">
                                    <button style="background-color: #0f0;">SEND</button>
                                </form>
                                <form method="POST">
                                    <button style="background-color: #f00;" type="submit">DENIED</button>
                                </form>
                            </td>
                        </tr>
                    ';
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      
                        $stmt = $conn->prepare("DELETE FROM trans WHERE id = ?");
                        $stmt->bind_param("i", $rows["id"]);
                        $stmt->execute();
                   
        
                    header("Location: ".$_SERVER['PHP_SELF']);
                
                } 
                    }
                    
                  

                }
                
                   

                }
        
                

            }

            echo '
                </tbody>
                    </table>    
                    </div>
                </div>
            </div>
            ';

        } else {
            echo '
            </tbody>
                    </table>    
                    </div>
                </div>
            </div>
            <div class="graph">
                <h1>No Data</h1>
                <img src="load/no-content.png" alt="No Content">
            </div>
             
        ';
        }

      

} else {
    
    include 'session_destroy.php';

    }


}


$conn->close();

?>

            
        </div>
    </div>
</body>
<footer>

</footer>
<script src="script/sendmail.js"></script>
<script src="script/animation2.js"></script>

</html>