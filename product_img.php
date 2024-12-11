<?php
// Connect to your database
include 'server.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
 

// Get the user_id from the URL (passed as a query parameter)
$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : 0;

// Query to fetch the image data for the given user_id
$stmt = $conn->prepare("SELECT img FROM products_view WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($img_data);
$stmt->fetch();

if ($img_data) {
    // Set the appropriate content-type based on your image format (e.g., jpeg, png, gif)
    header("Content-Type: image/jpeg"); // Change this based on the format you stored (e.g., image/png)
    
    // Output the binary image data directly to the browser
    echo $img_data;
} else {
    echo "No image found.";
}

$stmt->close();
$conn->close();
?>
