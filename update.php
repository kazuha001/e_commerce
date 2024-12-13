<?php
include 'server.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

session_start();

if(isset($_SESSION["username"])) {

    include 'encrypt.php';

    include 'key.php';

    $domain = decryptPrize($_SESSION["username"], $key);
    $session = $domain;
    $cu_password = $_POST["cu_password"];
    
    $check = $conn->prepare("SELECT * FROM user_accounts WHERE username = ?");
    $check->bind_param("s", $session);
    
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
                
                if ($check_accounts["acc_lv"] == "Minor") {

                    $code = str_pad(mt_rand(000000, 999999), 6, '0', STR_PAD_LEFT);
    
                    $r_code = $conn->prepare("INSERT INTO upgrade_request (user_id, username, email, code, access_key) VALUES (?, ?, ?, ?, ?)");
                    $r_code->bind_param("issss", $check_accounts["id"], $check_accounts["username"], $check_accounts["email"], $code, $_SESSION["username"]);
                    $r_code->execute();
                    
                    session_start();
                    $response = [
                        'success1' => true,
                        'message' => ' Redirecting Authentication'
                    ];
                    echo json_encode($response);
                    exit();


                } else {

                    $response = [
                        'success1' => false,
                        'message' => ' Cannot Procced Update Please Change No || Already ACC Major'
                    ];
                    echo json_encode($response);
                    exit();
                    session_start();

                }

                
    
            } else {

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
    
                $passwd_hash = password_hash($c_password1_id, PASSWORD_DEFAULT);
    
            } else {
    
                $passwd_hash = $check_accounts["passwd_hash"];
    
            }
            
            $stmt = $conn->prepare("UPDATE user_accounts 
            SET fname = ?, gender = ?, mnumber = ?, birthdate = ?, email = ?, address = ?, username = ?, passwd_hash = ?, img = ? 
            WHERE id = ?");
            $stmt->bind_param("sssssssssi", $fname_id, $gender_id, $number_id, $birth_id, $email_id, 
            $address_id, $username_id, $passwd_hash, $img_id, $check_accounts["id"]);

            if ($stmt->execute()) {
                
                $response = [
                    'success' => true,
                    'message' => ' Successfully Updated'
                ];
                echo json_encode($response);
                exit();

            } else {
                $response = [
                    'success' => false,
                    'message' => ' Invalid Inputs' . mysqli_error($conn)
                ];
                echo json_encode($response);
                exit();
            }


        }

            $check->close();
            $stmt->close();
    
        } else {
            $response = [
                'success' => false,
                'message' => ' Please Enter Current Password To Procced' . mysqli_error($conn)
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


    include 'session_destroy.php';
    
}

} else {

    echo '<div style="width:100%; display: flex; justify-content: center;"><h1>Invalid Request :(</h1></div>';

}



?>
