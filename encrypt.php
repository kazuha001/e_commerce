<?php

function encryptPrize($prize, $key, $cipherMethod = "AES-256-CBC") {
    $ivLength = openssl_cipher_iv_length($cipherMethod);
    $iv = openssl_random_pseudo_bytes($ivLength); // Generate a random IV
    $encryptedPrize = openssl_encrypt($prize, $cipherMethod, $key, 0, $iv);
    return base64_encode($iv . $encryptedPrize); // Combine IV and encrypted data
}


function decryptPrize($encryptedPrizeWithIv, $key, $cipherMethod = "AES-256-CBC") {
    // Decode the base64-encoded data
    $decoded = base64_decode($encryptedPrizeWithIv);
    
    // Extract the IV (initialization vector) and the encrypted data
    $ivLength = openssl_cipher_iv_length($cipherMethod);
    $iv = substr($decoded, 0, $ivLength); // IV is at the start
    $encryptedPrize = substr($decoded, $ivLength); // Encrypted prize follows the IV
    
    // Decrypt the prize using AES-256-CBC
    return openssl_decrypt($encryptedPrize, $cipherMethod, $key, 0, $iv);
}

?>