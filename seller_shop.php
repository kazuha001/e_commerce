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

        $stmt2 = $conn->prepare("SELECT * FROM seller_shop WHERE user_id = ?");
        $stmt2->bind_param("i", $accounts["id"]);
        $stmt2->execute();
        $result2 = $stmt2->get_result();

        if ($result2->num_rows > 0) {

            $shop_acc = $result2->fetch_assoc();

            $stmt3 = $conn->prepare("UPDATE seller_shop SET shop_name = ? WHERE user_id = ?");
            $stmt3->bind_param("si", $accounts["username"], $accounts["id"]);
            $stmt3->execute();

            echo '
            
            <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="Icons/supermarket.png" type="image/x-icon">
        <title>Seller Domain</title>
        
        <!-- CSS links -->
        <link rel="stylesheet" href="css/default.css">
    
        <!-- CSS admin -->
        <link rel="stylesheet" href="css/admin.css">
    
    </head>
    <body style="background-color: #1e1e1e;">
        <div class="container">
            <div class="overlay_burger_menu" id="burger_overlay">
                <div class="overlay_title"><h1>Seller Option</h1></div>
                <div class="overlay_burger_menu_function" onclick="ordered()"><h3>Ordered</h3></div>
                <div class="overlay_burger_menu_function" onclick="sell_product()"><h3>Sell Products</h3></div>
                <div class="overlay_burger_menu_function" onclick="seller_pp()"><img src="retrieve_img_shop.php?user_id=' . $shop_acc['username'] . '" alt=""><h3>Seller Profile</h3></div>
            </div><!-- Overlay -->
            <div class="header">
                <div class="overlay_burger" id="bugershow">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <div class="overlay_1"><img src="retrieve_img_shop.php?user_id=' . $shop_acc['username'] . '" alt="png" style="width: 100%; height: 100%;"></div><!-- Overlay -->
                <div class="title"><h2>Seller Tools</h2></div>
            </div>
            <div class="content_profile">
                <form id="myform" style="width: 50% height: 100%; display: flex; justify-content: center; align-items: center; flex-flow: column; margin: 10px;">
                <div class="profile">
                    <img id="upImg" src="retrieve_img_shop.php?user_id=' . $shop_acc['username'] . '" alt="png">
                </div>
                <div style="display: flex; justify-content: center; align-items: center;">
                <input id="uploadImg" type="file" name="img" accept="image/*" style="width: 50%; color: #fff;">
                <button style="cursor: pointer;">Upload Img</button>
                </div>
                </form>
                <div class="information">
                    <h1>Information</h1>
                    <div>
                        <label for="name">Name: </label>
                        <p id="name">' . $shop_acc["shop_name"] . '</p>
                    </div>
                    <div>
                        <label for="status">Status: </label>
                        <p id="status">Seller</p>
                    </div>
                    <div>
                        <label for="status">Username: </label>
                        <p id="status">' . $shop_acc["username"] . '</p>
                    </div>
                    <div>
                        <label for="status">Publish Time: </label>
                        <p id="status">' . $shop_acc["time"] . '</p>
                    </div>
                    <div>
                        <label for="access">UID: </label>
                        <p id="access">' . $shop_acc["id"] . '</p>
                    </div>
                    <div>
                        <form action="user.php"><button style="cursor: pointer;">Log Out</button></form>
                    </div>
                    
                </div>
            </div>
        </div>
    </body>
    <footer>
    
    </footer>
    
    <script src="script/shop.js"></script>
    
   
            
            ';


        $stmt->close();
        $stmt2->close();
        $stmt3->close();
        $conn->close();

        } else {
            
            echo '<script>
                        alert("Please Upgrade to Major to Access SHOP")
                        window.location.href = "user_pp.php"
                    </script>';
            sleep(2);
        }
          


    } else {

        include 'session_destroy.php';

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

