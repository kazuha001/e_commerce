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
            <div class="overlay_burger_menu_function" onclick="bank_confirm()"><h3>Request Payment</h3></div>
            <div class="overlay_burger_menu_function" onclick="adminPP()"><img src="css/Icons/id-cardV2.png" alt=""><h3>Admin Profile</h3></div>
        </div><!-- Overlay -->
        <div class="header">
            <div class="overlay_burger" id="bugershow">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="overlay_1"></div><!-- Overlay -->
            <div class="title"><h2>Request Payment</h2></div>
        </div>
        <div class="content">
            <div class="user_request" id="">
                <div class="tables_function">
                
                    

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

        $access_point = "Ordering2";
        $access_denied = "ReturnRefund";
        $user = $conn->prepare("SELECT * FROM user_accounts WHERE request_order = ? OR request_order = ?");
        $user->bind_param("ss", $access_point, $access_denied);
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
                        <th>Payment Method</th>
                        <th>Request</th>
                        <th>Time</th>
                    </thead>
                    <tbody>
                    ';
            $set = "Confirming";
            $set2 = "Denied";
            $trans = $conn->prepare("SELECT * FROM trans WHERE user_id = ? AND admin_conf = ? OR admin_conf = ?");
            $trans->bind_param("sss", $row["id"], $set, $set2);
            $trans->execute();
            $trans_result = $trans->get_result();
            
            if ($trans_result->num_rows > 0) {

                $trans_acc = $trans_result->fetch_all(MYSQLI_ASSOC);
                $result = 0;
                foreach ($trans_acc as $row2) {

                    echo '
                    <tr>
                        <td style="height: 70px;">' . $row2["id"] . '</td>
                        <td>' . $row["username"] . '</td>
                        <td>' . $row["mnumber"] . '</td>
                        <td>' . $row2["product_name"] . '</td>
                        <td>' . $row2["pr_price"] . '</td>
                        <td>' . $row2["qty"] . '</td>
                        <td>' . $row2["prize"] . '</td>
                        <td>' . $row2["bank"] . '</td>
                        <td>' . $row2["admin_conf"] . '</td>
                        <td>' . $row2["date"] . '</td>
                    </tr>
                    ';
                    $result += $row2["prize"];
                }

            }

                echo '
                <div class="buttons_f">
                    <form id="sendmail">
                        <input type="hidden" name="to_email" value="' . $row["email"] . '">
                        <input type="hidden" name="to_name" value="' . $row["username"] . '">
                        <input type="hidden" name="message" value="Hellow, please confirm your number ' . $row["mnumber"] . '
                        click this link http://localhost/e_commerce-main/verify_pay.php your total payment is ' . $result . '">
                        <button style="background-color: #0f0;">SEND Request</button>
                    </form>
                    <form method="POST">
                        <input type="hidden" name="user_id" value="' . $row["id"] . '">
                        <button style="background-color: #ff0; type="submit" name="confirm" ">Confirm</button>
                    </form>
                    <form method="POST">
                        <input type="hidden" name="user_id" value="' . $row["id"] . '">
                        <button style="background-color: #f00; type="submit" name="denied" ">DENIED</button>
                    </form>
                </div>
                <div class="buttons_f">
                    <h1 style="color: #fff;">Total: ' . $result . '</h1>
                </div>
                </tbody>
                </table>
                </div>
                ';

                

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
            $admin_conf = "Done";
            $process = "to_recieve";
            $user_re = "Seller";
            $user_id = $_POST["user_id"];
            $stmt = $conn->prepare("UPDATE trans SET admin_conf = ?, process = ? WHERE user_id = ?");
            $stmt->bind_param("ssi", $admin_conf, $process, $user_id);
            $stmt->execute();
            $stmt1 = $conn->prepare("UPDATE user_accounts SET request_order = ? WHERE id = ?");
            $stmt1->bind_param("si", $user_re, $user_id);
            $stmt1->execute();

            echo '
                <script>
                    alert("Confirming Order")
                    window.location.href = "admin_confirming.php"
                </script>
            ';
        }
        if (isset($_POST["denied"])) {
            $user_re = NULL;
            $user_id = $_POST["user_id"];
            $stmt = $conn->prepare("DELETE FROM trans WHERE user_id = ?");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $stmt1 = $conn->prepare("UPDATE user_accounts SET request_order = ? WHERE id = ?");
            $stmt1->bind_param("si", $user_re, $user_id);
            $stmt1->execute();
            echo '
                <script>
                    alert("Denied Order")
                    window.location.href = "admin_confirming.php"
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
<script src="script/sendmail.js"></script>
<script src="script/animation2.js"></script>

</html>