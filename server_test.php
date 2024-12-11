<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e_commerce";

$conn = new mysqli($servername, $username, $password, $dbname);

include 'error.php';

include 'encrypt.php';

include 'key.php';

$domain = $_SERVER['HTTP_HOST'];

$encryptServer = encryptPrize($domain, $key);

session_start();

$_SESSION["domain"] = $encryptServer;

if ($conn->connect_error) {

    die ("Error: " . $conn->connect_error);

} else {

    echo '<div style="width:100%; display: flex; justify-content: center;"><h1 style="font-size: 16px;">SERVER Connected
<span class="Animation">...........</span>   ' . $encryptServer . ' Given Key Making Session Access</h1>
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
            window.location.href = "demo_login.php"
            }, 20000)
        </script>
    
           
';

}   




?>