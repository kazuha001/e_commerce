<?php
include 'server.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {

session_start();

if(isset($_SESSION["username"])) {

    $request_code_id = $_POST["code"];
    $username = $_SESSION["username"];

    $stmt = $conn->prepare("SELECT * FROM upgrade_request WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $accounts = $result->fetch_assoc();

        if ($request_code_id == $accounts["code"]) {

            $destroy_api = $conn->prepare("DELETE FROM upgrade_request WHERE id = ?");
            $destroy_api->bind_param("i", $accounts["id"]);
            $destroy_api->execute();

            session_start();
            sleep(2);
            header("Location: creating_shop.php");
            exit();

        } else {

            $destroy_api = $conn->prepare("DELETE FROM upgrade_request WHERE id = ?");
            $destroy_api->bind_param("i", $accounts["id"]);
            $destroy_api->execute();

            session_start();

            session_destroy();

            echo '<script>
                alert("Authentication Failed Session Destroy")
                window.location.href = "login.html"
            </script>';
        }

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

} else {

    echo '<div style="width:100%; display: flex; justify-content: center;"><h1>Invalid Request :(</h1></div>';

}



?>
