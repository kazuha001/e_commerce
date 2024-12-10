<?php
include 'server.php';
session_start();

if(isset($_SESSION["username"])) {
    $username = $_SESSION["username"];

    $stmt = $conn->prepare("SELECT * FROM admin_account WHERE username = ?");
    $stmt->bind_param("s", $username);
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
            <div class="overlay_burger_menu_function" onclick="restaurant_request_code()"><h3>Restaurant Request Code</h3></div>
            <div class="overlay_burger_menu_function" onclick="purchases_validation()"><h3>Confirm Purchases Validation</h3></div>
            <div class="overlay_burger_menu_function" onclick="adminPP()"><img src="Icons/id-cardV2.png" alt=""><h3>Admin Profile</h3></div>
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
            <div class="companies_partner">
                <div class="tables_function">
                    <h1>Restaurant Request Code</h1>
                    <div class="tables_function_elements">
                        <table>
                            <thead>
                                <th style="width: 10%;">Restaurant Id</th>
                                <th style="width: 20%;">Restaurant Name</th>
                                <th style="width: 20%;">Owners Name</th>
                                <th style="width: 10%;">Request Code</th>
                                <th style="width: 10%;">Action</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Cordova</td>
                                    <td>Kazuha</td>
                                    <td>123456</td>
                                    <td style="display: flex; justify-content: center; align-items: center;">
                                        <form action="" method="POST">
                                            <button style="background-color: #0f0;">SEND</button>
                                        </form>
                                        <form action="" method="POST">
                                            <button style="background-color: #f00;">CANCEL</button>
                                        </form>
                                        <form action="" method="POST">
                                            <button style="background-color: #ff0;">See More Info</button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="graph">
           
            </div>
        </div>
    </div>
</body>
<footer>

</footer>

<script src="script/animation2.js"></script>

</html>';

} else {
    
    include 'session_destroy.php';
    }


}


$conn->close();

?>