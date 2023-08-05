<?php
// Start the session to access session data
session_start();

// Redirect to TikTok login page
function redirectToTikTokLogin()
{
    $config = parse_ini_file('env.ini');

    // Your TikTok App credentials
    $clientId = $config['CLIENT_ID'];
    $clientKey = $config['CLIENT_KEY'];
    $redirectUri = $config['REDIRECT_URI']; // Should point to the page handling TikTok callback

    $parameters = [
        'client_id' => $config['CLIENT_ID'],
        'client_key' => $config['CLIENT_KEY'],
        'redirect_uri' => $config['REDIRECT_URI'],
        'response_type' => 'code',
    ];

    $tiktokLoginUrl = 'https://www.tiktok.com/v2/auth/authorize?' . http_build_query($parameters);
    header('Location: ' . $tiktokLoginUrl);
    exit;
}

// Check if the user is already logged in (you can customize this part)
$isLoggedIn = isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true;
if ($isLoggedIn) {
    // User is already logged in, redirect to the dashboard or homepage
    header('Location: dashboard');
    exit;
}

// Handle the login form submission
if (isset($_POST['login'])) {
    // Perform your login logic here, e.g., verify user credentials
    // If the login is successful, set the isLoggedIn flag in the session
    // Example: $_SESSION['isLoggedIn'] = true;

    // For this example, we'll simply redirect to TikTok login
    redirectToTikTokLogin();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <h1>Login Page</h1>
    <form method="post" action="">
        <input type="submit" name="login" value="Login via TikTok">
    </form>
</body>

</html>