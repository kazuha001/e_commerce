<?php

session_start();

session_unset();

session_destroy();

echo '
<script>
        alert("Due to 500 sec Inactive Session Destroy")
        window.location.href = "demo_login.php"
    </script>
    
';

?>