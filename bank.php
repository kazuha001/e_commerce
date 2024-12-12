<?php

include 'server.php';

include 'error.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

$bank = $_POST["banking"];

$process = $_POST["process"];

include 'encrypt.php';

include 'key.php';

$decryptBank = decryptPrize($bank, $key);

$processKey = decryptPrize($process, $key);

if (empty($decryptBank)) {

    echo '
    
    <div style="width:100%; display: flex; justify-content: center;"><h1>No Data Fetching
<span class="Animation">...........</span> </h1>
</div>
<div style="width: 100% height: auto; display:flex; justify-content: center;"><img src="load/no-data.gif" style="width=: 120px; height: 120px;"></div>

    <style>
    
    .Animation {
        animation: blink 2s infinite;
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
    
    <script>
            
                setTimeout(() => {
                window.location.href = "ToPay.php";
                }, 6000)
            </script>
               
    
    ';

    exit();

}

if (isset($_SESSION["username"])) {

    $session = $_SESSION["username"];

    $check = $conn->prepare("SELECT * FROM user_accounts WHERE username = ?");
    $check->bind_param("s", $session);
    $check->execute();
    $check_result = $check->get_result();

    if ($check_result->num_rows > 0) {

        $check_acc = $check_result->fetch_assoc();

        $trans = $conn->prepare("SELECT * FROM trans WHERE user_id = ? AND process = ?");
        $trans->bind_param("is", $check_acc["id"], $processKey);
        $trans->execute();
        $trans_result = $trans->get_result();

        if ($trans_result->num_rows > 0) {

            $set = "Proccessing";

            $trans_acc = $trans_result->fetch_assoc();

            $stmt = $conn->prepare("UPDATE trans SET bank = ?, admin_conf = ? WHERE user_id = ?");
            $stmt->bind_param("ssi", $decryptBank, $set, $trans_acc["user_id"]);
            $stmt->execute();

            echo '
    
            <div style="width:100%; display: flex; justify-content: center;"><h1>Confirming SESSION Please Wait 
        <span class="Animation">...........</span> </h1>
        </div>
        <div style="width: 100% height: auto; display:flex; justify-content: center;"><img src="load/loading.gif" style="width=: 120px; height: 120px;"></div>
        
            <style>
            
            .Animation {
                animation: blink 2s infinite;
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
            
            <script>
                    
                        setTimeout(() => {
                        window.location.href = "ToPay.php";
                        }, 6000)
                    </script>
                        
                    ';

        } else{

            echo '
    
    <div style="width:100%; display: flex; justify-content: center;"><h1>No Data Fetching
<span class="Animation">...........</span> </h1>
</div>
<div style="width: 100% height: auto; display:flex; justify-content: center;"><img src="load/no-data.gif" style="width=: 120px; height: 120px;"></div>

    <style>
    
    .Animation {
        animation: blink 2s infinite;
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
    
    <script>
            
                setTimeout(() => {
                window.location.href = "ToPay.php";
                }, 6000)
            </script>
               
    
    ';


        }

    }else {

        include 'session_destroy.php';
        
    }

} else {

    include 'session_destroy.php';

}

} else {

    include 'session_destroy.php';

}


?>