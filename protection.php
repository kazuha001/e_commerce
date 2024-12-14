<?php

include 'server.php';

session_start();

if(isset($_SESSION["id"])) {

    $stmt = $conn->prepare("SELECT * FROM api_code WHERE access_key = ?");
    $stmt->bind_param("s", $_SESSION["id"]);
    $stmt->execute();
    $stmt_result = $stmt->get_result();

    if ($stmt_result->num_rows > 0) {

        echo '
            <script>
                setInterval(() => {
                    window.location.reload()
                }, 2000)
            </script>
        ';

    } else {

        echo '
            <script>
                alert("Admin denied your temporary access code")
            </script>
        ';
        session_unset();
        session_destroy();
    }

} else {
    echo '
            <script>
                alert("Admin denied your access temporary access code")
                setInterval(() => {
                    window.location.reload()
                }, 2000)
            </script>
        ';
}



?>