<?php

function encryptPrize($prize, $key, $cipherMethod = "AES-256-CBC") {
    $ivLength = openssl_cipher_iv_length($cipherMethod);
    $iv = openssl_random_pseudo_bytes($ivLength); // Generate a random IV
    $encryptedPrize = openssl_encrypt($prize, $cipherMethod, $key, 0, $iv);
    return base64_encode($iv . $encryptedPrize); // Combine IV and encrypted data
}

?>