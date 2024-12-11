<?php

session_destroy();

echo '
<script>
        alert("Due to 2 mins Inactive Session Destroy")
        window.location.href = "server_test.php"
    </script>
    
';

?>