<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e_commerce";
    
$conn = new mysqli($servername, $username, $password, $dbname);

if(!isset($_SESSION["username"])) {

    sleep(2);
    header("Location: login.html");
    exit();

} else {
    $request_code_id = $_POST["code"];
    $username = $_SESSION["username"];

    $stmt = $conn->prepare("SELECT * FROM user_accounts WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $accounts = $result->fetch_assoc();

        if ($request_code_id == $accounts["request_code"]) {

            sleep(2);
            header("Location: user.php");
            exit();
        } else {

            session_start();

            session_destroy();

            echo '<script>
                alert("Authentication Failed Session Destroy")
                window.location.href = "login.html"
            </script>';
        }

    }


} 

} else {

    echo '<div style="width:100%; display: flex; justify-content: center;"><h1>Invalid Request :(</h1></div>';

}



?>
