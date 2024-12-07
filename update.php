<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e_commerce";

$conn = new mysqli($servername, $username, $password, $dbname);

if(isset($_SESSION["username"])) {

    $username = $_SESSION["username"];
    $cu_password = $_POST["cu_password"];
    
    $check = $conn->prepare("SELECT * FROM user_accounts WHERE username = ?");
    $check->bind_param("s", $username);
    
    $check->execute();
    $result = $check->get_result();
    
    if ($result->num_rows > 0) {
    
        $check_accounts = $result->fetch_assoc();
    
        if (password_verify($cu_password, $check_accounts["passwd_hash"])) {
    
            $fname_id = $_POST["fname"];
            $gender_id = $_POST["gender"];
            $number_id = $_POST["number"];
            $birth_id = $_POST["birth"];
            $email_id = $_POST["email"];
            $address_id = $_POST["address"];
            $username_id = $_POST["username"];
            $c_password1_id = $_POST["c_password1"];
            $upgrade_id = $_POST["upgrade"];
    
            if ($upgrade_id == "yes") {
    
                $code = str_pad(mt_rand(000000, 999999), 6, '0', STR_PAD_LEFT);
    
                $r_code = $conn->prepare("INSERT INTO upgrade_request (user_id, username, code) VALUES (?, ?, ?)");
                $r_code->bind_param("iss", $check_accounts["id"], $check_accounts["username"], $code);
                $r_code->execute();
    
               header("Location: 2FA_2.php");
    
            }
            
            
    
            if (isset($_FILES['img']) && $_FILES['img']['error'] === 0) {

                $img_tmp_name = $_FILES['img']['tmp_name'];

                if (is_uploaded_file($img_tmp_name)) {
                    
                    $img_data = file_get_contents($img_tmp_name);
            
                    $img_id = $img_data;
                } 

            }  else {

                $img_id = $check_accounts["img"];
            }

            
            if (!empty($c_password1_id)) {
    
                $passwd_hash = password_hash();
    
            } else {
    
                $passwd_hash = $check_accounts["passwd_hash"];
    
            }
            
            $acc_lv = "Minor";
            $stmt = $conn->prepare("UPDATE user_accounts 
            SET fname = ?, gender = ?, mnumber = ?, birthdate = ?, email = ?, address = ?, username = ?, passwd_hash = ?, acc_lv = ?, img = ? 
            WHERE id = ?");
            $stmt->bind_param("ssssssssssi", $fname_id, $gender_id, $number_id, $birth_id, $email_id, 
            $address_id, $username_id, $passwd_hash, $acc_lv, $img_id, $check_accounts["id"]);
            if ($stmt->execute()) {
                $response = [
                    'success' => true,
                    'message' => ' Successfully Updated'
                ];
                echo json_encode($response);
                exit();
                session_start();
                
                $_SESSION["username"] = $username_id;

            } else {
                $response = [
                    'success' => false,
                    'message' => ' Invalid Inputs' . mysqli_error($conn)
                ];
                echo json_encode($response);
                exit();
            }
            
    
            $check->close();
            $stmt->close();
    
        } else {
            $response = [
                'success' => false,
                'message' => ' Please Enter Current Password' . mysqli_error($conn)
            ];
            echo json_encode($response);
            exit();
        }
    
    } else {
    
        $response = [
            'success' => false,
            'message' => ' Invalid Parameters' . mysqli_error($conn)
        ];
        echo json_encode($response);
        exit();
    
        $check->close();
    }
    
    
   

} else {


    session_destroy();
    echo '<script>
        alert("Invalid Request SESSION DESTROY")
        window.location.href = "logout.php"
    </script>';
    
}

} else {

    echo '<div style="width:100%; display: flex; justify-content: center;"><h1>Invalid Request :(</h1></div>';

}



?>