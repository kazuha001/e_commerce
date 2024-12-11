<?php

include 'server.php';

session_start(); 

if (isset($_SESSION["domain"])) {

    $domain = $_SESSION["domain"];

    echo '<script>
            
        setTimeout(() => {
        
        window.location.href = "destroy_temporary_domain.php"
    
        }, 120000)

    </script>';

} else {

    session_destroy();

    echo '<script>
        alert("Invalid Domain Key")
    </script>';

    echo '<div style="width:100%; display: flex; justify-content: center;"><h1>Invalid Request :(</h1></div>';

    exit();

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>

    <!-- CSS links -->
    
    <!-- Default css -->
    <link rel="stylesheet" href="css/default.css">
    
    <link rel="stylesheet" href="css/log_in_sign_up.css">
</head>
<body style="background-image: url('images/overlay_bg.jpg');">
    
    <div class="container">

        <!-- Forgot Password -->
        <div class="log_in">
            <div class="log_in_form" id="animation1">
                <div class="overlay_images"><img src="Icons/loginPp.gif" alt="gif"></div>
                <form action="" method="post">
                    <h1>Forgot Password</h1>
                    <div class="log_in_form_fill">
                        <label for="username"> Username:</label>
                        <div class="log_in_form_fill_overlay">
                            <div class="overlay_1"></div><!-- Overlay -->
                            <input type="text" id="username" name="username" placeholder="Enter your Username" required autocomplete="username">
                        </div>
                        
                    </div>
                   
                    <div class="log_in_form_button">
                        <div class="log_in_form_button_overlay">
                            <div class="overlay_14"></div><!-- Overlay -->
                            <button type="button" onclick="fback()">Back</button>
                        </div>
                        <div class="log_in_form_button_overlay">
                            <div class="overlay_15"></div><!-- Overlay -->
                            <button type="submit">Submit</button>
                        </div>
                        
                        
                    </div>
                    
                </form>
            </div>

        </div><!-- Forgot Password -->

    </div>

</body>
<footer>

</footer>
<script src="script/animation.js"></script>
<script>
       
    var domain = "<?php echo htmlspecialchars($domain, ENT_QUOTES, 'UTF-8'); ?>";
    
    if (domain) {
        var newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + "?temporary?encryptedkey=" + encodeURIComponent(domain);
        
        
        window.history.pushState({path: newUrl}, '', newUrl);
        
        console.log("Current session data (temporary key) is now in the URL!");
    } else {
        console.log("No domain key found or invalid.");
    }

</script>
</html>