<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e_commerce";

$conn = new mysqli($servername, $username, $password, $dbname);

if (!isset($_SESSION["username"])) {

    echo '<script>
                alert("Authentication Failed Session Destroy")
            </script>';
    sleep(2);
    header("Location: login.html");

    exit();

} else {

    $username = $_SESSION["username"];

    $stmt = $conn->prepare("SELECT * FROM user_accounts WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

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
                            <button type="button" onclick="fback()">Back</button>
                        </div>
                        <div class="log_in_form_button_overlay">
                            <div class="overlay_15"></div><!-- Overlay -->
                            <button type="submit">Submit</button>
                        </div>
                        
                        
                    </div>
                    
                </form>
            </div>

        </div><!-- Forgot Password -->

    </div>

</body>
<footer>

</footer>
<script src="script/animation.js"></script>
<script src="script/validating.js"></script>
</html>';

    }

}





?>