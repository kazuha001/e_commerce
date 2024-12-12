<?php

session_start();

session_unset();

session_destroy();

echo '
<script>
        alert("Due to 2 mins Inactive Session Destroy")
        window.location.href = "demo_login.php"
    </script>
    
';

?>