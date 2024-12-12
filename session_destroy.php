<?php
session_start();
session_unset();
session_destroy();
echo '<script>
        alert("Authentication Failed Session Destroy")
        window.location.href = "index.php"
    </script>';
sleep(2);

exit();

?>
