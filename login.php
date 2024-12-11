<?php
include 'server.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if (isset($_SESSION["domain"])) {



if ($_SERVER["REQUEST_METHOD"] == "POST") {

$username_id = $_POST["username"];
$passwd_id = $_POST["password"];

if ($username_id == "admin") {

    $identifyer = "1";

    $stmt3 = $conn->prepare("SELECT * FROM admin_account WHERE id = ?");
    $stmt3->bind_param("i", $identifyer);
    $stmt3->execute();
    $stmt3_result = $stmt3->get_result();

    if ($stmt3_result->num_rows > 0) {

        $admin_accounts = $stmt3_result->fetch_assoc();

        if ($passwd_id == $admin_accounts["password"]) {

            session_start();

            $_SESSION["username"] = $admin_accounts["username"];

            header("Location: admin.php");

            exit();

        } else {

            echo '<script>
                alert("Invalid Actions");
                window.location.href = "demo_login.php";
            </script>';
            exit();

        }

    }

} else {

$code = str_pad(mt_rand(000000, 999999), 6, '0', STR_PAD_LEFT);

$stmt = $conn->prepare("SELECT * FROM user_accounts WHERE username = ?");

$stmt->bind_param("s", $username_id);

$stmt->execute();

$result = $stmt->get_result();

    if ($result->num_rows > 0) {
    
        $accounts = $result->fetch_assoc();
    
        if (password_verify($passwd_id, $accounts['passwd_hash'])) {
    
            $stmt2 = $conn->prepare("INSERT INTO api_code (user_id, username, code) VALUES (? , ?, ?)");
            $stmt2->bind_param("iss", $accounts["id"], $accounts["username"], $code);
            $stmt2->execute();

            sleep(3);
            session_start();

            $_SESSION["id"] = $accounts["id"];

            header("Location: 2FA.php");
            exit();
            
        } else {
    
            echo '<script>
                alert("Incorrect Password");
                window.location.href = "demo_login.php";
            </script>';
            exit();
        }
    
    } else {

        echo '<script>
        alert("User Not Existed");
        window.location.href = "demo_login.php";
        </script>';
        exit();

    }


$stmt->close();
$stmt2->close();
$conn->close();

}

} else {

    include 'session_destroy.php';

}

} else {

    session_destroy();

    echo '<script>
        alert("Invalid Domain Key")
    </script>';

    echo '<div style="width:100%; display: flex; justify-content: center;"><h1>Invalid Request :(</h1></div>';

    exit();

}


?>