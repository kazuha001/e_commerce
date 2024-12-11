<?php
session_start();
session_destroy();
echo '<script>
        alert("Authentication Failed Session Destroy")
        window.location.href = "demo_login.php"
    </script>';
sleep(2);

exit();

?>