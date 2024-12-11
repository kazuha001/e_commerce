<?php

include 'server.php';

session_start();

session_destroy();

sleep(4);

header("Location: index.php");

$conn->close();


exit();
?>