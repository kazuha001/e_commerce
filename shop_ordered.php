<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Domain</title>
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
                    

<?php
include 'server.php';
session_start();
include 'error.php';

if(isset($_SESSION["username"])) {
    include 'encrypt.php';

    include 'key.php';

    $domain = decryptPrize($_SESSION["username"], $key);
    $session = $domain;

    echo '<body style="background-color: #1e1e1e;">
    <div class="container">
        <div class="overlay_burger_menu" id="burger_overlay">
            <div class="overlay_title"><h1>Seller Option</h1></div>
            <div class="overlay_burger_menu_function" onclick="ordered()"><h3>Ordered</h3></div>
            <div class="overlay_burger_menu_function" onclick="sell_product()"><h3>Sell Products</h3></div>
            <div class="overlay_burger_menu_function" onclick="seller_pp()"><img src="retrieve_img_shop.php?user_id=' . $session. '" alt=""><h3>Seller Profile</h3></div>
        </div><!-- Overlay -->
        <div class="header">
            <div class="overlay_burger" id="bugershow">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="overlay_1"><img src="retrieve_img_shop.php?user_id=' . $session . '" alt="png" style="width: 100%; height: 100%;"></div><!-- Overlay -->
            <div class="title"><h2>Ordered</h2></div>
        </div>
        <div class="content">
            <div class="user_request" id="">
                <div class="tables_function">';

    $stmt = $conn->prepare("SELECT * FROM user_accounts WHERE username = ?");
    $stmt->bind_param("s", $session);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {

        $access_point = "Seller";
        $access_point2 = "ReturnRefund";
        $user = $conn->prepare("SELECT * FROM user_accounts WHERE request_order = ? OR request_order = ?");
        $user->bind_param("ss", $access_point, $access_point2);
        $user->execute();
        $user_result = $user->get_result();

        if ($user_result->num_rows > 0) {

            $acc = $user_result->fetch_all(MYSQLI_ASSOC);

            foreach ($acc as $row) {

                echo '
                <h1>User Request || ' . $row["username"] . '</h1>
                <div class="tables_function_elements">
                <table>
                    <thead>
                        <th>Trans ID</th>
                        <th>Username</th>
                        <th>Number</th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Admin Access</th>
                        <th>Time</th>
                    </thead>
                    <tbody>
                    ';
            $set = "Done";
            $set2 = "Delivered";
            $set3 = "Denied";
            $trans = $conn->prepare("SELECT * FROM trans WHERE user_id = ? AND admin_conf = ? OR admin_conf = ? OR admin_conf = ?");
            $trans->bind_param("isss", $row["id"], $set, $set2, $set3);
            $trans->execute();
            $trans_result = $trans->get_result();
            
            if ($trans_result->num_rows > 0) {

                $trans_acc = $trans_result->fetch_all(MYSQLI_ASSOC);
                $result = 0;
                foreach ($trans_acc as $row2) {

                    echo '
                    <tr>
                        <td style="height: 100px;">' . $row2["id"] . '</td>
                        <td>' . $row["username"] . '</td>
                        <td>' . $row["mnumber"] . '</td>
                        <td>' . $row2["product_name"] . '</td>
                        <td>' . $row2["pr_price"] . '</td>
                        <td>' . $row2["qty"] . '</td>
                        <td>' . $row2["prize"] . '</td>
                        <td>' . $row2["admin_conf"] . '</td>  
                        <td>' . $row2["date"] . '</td>
                    </tr>
                    ';
                    $result += $row2["prize"];
                }

            }
                if ($row2["admin_conf"] == "Done") {
                    echo '
                <div class="buttons_f">
                    <form method="POST">
                        <input type="hidden" name="user_id" value="' . $row["id"] . '">
                        <button style="background-color: #0f0; type="submit" name="confirm" ">Deliver</button>
                    </form>
                </div>
                <div class="buttons_f">
                    <h1 style="color: #fff;">Total: ' . $result . '</h1>
                </div>
                </tbody>
                </table>
                </div>
                ';
            } else if ($row2["admin_conf"] == "Denied") {

                echo '
                <div style="width:100%; display: flex; justify-content: center;"><p>Customer Denied Requesting Return and Refund
                <span class="Animation">...........</span></p>
                </div>
                <div style="width: auto; height: auto; display:flex; justify-content: center;"><img src="load/alert.gif" style="width=: 20px; height: 20px;"></div>
                
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


            } else {

                echo '
                    <div style="width:100%; display: flex; justify-content: center;"><p>Customer is Confirming
        <span class="Animation">...........</span> </p>
        </div>
        <div style="width: auto; height: auto; display:flex; justify-content: center;"><img src="load/loading.gif" style="width=: 20px; height: 20px;"></div>
        
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

            }
                

                

            }

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

} else {
    
    include 'session_destroy.php';

    }
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST["confirm"])) {
            $admin_conf = "Delivered";
            $process = "to_recieve";
            $user_id = $_POST["user_id"];
            $stmt = $conn->prepare("UPDATE trans SET admin_conf = ?, process = ? WHERE user_id = ?");
            $stmt->bind_param("ssi", $admin_conf, $process, $user_id);
            $stmt->execute();
            echo '
                <script>
                    alert("Confirming Order")
                    window.location.href = "shop_ordered.php"
                </script>
            ';
        }

    }

$conn->close();

?>

            
        </div>
    </div>
</body>
<footer>

</footer>

<script src="script/shop_graph2.js"></script>
<script>
       
       var domain = "' . htmlspecialchars($_SESSION["username"], ENT_QUOTES, 'UTF-8') . '";
       
       if (domain) {
           var newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + "?temporary?encryptedkey=" + encodeURIComponent(domain);
           
           
           window.history.pushState({path: newUrl}, "", newUrl);
           
           console.log("Current session data (temporary key) is now in the URL!");
       } else {
           console.log("No domain key found or invalid.");
       }
   
   
</script>

</html>