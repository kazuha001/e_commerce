<?php
include 'server.php';

session_start();

if (isset($_SESSION["id"])) {

    $username = $_SESSION["id"];

    $stmt = $conn->prepare("SELECT * FROM user_accounts WHERE id = ?");
    $stmt->bind_param("i", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    $checkquery = $conn->prepare("SELECT COUNT(*) FROM api_code WHERE user_id = ?");
    $checkquery->bind_param("i", $username);
    $checkquery->execute();
    $checkquery->bind_result($count);
    $checkquery->fetch();

    if ($count > 1) {

        echo '
            <script>
                alert("Too Many Request Contact the Admin for Consultation")
                window.location.href = "back.php"
            </script>
        ';
        exit();
    } 

    $checkquery->close();

    if ($result->num_rows > 0) {

        $accounts = $result->fetch_assoc();

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
                <form action="api_protection.php" method="post">
                    <h1>2FA authentication</h1>
                    <div class="log_in_form_fill" id="redwarning">
                        <label for="username"> Enter Code:</label>
                        <div class="log_in_form_fill_overlay">
                            <div class="overlay_1"></div><!-- Overlay -->
                            <input type="text" id="code" name="code" placeholder="Code has been sent to your emails" required autocomplete="code">
                        </div>
                        
                    </div>
                   
                    <div class="log_in_form_button">
                        <div class="log_in_form_button_overlay">
                            <div class="overlay_14"></div><!-- Overlay -->
                            <button type="button" onclick="fback1()">Back</button>
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
    
    include 'session_destroy.php';

    }

}





?>