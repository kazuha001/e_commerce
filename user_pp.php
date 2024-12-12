<?php
include 'server.php';
session_start();

if (isset($_SESSION["username"])) {

    include 'encrypt.php';

    include 'key.php';

    $domain = decryptPrize($_SESSION["username"], $key);
    $session = $domain;

    $stmt = $conn->prepare("SELECT * FROM user_accounts WHERE username = ?");
    $stmt->bind_param("s", $session);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $accounts = $result->fetch_assoc();

        echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="icon" href="retrieve_img.php?user_id=' . $accounts["id"] . '" type="image/x-icon">
    <!-- CSS links -->
    <link rel="stylesheet" href="css/default.css">

    <link rel="stylesheet" href="css/user_pp.css">

</head>
<body>
    <div class="container">
        <div class="header">
            <div class="header_left">
                <div class="user_information">
                    <div class="header_left_img"><img src="retrieve_img.php?user_id=' . $accounts["id"] . '" alt="images"></div><!--Overlay-->
                    <p>UID: ' . $accounts["id"] . ' || ACC LV: ' . $accounts["acc_lv"] . '</p>
                    <h1>' . $accounts["fname"] . '</h1>
                    <h4>' . $accounts["email"] . '</h4>
                    <h3>' . $accounts["address"] . '</h3>
                    <form action="update_account.php">
                        <button>Edit Personal Information</button>
                    </form>
                </div>
            </div>
            <div class="header_right">
                <div class="header_right_top">
                    <h2>Options</h2>
                    <div class="header_right_top_support">
                        <div class="header_right_top_left" onclick="carts()">
                            <div class="header_right_top_left_img">
                                <div></div><!-- Overlay -->
                            </div>
                        </div>
                        <div class="header_right_top_right" onclick="homepage()">
                            <div class="header_right_top_right_img">
                                <div></div><!-- Overlay -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header_right_bottom">
                    <h2>Shop</h2>
                    <div class="header_right_bottom_support">
                        <div class="header_right_bottom_left" onclick="seller()">
                            <div class="header_right_bottom_left_img">
                                <div></div><!-- Overlay -->
                            </div>
                            
                        </div>
                        <div class="header_right_bottom_right">
                            <h3>Information Guide</h3>
                            <p>Being a Seller or<br> Shop Owner 
                            you need <br>to Activate to<br><u>Major Account Level</u> <br>
                            you are need to Contact <br> the Admin for
                            Account Upgrade</p>
                        </div>
                    </div>
    
                    
                </div>
            </div>
        </div>
    </div>
</body>
<script src="script/user_pp.js"></script>

';

    }

   
} else {

    
    include 'session_destroy.php';
    

}


?>
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



