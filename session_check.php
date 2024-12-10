<?php

session_start();

if(isset($_SESSION["id"])) {

    $session = $_SESSION["id"];

    echo $session;

}

?>