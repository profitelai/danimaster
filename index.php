<?php
// Set your IP address here
$yourIPAddress = 'your.ip.address.here';

// Function to set initial access state
function initialAccessSetup($clientIP) {
    // Check client IP and set cookie if not already present
    if ($clientIP != $yourIPAddress && !isset($_COOKIE['verified'])) {
        setcookie("verified", "no", 0, "/"); // Cookie expires at end of session
    } else {
        setcookie("verified", "yes", 0, "/"); // Cookie for your IP or already verified users
    }
}

// Call the function with the current user's IP
initialAccessSetup($_SERVER['REMOTE_ADDR']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delayed Content Page</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link your CSS for initial styling -->
</head>
<body>
    <div id="content-area">
        <h1>Welcome to Our Site</h1>
        <p>This is the initial content that loads without delay.</p>
    </div>

    <!-- Placeholder for delayed content -->
    <div id="delayed-content" style="display:none;">
        <p>This content will load after 15 seconds.</p>
    </div>

    <script>
        window.onload = function() {
            // Check if the cookie 'verified' is set to 'no'
            if (document.cookie.indexOf('verified=no') !== -1) {
                setTimeout(function() {
                    // Display the delayed content after 15 seconds
                    document.getElementById('delayed-content').style.display = 'block';
                    // Optionally, change the cookie to 'yes' to not repeat the delay
                    document.cookie = "verified=yes; path=/";
                }, 15000);
            } else {
                // If verified or your IP, show content immediately
                document.getElementById('delayed-content').style.display = 'block';
            }
        };
    </script>
</body>
</html>
