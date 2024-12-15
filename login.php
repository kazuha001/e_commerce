<?php
include 'server.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if (isset($_SESSION["domain"])) {

if ($_SERVER["REQUEST_METHOD"] == "POST") {

if (isset($_POST["username"]) && isset($_POST["password"])) {

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
        
                    include 'encrypt.php';
        
                    include 'key.php';
        
                    $domain = encryptPrize($admin_accounts["username"], $key);
        
                    $_SESSION["username"] = $domain;
        
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
        
        $stmt = $conn->prepare("SELECT * FROM user_accounts WHERE username = ? OR email = ?");
        
        $stmt->bind_param("ss", $username_id, $username_id);
        
        $stmt->execute();
        
        $result = $stmt->get_result();
        
            if ($result->num_rows > 0) {
            
                $accounts = $result->fetch_assoc();
        
                if (password_verify($passwd_id, $accounts['passwd_hash'])) {
                    include 'encrypt.php';
        
                    include 'key.php';
        
                    $domain = encryptPrize($accounts["id"], $key);
        
                    $stmt2 = $conn->prepare("INSERT INTO api_code (user_id, username, email, code, access_key) VALUES (? , ?, ?, ?, ?)");
                    $stmt2->bind_param("issss", $accounts["id"], $accounts["username"], $accounts["email"], $code, $domain);
                    $stmt2->execute();
                    session_unset();
                    sleep(3);
                    session_start();
        
                    $_SESSION["id"] = $domain;
        
                    
                    header("Location: 2FA.php");
        
                    exit();
                    
                }   else {
            
                    echo '<script>
                        alert("Incorrect Password");
                        window.location.href = "demo_login.php";
                    </script>';
                    exit();
                }
            
                
                
                 
            }  else {
        
                echo '<script>
                alert("User Not Existed");
                window.location.href = "demo_login.php";
                </script>';
                exit();
         
             } 
    
    }  
   


$stmt->close();


} else if (isset($_POST["forgotpasswd"])) {

    $username_id = $_POST["forgotpasswd"];

    $code = str_pad(mt_rand(000000, 999999), 6, '0', STR_PAD_LEFT);
        
    $stmt = $conn->prepare("SELECT * FROM user_accounts WHERE username = ? OR email = ?");
    
    $stmt->bind_param("ss", $username_id, $username_id);
    
    $stmt->execute();
    
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
    
    $accounts = $result->fetch_assoc();
        
    include 'encrypt.php';

    include 'key.php';

    $domain = encryptPrize($accounts["id"], $key);

    $stmt4 = $conn->prepare("INSERT INTO api_code (user_id, username, email, code, access_key) VALUES (? , ?, ?, ?, ?)");
    $stmt4->bind_param("issss", $accounts["id"], $accounts["username"], $accounts["email"], $code, $domain);
    $stmt4->execute();
    session_unset();
    sleep(3);
    
    $_SESSION["id"] = $domain;

    session_start();

    header("Location: 2FA_3.php");

    exit();

    } else {
        
        echo '<script>
        alert("User Not Existed");
        window.location.href = "demo_login.php";
        </script>';
        exit();
 
     } 

    
}

} else {

    include 'session_destroy.php';

}

} else {

    echo '<script>
        alert("Invalid Domain Key")
    </script>';

    include 'session_destroy.php';

    echo '<div style="width:100%; display: flex; justify-content: center;"><h1>Invalid Request :(</h1></div>';

    exit();

}
$conn->close();

?>