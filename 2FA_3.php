<?php
echo '<script>
            
setInterval(() => {
window.location.href = "back2.php"
alert("1 mins Given Temporary key has been Denied")
}, 60000)

</script>';
include 'server.php';
session_start();

if (isset($_SESSION["id"])) {

    include 'encrypt.php';

    include 'key.php';

    $domain = decryptPrize($_SESSION["id"], $key);
    $session = $domain;

    $stmt = $conn->prepare("SELECT * FROM user_accounts WHERE id = ?");
    $stmt->bind_param("i", $session);
    $stmt->execute();
    $result = $stmt->get_result();

    $checkquery = $conn->prepare("SELECT COUNT(*) FROM api_code WHERE user_id = ?");
    $checkquery->bind_param("i", $session);
    $checkquery->execute();
    $checkquery->bind_result($count);
    $checkquery->fetch();

    if ($count > 1) {

        echo '
            <script>
                alert("Too Many Request Contact the Admin for Consultation")
                window.location.href = "back2.php"
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
    <link rel="icon" href="css/Icons/id-card.png" type="image/x-icon">
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
                <div class="overlay_images"><img src="css/Icons/loginPp.gif" alt="gif"></div>
                <form action="api_protection_3.php" method="post">
                    <h1>2FA authentication <br> Forgot Password</h1>
                    <div class="log_in_form_fill" id="redwarning">
                        <label for="username"> Enter Code:</label>
                        <div class="log_in_form_fill_overlay">
                            <div class="overlay_1"></div><!-- Overlay -->
                            <input type="text" id="code" name="code" placeholder="Confrimation Reset code has been sent to your emails" required autocomplete="code">
                        </div>
                        
                    </div>
                   
                    <div class="log_in_form_button">
                        <div class="log_in_form_button_overlay">
                            <div class="overlay_14"></div><!-- Overlay -->
                            <button type="button" onclick="fback3()">Back</button>
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
';
     


} else {
    
    include 'session_destroy.php';
    

    }
}

?>
<iframe src="protection3.php" style="display: none;"></iframe>
<script>
       
       var domain = "<?php echo htmlspecialchars($_SESSION["username"], ENT_QUOTES, 'UTF-8'); ?>";
       
       if (domain) {
           var newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + "?temporary?encryptedkey=" + encodeURIComponent(domain);
           
           
           window.history.pushState({path: newUrl}, '', newUrl);
           
           console.log("Current session data (temporary key) is now in the URL!");
       } else {
           console.log("No domain key found or invalid.");
       }
   
   
</script>
</html>