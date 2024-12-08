<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

if(isset($_SESSION["username"])) {

    echo '<div style="width:100%; display: flex; justify-content: center;"><h1>Creating Shop Server Please Wait Redirecting 
    <span class="Animation">....</span> </h1></div>
    <style>
    
    .Animation {
        animation: blink 1s linear infinite;
    }

    @keyframes blink {
        0% {
            opacity: 1;
            width: 0%;
        }
        50% {
            opacity: 0;
            width: 50%;
        }
        100% {
            opacity: 1;
            width: 100%;
        }
    
    }
    
    </style>
   ';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e_commerce";

$conn = new mysqli($servername, $username, $password, $dbname);

$username = $_SESSION["username"];

$stmt = $conn->prepare("SELECT * FROM user_accounts WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

$default_name = " Shop";

$shop_name = $username . $default_name;

if ($result->num_rows > 0) {

    $accounts = $result->fetch_assoc();

    $stmt2 = $conn->prepare("INSERT INTO seller_shop (user_id, 	name, shop_name, username) VALUES (?, ?, ?, ?)");
    $stmt2->bind_param("isss", $accounts["id"], $accounts["fname"], $shop_name, $accounts["username"]);

    if ($stmt2->execute()) {

        $acc_lv_up = "Major";

        $stmt3 = $conn->prepare("UPDATE user_accounts SET acc_lv = ? WHERE id = ? ");
        $stmt3->bind_param("si", $acc_lv_up, $accounts["id"]);
        $stmt3->execute();

        session_destroy();

        session_start();

        $_SESSION["username"] = $accounts["username"];

        echo '<script>
        
            setTimeout(() => {
            window.location.href = "relocating.php";
            }, 2000)
        </script>
            
        ';

        exit();
    
        

    }

} else {

    session_destroy();
    echo '<script>
                alert("Authentication Failed Session Destroy")
                window.location.href = "login.html"
            </script>';
    sleep(2);

    exit();

}

$stmt->close();
$stmt2->close();
$stmt3->close();
$conn->closr();

} else {

    session_destroy();
    echo '<script>
                alert("Authentication Failed Session Destroy")
                window.location.href = "login.html"
            </script>';
    sleep(2);

    exit();

}



exit();

?>