<?php
include 'server.php';

include 'error.php';



session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

$process = $_POST["process"];

$user_id = $_POST["user_id"];


include 'dencrypt.php';

include 'key.php';

$decryptedUser = decryptPrize($user_id, $key);

$decryptedProcess = decryptPrize($process, $key);

$stmt = $conn->prepare("SELECT * FROM trans WHERE user_id = ? AND process = ?");
$stmt->bind_param("is", $decryptedUser, $decryptedProcess);
$stmt->execute();
$stmt_result = $stmt->get_result();

if ($stmt_result->num_rows > 0) {

    $stmt_acc = $stmt_result->fetch_assoc();
    
    $process_says = "to_pay";

    $change = $conn->prepare("UPDATE trans SET process = ? WHERE user_id = ?");
    $change->bind_param("si", $process_says, $decryptedUser);
    $change->execute();

    
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
                window.location.href = "directing.php";
                }, 2000)
            </script>
                
            ';

} else {

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
                window.location.href = "directing.php";
                }, 2000)
            </script>
               
    
    ';

}


} else {

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
                window.location.href = "directing.php";
                }, 2000)
            </script>
               
    
    ';
    

}



?>