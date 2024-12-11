<?php
include 'server.php';
session_start();

if (isset($_SESSION["username"])) {

    $username = $_SESSION["username"];

    $stmt = $conn->prepare("SELECT * FROM user_accounts WHERE username = ?");
    $stmt->bind_param("s", $username);
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

            $new_name = $shop_acc["username"] . " Shop";

            $stmt3 = $conn->prepare("UPDATE seller_shop SET shop_name = ? WHERE user_id = ?");
            $stmt3->bind_param("si", $new_name, $accounts["id"]);
            $stmt3->execute();

            echo '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Domain</title>
    <link rel="icon" href="Icons/supermarket.png" type="image/x-icon">
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
            <div class="overlay_burger_menu_function" onclick="seller_pp()"><img src="Icons/id-cardV2.png" alt=""><h3>Seller Profile</h3></div>
        </div><!-- Overlay -->
        <div class="header">
            <div class="overlay_burger" id="bugershow">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="overlay_1"><img src="retrieve_img_shop.php?user_id=' . $shop_acc['username'] . '" alt="png" style="width: 100%; height: 100%;"></div><!-- Overlay -->
            <div class="title"><h2>User Ordered</h2></div>
        </div>
        <div class="content">
            <div class="user_request" id="">
                <div class="tables_function">
                    <h1>User Ordered</h1>
                    <div class="tables_function_elements">
                        <table>
                            <thead>
                                <th style="width: 10%;">User Id</th>
                                <th style="width: 20%;">Name</th>
                                <th style="width: 20%;">Address</th>
                                <th style="width: 10%;">Product ID</th>
                                <th style="width: 20%;">Product Name</th>
                                <th style="width: 10%;">Qty</th>
                                <th style="width: 10%;">Prize</th>
                                <th style="width: 10%;">Action</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Cordova Marc Giestin Louis</td>
                                    <td>Prk. Bayanihan Brgy. Banago Bacolod City</td>
                                    <td>123456</td>
                                    <td>Dumplings</td>
                                    <td>10</td>
                                    <td>1000</td>
                                    <td style="display: flex; justify-content: center; align-items: center;">
                                        <form action="" method="POST">
                                            <button style="background-color: #0f0;">CONFIRM</button>
                                        </form>
                                        <form action="" method="POST">
                                            <button style="background-color: #f00;">CANCEL</button>
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

<script src="script/shop.js"></script>

</html>';


$stmt->close();
$stmt2->close();
$stmt3->close();
$conn->close();

} else {
    include 'session_destroy.php';

}
  


} else {

    include 'session_destroy.php';

}


} else {
    include 'session_destroy.php';
}






?>