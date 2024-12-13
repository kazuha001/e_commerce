<?php

include 'server.php';
include 'error.php';
session_start();

if(isset($_SESSION["username"])) {
    echo '<div style="width:100%; display: flex; justify-content: center;"><h1>Confirming your ordered Please Wait
<span class="Animation">...........</span> </h1>
</div>
<p>From this User id = ' . $_SESSION["username"] . '</p>
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
   ';

    include 'encrypt.php';

    include 'key.php';

    $domain = decryptPrize($_SESSION["username"], $key);

    $session = $domain;

    $check = $conn->prepare("SELECT * FROM user_accounts WHERE username = ?");
    $check->bind_param("s", $session);
    $check->execute();
    $check_result = $check->get_result();

    if ($check_result->num_rows > 0) {

        $accounts = $check_result->fetch_assoc();

        if ($accounts["username_key"] === $_SESSION["username"]) {



        } else {
            echo '
            <script>
                alert("Access Denied your Tempory Connection has been Destroy")
            </script>
            ';
            echo '<div style="width:100%; display: flex; justify-content: center;"><h1>Invalid Request :(</h1></div>';
        }

    }

$conn->close();


} else {

    echo '
    <script>
        alert("Access Denied your Tempory Connection has been Destroy")
    </script>
    ';
    echo '<div style="width:100%; display: flex; justify-content: center;"><h1>Invalid Request :(</h1></div>';
}


?>
<script>
       
       var domain = "<?php echo htmlspecialchars($_SESSION["username"], ENT_QUOTES, 'UTF-8'); ?>";
       
       if (domain) {
           var newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + "?temporary?encryptedkey=" + encodeURIComponent(domain);
           
           
           window.history.pushState({path: newUrl}, '', newUrl);
           
           console.log("Current session data (temporary key) is now in the URL!");
       } else {
           console.log("No domain key found or invalid.");
       }
   
   
</script>