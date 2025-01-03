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
            <div class="title"><h2>Admin & Customer Service</h2></div>
        </div>
        <div class="content">
            <div class="user_request" id="">
                <div class="tables_function">
                    <h1>Upgrade Request Code</h1>
                    <div class="tables_function_elements">
                        <table>
                            <thead>
                                <th>User Id</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Access key</th>
                                <th>Time</th>
                                <th>Action</th>
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

        $stmt = $conn->prepare("SELECT * FROM upgrade_request");
        $stmt->execute();
        $stmt_result = $stmt->get_result();

        if ($stmt_result->num_rows > 0) {

            $stmt_api = $stmt_result->fetch_all(MYSQLI_ASSOC);

            foreach ($stmt_api as $rows){   

                echo '
                <tr>
                    <td>' . $rows["user_id"] . '</td>
                    <td>' . $rows["username"] . '</td>
                    <td>' . $rows["email"] . '</td>
                    <td><div style="width: 100px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis; margin: 10px;">' . $rows["access_key"] . '</div></td>
                    <td style="width: 100px; overflow: auto;">' . $rows["time"] . '</td>
                    <td style="display: flex; justify-content: center; align-items: center;">
                        <form id="sendmail">
                            <input type="hidden" name="to_email" value="' . $rows["email"] . '">
                            <input type="hidden" name="to_name" value="' . $rows["username"] . '">
                            <input type="hidden" name="message" value="This is your Activation Code ' . $rows["code"] . '">
                            <button style="background-color: #0f0;">CONFIRM</button>
                        </form>
                        <script>
                            // Add event listener to the form
                            document.getElementById("sendmail' . $rows["user_id"] . '").addEventListener("submit", function(event) {
                                event.preventDefault(); // Prevent default form submission behavior
                                
                                emailjs.sendForm("service_dfa7neq", "template_rwaoa8f", this)
                                .then(function(response) {
                                    alert("Email sent successfully! Status: " + response.status + ", Text: " + response.text);
                                }, function(error) {
                                    alert("Failed to send email! Error: " + error.text);
                                });
                            });

                        </script>
                        <form method="POST">
                            <input type="hidden" name="user_id" value="' . $rows["user_id"] . '">
                            <button style="background-color: #f00; type="submit" name="denied" ">DENIED</button>
                        </form>
                    </td>
                </tr>
            ';

            }
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                
                if (isset($_POST["denied"])) {
                    $user = $_POST["user_id"];
                    $stmt = $conn->prepare("DELETE FROM api_code WHERE user_id = ?");
                    $stmt->bind_param("i", $user);
                    $stmt->execute();
                    echo '
                        <script>
                            alert("Denied Order")
                            window.location.href = "admin_user.php"
                        </script>
                    ';
                }
        
            } 

            echo '
                </tbody>
                    </table>    
                    </div>
                </div>
            </div>
            ';
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
      
                $stmt = $conn->prepare("DELETE FROM upgrade_request WHERE username = ?");
                $stmt->bind_param("s", $rows["username"]);
                $stmt->execute();
            
                
           

            header("Location: ".$_SERVER['PHP_SELF']);
        
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


$conn->close();

?>

            
        </div>
    </div>
</body>
<footer>

</footer>

<script src="script/animation2.js"></script>

</html>