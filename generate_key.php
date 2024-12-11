<?php

// Define the encryptPrize function
function encryptPrize($prize, $key, $cipherMethod = "AES-256-CBC") {
    $ivLength = openssl_cipher_iv_length($cipherMethod);
    $iv = openssl_random_pseudo_bytes($ivLength); // Generate a random IV
    $encryptedPrize = openssl_encrypt($prize, $cipherMethod, $key, 0, $iv);
    return base64_encode($iv . $encryptedPrize); // Combine IV and encrypted data
}

// Use a persistent key (store this securely and reuse it for decryption)
$key = ""; // Replace with a securely generated and stored key

// Get the prize from POST data
$prize = $_POST["prize"];

// Encrypt the prize
$encryptedPrize = encryptPrize($prize, $key);

// Output the encrypted prize
echo "Encrypted Prize: $encryptedPrize\n";


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