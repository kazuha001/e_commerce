<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cordy</title>
    
    <!-- Link to the Manifest file -->
    <link rel="manifest" href="/manifest.json">
    
    <!-- Add a theme color (this changes the color of the browser’s address bar) -->
    <meta name="theme-color" content="#000000">
    
</head>
<body>
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
</body>
<script src="script/app.js"></script>