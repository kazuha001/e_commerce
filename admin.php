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
    
        echo '
    
        <!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Domain</title>
    
    <!-- CSS links -->
    <link rel="stylesheet" href="css/default.css">
    
    <!-- CSS admin -->
    <link rel="stylesheet" href="css/admin.css">
    
    </head>
    <body style="background-color: #1e1e1e;">
    <div class="container">
        <div class="overlay_burger_menu" id="burger_overlay">
           <div class="overlay_title"><h1>Admin Option</h1></div>
            <div class="overlay_burger_menu_function" onclick="user_request_code()"><h3>User Request Code</h3></div>
            <div class="overlay_burger_menu_function" onclick="restaurant_request_code()"><h3>Upgrade Request Code</h3></div>
            <div class="overlay_burger_menu_function" onclick="purchases_validation()"><h3>Confirm Purchases Validation</h3></div>
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
        <div class="content_profile">
            <div class="profile">
                <img src="css/Icons/personnel.gif" alt="png">
            </div>
            <div class="information">
                <h1>Information</h1>
                <div>
                    <label for="name">Name: </label>
                    <p id="name">' . $admin["fname"] . '</p>
                </div>
                <div>
                    <label for="status">Status: </label>
                    <p id="status">Admin</p>
                </div>
                <div>
                    <label for="access">Access Level: </label>
                    <p id="access">100%</p>
                </div>
                <div>
                    <form action="logout.php"><button>Log Out</button></form>
                </div>
                
            </div>
        </div>
    </div>
    </body>
    <footer>
    
    </footer>
    
    <script src="script/animation2.js"></script>
    
    </html>
    
        ';
        
    } else {
        
        include 'session_destroy.php';

    }


}


$conn->close();

?>


