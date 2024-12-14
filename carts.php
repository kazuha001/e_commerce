<?php

include 'server.php';

session_start();

if (isset($_SESSION["username"])) {

    include 'encrypt.php';

    include 'key.php';

    $domain = decryptPrize($_SESSION["username"], $key);
    $session = $domain;

    $check = $conn->prepare("SELECT * FROM user_accounts WHERE username = ?");
    $check->bind_param("s", $session);
    $check->execute();
    $check_result = $check->get_result();

    if ($check_result->num_rows > 0) {

        $accounts = $check_result->fetch_assoc();
        
    } else {

        include 'session_destroy.php';

    }

} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Carts</title>
    <link rel="icon" href="Icons/grocery.png" type="image/x-icon">
    <!-- CSS links -->
    <link rel="stylesheet" href="css/default.css">

    <link rel="stylesheet" href="css/carts.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="header_top">
                <button onclick="back()"> &lt; Back</button>
            </div>
            <div class="header_bottom">
                <div>
                    <button onclick="carts()">Carts</button>
                    <button onclick="ToPay()">To Pay</button>
                    <button onclick="ToRecieve()">To Recieve</button>
                    <button onclick="ReturnRefund()">Return/Refund</button>
                    <button onclick="Complete()">Completed</button>
                    <span id="navigator"></span>
                </div>
                
            </div>
        </div>
        <div class="iframe_area">
            <div>
            <iframe id="Iframe_manipulated" src="carts_through.php" frameborder="0" style="width: 100%; height: 890px; margin: 10px;"></iframe>
            </div>
        </div>
    </div>
</body>
    <script src="script/animation4.js"></script>
</html>
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
