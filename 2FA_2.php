<?php
include 'server.php';
session_start();

if (isset($_SESSION["username"])) {

    $username = $_SESSION["username"];

    $stmt = $conn->prepare("SELECT * FROM user_accounts WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    $checkquery = $conn->prepare("SELECT COUNT(*) FROM upgrade_request WHERE username = ?");
    $checkquery->bind_param("i", $username);
    $checkquery->execute();
    $checkquery->bind_result($count);
    $checkquery->fetch();

    if ($count > 1) {

        echo '
            <script>
                alert("Too Many Request Contact the Admin for Consultation")
                window.location.href = "back1.php"
            </script>
        ';
        exit();
    } 

    $checkquery->close();

    if ($result->num_rows > 0) {

        $accounts = $result->fetch_assoc();

        if ($accounts["acc_lv"] == "Minor") {

        echo '

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2FA authentication code</title>

    <!-- CSS links -->
    
    <!-- Default css -->
    <link rel="stylesheet" href="css/default.css">
    
    <link rel="stylesheet" href="css/log_in_sign_up.css">
</head>
<body style="background-color: #000;">
    
    <div class="container">

        <!-- Forgot Password -->
        <div class="log_in">
            <div class="log_in_form" id="animation1">
                <div class="overlay_images"><img src="Icons/loginPp.gif" alt="gif"></div>
                <form action="api_protection_2.php" method="post">
                    <h1>2FA authentication <br> Account Upgrade</h1>
                    <div class="log_in_form_fill" id="redwarning">
                        <label for="username"> Enter Code:</label>
                        <div class="log_in_form_fill_overlay">
                            <div class="overlay_1"></div><!-- Overlay -->
                            <input type="text" id="code" name="code" placeholder="Activation code has been sent to your emails" required autocomplete="code">
                        </div>
                        
                    </div>
                   
                    <div class="log_in_form_button">
                        <div class="log_in_form_button_overlay">
                            <div class="overlay_14"></div><!-- Overlay -->
                            <button type="button" onclick="fback2()">Back</button>
                        </div>
                        <div class="log_in_form_button_overlay">
                            <div class="overlay_15"></div><!-- Overlay -->
                            <button type="submit">Submit</button>
                        </div>
                        
                        
                    </div>
                    
                </form>
            </div>

        </div>

    </div>

</body>
<footer>

</footer>
<script src="script/validating.js"></script>
</html>';
        } else {

        echo '<script>
                alert("Server SESSION DOWN!!! Unique Key Cannot be Duplicated in username Already Existed")
                window.location.href = "user_pp.php"
            </script>';
        sleep(2);

        exit();
    
        }



} else {
    
    include 'session_destroy.php';
    

    }

}





?>