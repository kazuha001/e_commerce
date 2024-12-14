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
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="icon" href="logo/e-commerce.png" type="image/x-icon">
    <!-- CSS links -->
    
    <!-- Default css -->
    <link rel="stylesheet" href="css/default.css">
    
    <link rel="stylesheet" href="css/log_in_sign_up.css">
</head>
<body>
    
    <div class="container">
        <div class="sign_in">
            <div class="sign_in_form" id="animation2"><!-- Sign Up -->
                <div class="overlay_images"><img src="css/Icons/open-enrollment.gif" alt="gif"></div>
                <form id="myform">
                    <h1>Sign Up</h1>
                    <div class="sign_in_form_fill">
                        <label for="fname"> Fullname:</label>
                        <div class="sign_in_form_fill_overlay">
                            <div class="overlay_5"></div><!-- Overlay -->
                            <input type="text" id="fname" name="fname" placeholder="Enter your Fullname" required>
                        </div>
                        
                    </div>
                    <div class="sign_in_form_fill">
                        <label for="gender"> Gender:</label>
                        <div class="sign_in_form_fill_overlay">
                            <div class="overlay_16"></div><!-- Overlay -->
                            <select name="gender" id="gender" required>
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="N/A">Not to Tell</option>
                            </select>
                        </div>
                        
                    </div>
                    <div class="sign_in_form_fill">
                        <label for="number"> Mobile Number:</label>
                        <div class="sign_in_form_fill_overlay">
                            <div class="overlay_6"></div><!-- Overlay -->
                            <input type="tel" id="number" name="number" placeholder="Enter your Mobile Number" required>
                        </div>
                        
                    </div>
                    <div class="sign_in_form_fill">
                        <label for="birth"> Birthday:</label>
                        <div class="sign_in_form_fill_overlay">
                            <div class="overlay_13"></div><!-- Overlay -->
                            <input type="date" id="birth" name="birth" placeholder="Enter your Mobile Number" required>
                        </div>
                        
                    </div>
                    <div class="sign_in_form_fill">
                        <label for="email"> Email:</label>
                        <div class="sign_in_form_fill_overlay">
                            <div class="overlay_7"></div><!-- Overlay -->
                            <input type="email" id="email" name="email" placeholder="Enter your Email @" required autocomplete="email">
                        </div>
                        
                    </div>
                    <div class="sign_in_form_fill">
                        <label for="address"> address:</label>
                        <div class="sign_in_form_fill_overlay">
                            <div class="overlay_17"></div><!-- Overlay -->
                            <input type="address" id="address" name="address" placeholder="Enter your Address" required autocomplete="street-address">
                        </div>
                        
                    </div>
                    <div class="sign_in_form_fill">
                        <label for="username"> Username:</label>
                        <div class="sign_in_form_fill_overlay">
                            <div class="overlay_8"></div><!-- Overlay -->
                            <input type="text" id="username" name="username" placeholder="Enter your Username" required>
                        </div>
                        
                    </div>
                   
                    <div class="sign_in_form_fill">
                        <label for="password1"> Password:</label>
                        <div class="sign_in_form_fill_overlay" id="highlights">
                            <div class="overlay_9"></div><!-- Overlay -->
                            <input type="password" id="password1" name="password1" placeholder="Enter your Password" required>
                            <img src="css/Icons/invisible.png" alt="images" onclick="showpasswd1()" id="showpass1">
                        </div>
                        
                    </div>
                    <div class="sign_in_form_fill">
                        <label for="c_password1"> Confirm Password:</label>
                        <div class="sign_in_form_fill_overlay" id="highlights2">
                            <div class="overlay_10"></div><!-- Overlay -->
                            <input type="password" id="c_password1" name="c_password1" placeholder="Confirm your Password" required>
                        </div>
                        
                    </div>
                    <div class="termsconds">
                        <input type="checkbox" id="check" required>
                        <p> You accept the <u><a href="">terms and conditions</a></u> and <br> <u><a href="">privacy policy.</a></u></p>
                    </div>
                    <div class="sign_in_form_button">

                        <div class="sign_in_form_button_overlay">
                            <div class="overlay_11"></div><!-- Overlay -->
                            <button type="button" onclick="back()">Back</button>
                        </div>

                        <div class="sign_in_form_button_overlay">
                            <div class="overlay_12"></div><!-- Overlay -->
                            <button type="submit">Sign In</button>
                        </div>
                        
                        
                    </div>
                    
                </form>
            </div>
        </div><!-- Log In & Sign Up -->

    </div>

</body>
<footer>

</footer>
<script src="script/animation.js">

</script>
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
