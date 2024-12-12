<?php

// Configure session cookie parameters
session_set_cookie_params([
    'secure' => true,
    'httponly' => true,
    'samesite' => 'Strict'
]);


session_start();


header("Location: server_test.php");

?>